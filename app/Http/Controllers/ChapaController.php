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
    // Best practice: Keep keys in .env file (e.g., CHAPA_SECRET_KEY)
    // env('CHAPA_SECRET', 'fallback_value')
    private $secretKey; 

    public function __construct()
    {
        // Assuming you have CHAPA_SECRET_KEY in your .env file
        $this->secretKey = env('CHAPA_SECRET_KEY', 'CHASECK-snGaS5rUHo6Z53gnp0IpJzu0U1nE1BdS');
    }

    public function showDonationForm()
    {
        // Pass the logged-in user (or null) to the view
        return view('donate', ['user' => Auth::user()]);
    }

    public function processPayment(Request $request)
    {
        // 1. Determine Validation Rules based on Auth status
        $rules = [
            'amount' => 'required|numeric|min:1',
            'donate_for' => 'required',
        ];

        // If Guest (not logged in), we require their details
        if (!Auth::check()) {
            $rules['email'] = 'required|email';
            $rules['first_name'] = 'required|string';
            $rules['last_name'] = 'nullable|string';
        }

        $request->validate($rules);

        // 2. Prepare User Data
        if (Auth::check()) {
            // Logged In User
            $user = Auth::user();
            $email = $user->email;
            $firstName = $user->name; // Assuming 'name' exists
            $lastName = 'User';       // Or split $user->name if needed
        } else {
            // Guest User
            $email = $request->email;
            
            // OPTION A: Use the name they typed in the form
            $firstName = $request->first_name;
            $lastName = $request->last_name ?? 'Guest';

            // OPTION B: If you STRICTLY want the database to say "Guest" 
            // regardless of what they typed, uncomment the line below:
            // $firstName = "Guest"; $lastName = "User";
        }

        // 3. Handle Purpose
        $purpose = $request->donate_for;
        if ($purpose === 'Others') {
            $purpose = $request->donate_for_other ?? 'General Donation';
        }

        $tx_ref = 'TX-' . Str::random(10) . '-' . time();

        $data = [
            "amount" => $request->amount,
            "currency" => "ETB",
            "email" => $email,
            "first_name" => $firstName,
            "last_name" => $lastName,
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

        // 4. Send to Chapa
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
            // This will save the name sent in processPayment ("Guest" or the typed name)
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

            // 2. Create Notification (ONLY IF LOGGED IN)
            if (Auth::check()) {
                Notification::create([
                    'user_id' => Auth::id(),
                    'type' => 'donation',
                    'message' => "Your donation of {$donation->amount} ETB for '{$donation->purpose}' was successful!",
                    'is_read' => false
                ]);
            }

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
