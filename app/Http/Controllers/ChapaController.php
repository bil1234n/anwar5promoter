<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use App\Models\Notification; 
use Illuminate\Support\Str;

class ChapaController extends Controller
{
    private $secretKey = 'CHASECK-snGaS5rUHo6Z53gnp0IpJzu0U1nE1BdS'; 

    public function __construct()
    {
        $this->secretKey = env('CHASECK-snGaS5rUHo6Z53gnp0IpJzu0U1nE1BdS', $this->secretKey);
        // Alternatively, you can apply middleware here instead of routes/web.php
        // $this->middleware('auth'); 
    }

    public function showDonationForm()
    {
        // Pass the logged-in user to the view to auto-fill fields
        return view('donate', ['user' => Auth::user()]);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            // We can get email/name from Auth, but allowing input gives flexibility
            'donate_for' => 'required',
        ]);

        $user = Auth::user(); // Get Logged In User

        $purpose = $request->donate_for;
        if ($purpose === 'Others') {
            $purpose = $request->donate_for_other ?? 'General Donation';
        }

        $tx_ref = 'TX-' . Str::random(10) . '-' . time();

        $data = [
            "amount" => $request->amount,
            "currency" => "ETB",
            "email" => $user->email, // Use Auth Email directly for security
            "first_name" => $user->name, // Assuming your User model has 'name'
            "last_name" => "User",      // Or split name if needed
            "tx_ref" => $tx_ref,
            "callback_url" => route('donate.callback', ['tx_ref' => $tx_ref]),
            "return_url" => route('donate.callback', ['tx_ref' => $tx_ref]),
            "customization" => [
                "title" => "Donation",
                "description" => "Donation for " . $purpose
            ],
            "meta" => [
                "purpose" => $purpose
            ]
        ];

        $response = Http::withToken($this->secretKey)
            ->post('https://api.chapa.co/v1/transaction/initialize', $data);

        if ($response->successful() && $response->json('status') === 'success') {
            return redirect($response->json('data.checkout_url'));
        }

        return back()->with('error', 'Payment initialization failed. Please try again.');
    }

    public function paymentCallback(Request $request)
    {
        $tx_ref = $request->query('trx_ref') ?? $request->route('tx_ref');

        if (!$tx_ref) {
            return redirect('/')->with('error', 'Transaction reference missing.');
        }

        $response = Http::withToken($this->secretKey)
            ->get("https://api.chapa.co/v1/transaction/verify/{$tx_ref}");

        $result = $response->json();

        if (isset($result['status']) && $result['status'] === 'success') {
            
            $data = $result['data'];
            $purpose = $data['meta']['purpose'] ?? 'General Donation';

            // 1. Save Donation
            $donation = Donation::updateOrCreate(
                ['tx_ref' => $data['tx_ref']],
                [
                    'first_name' => $data['first_name'],
                    'last_name'  => $data['last_name'],
                    'email'      => $data['email'],
                    'amount'     => $data['amount'],
                    'purpose'    => $purpose,
                    'status'     => 'success'
                ]
            );

            // 2. Create Notification
            // Since route is protected by 'auth', we don't need "if(Auth::check())"
            Notification::create([
                'user_id' => Auth::id(),
                'type' => 'donation',
                'message' => "Your donation of {$donation->amount} ETB for '{$donation->purpose}' was successful!",
                'is_read' => false
            ]);

            return view('payment-success', ['data' => $data]);

        } else {
            return view('payment-failed');
        }
    }

    public function adminDonations()
    {
        $donations = Donation::orderBy('created_at', 'desc')->get();
        return view('admin.donated', compact('donations'));
    }
}
