<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Donation; // <--- Import the Donation Model

class ChapaController extends Controller
{
    // It is best practice to put keys in .env, but for now, we keep it here as requested.
    private $secretKey = 'CHASECK_TEST-2cC1jBYMDlMKOaui454YGBgqAMKMeghb'; 

    /**
     * Initialize the payment process
     */
    public function processPayment(Request $request)
    {
        // 1. Validate Inputs
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'email' => 'required|email',
            'donate_for' => 'required',
        ]);

        // 2. Handle "Donate For" Logic
        $purpose = $request->donate_for;
        if ($purpose === 'Others') {
            $purpose = $request->donate_for_other ?? 'General Donation';
        }

        // 3. Prepare Data
        $data = [
            "amount" => $request->amount,
            "currency" => "ETB",
            "email" => $request->email,
            "first_name" => $request->first_name ?? "Customer",
            "last_name" => $request->last_name ?? "Test",
            "tx_ref" => uniqid(),
            "callback_url" => route('donate.callback'),
            "description" => "Donation for " . $purpose,
            "meta" => [
                "purpose" => $purpose
            ]
        ];

        // 4. Send Request to Chapa
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.chapa.co/v1/transaction/initialize");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$this->secretKey}",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        // 5. DECODE AND REDIRECT (The Fix)
        $payment = json_decode($response, true);

        if (isset($payment['status']) && $payment['status'] === 'success') {
            // Redirect the user to the Chapa payment page
            return redirect($payment['data']['checkout_url']);
        } else {
            // If Chapa rejected the request, show the error
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Verify the payment when Chapa redirects back
     */
    public function paymentCallback(Request $request)
    {
        $transaction_id = $request->query('transaction_id');

        if (!$transaction_id) {
            return "Transaction ID not provided!";
        }

        // 1. Verify Transaction with Chapa API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.chapa.co/v1/transaction/verify/{$transaction_id}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$this->secretKey}"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // 2. Check if Payment was Successful
        if (isset($data['status']) && $data['status'] === 'success') {
            
            // Retrieve the purpose we saved in 'meta' during initialization
            $purpose = $data['data']['meta']['purpose'] ?? 'General Donation';

            // 3. Save to Database (For Admin View)
            // using updateOrCreate ensures we don't create duplicates if the user refreshes the success page
            Donation::updateOrCreate(
                ['tx_ref' => $data['data']['tx_ref']], 
                [
                    'amount' => $data['data']['amount'],
                    'email' => $data['data']['email'],
                    'first_name' => $data['data']['first_name'] ?? null,
                    'last_name' => $data['data']['last_name'] ?? null,
                    'purpose' => $purpose,
                    'status' => 'success'
                ]
            );

            // 4. Send Notification (Logic from your original code)
            if (Auth::check()) {
                // Assuming you have a helper function named sendNotification
                // We add the purpose to the message so the user knows what they donated for
                sendNotification(
                    Auth::id(),
                    'donation',
                    "Your donation of {$data['data']['amount']} ETB for '{$purpose}' was successful!"
                );
            }

            return view('payment-success', ['data' => $data['data']]);

        } else {
            // Payment failed or verification failed
            return view('payment-failed', ['data' => $data]);
        }
    }

    /**
     * Admin View to see history
     * Route: Route::get('/admin/donations', [ChapaController::class, 'adminDonations']);
     */
    public function adminDonations()
    {
        // Fetch all donations, newest first
        $donations = Donation::orderBy('created_at', 'desc')->get();
        
        return view('admin.donated', compact('donations'));
    }
}