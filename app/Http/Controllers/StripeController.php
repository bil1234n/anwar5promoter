<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Donation;
use App\Models\Notification; 
use Illuminate\Support\Facades\DB;

class StripeController extends Controller
{
    // --- PAYMENT FUNCTIONS ---

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'email' => 'required|email',
            'donate_for' => 'required',
        ]);

        $purpose = $request->donate_for;
        if ($purpose === 'Others') {
            $purpose = $request->donate_for_other ?? 'General Donation';
        }

        $tx_ref = uniqid();

        // Save Pending Donation
        Donation::create([
            'tx_ref' => $tx_ref,
            'amount' => $request->amount,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'purpose' => $purpose,
            'status' => 'pending'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $request->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => "Donation for " . $purpose,
                    ],
                    'unit_amount' => $request->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
            'metadata' => [
                'tx_ref' => $tx_ref
            ],
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect('/')->with('error', 'No Session ID found.');
        }

        // Verify with Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            
            $tx_ref = $session->metadata->tx_ref;
            $donation = Donation::where('tx_ref', $tx_ref)->first();
            
            if ($donation) {
                // 1. Update Donation Status
                $donation->update(['status' => 'success']);

                // 2. Create Notification (Only if user is logged in)
                if (Auth::check()) {
                    Notification::create([
                        'user_id' => Auth::id(),
                        'type' => 'donation',
                        'message' => "Your donation of {$donation->amount} USD for '{$donation->purpose}' was successful!",
                        'is_read' => false
                    ]);
                }

                return view('payment-success', [
                    'data' => [
                        'amount' => $donation->amount,
                        'tx_ref' => $donation->tx_ref,
                        'purpose' => $donation->purpose
                    ]
                ]);
            }
        }

        return redirect('/')->with('error', 'Payment verification failed.');
    }


    public function paymentCancel()
    {
        return view('payment-failed', ['data' => ['message' => 'Payment was cancelled.']]);
    }

    // --- ADMIN FUNCTION (Added This) ---

    public function adminDonations(Request $request)
    {
        // 1. CHART DATA (Global Stats - Always shows full picture)
        // Chart 1: Total Amount by Purpose (Pie Chart)
        $chartPurpose = Donation::where('status', 'success')
            ->select('purpose', DB::raw('sum(amount) as total_amount'))
            ->groupBy('purpose')
            ->get();

        // Chart 2: Daily Donations - Last 30 Days (Line Chart)
        $chartTrend = Donation::where('status', 'success')
            ->where('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(amount) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // 2. FILTERING LOGIC (For the Table)
        $query = Donation::orderBy('created_at', 'desc');

        if ($request->has('purpose') && $request->purpose != 'all') {
            $query->where('purpose', $request->purpose);
        }

        // Get the filtered results
        $donations = $query->get();

        // Get all unique purposes for the filter dropdown
        $allPurposes = Donation::select('purpose')->distinct()->pluck('purpose');

        return view('admin.donated', compact('donations', 'chartPurpose', 'chartTrend', 'allPurposes'));
    }
}