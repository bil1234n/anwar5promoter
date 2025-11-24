<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body { font-family: sans-serif; display: flex; height: 100vh; justify-content: center; align-items: center; background-color: #f0fdf4; }
        .card { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; max-width: 400px; width: 100%; }
        h1 { color: #16a34a; margin-bottom: 20px; }
        p { margin: 10px 0; color: #555; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #16a34a; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Payment Successful!</h1>
        <p>Thank you for your donation.</p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

        {{-- FIX: Use tx_ref instead of id --}}
        <p><strong>Transaction Ref:</strong> {{ $data['tx_ref'] ?? 'N/A' }}</p>
        
        <p><strong>Amount:</strong> {{ number_format($data['amount'], 2) }}</p>
        
        {{-- Show the Purpose if available --}}
        @if(isset($data['purpose']))
            <p><strong>Donation For:</strong> {{ $data['purpose'] }}</p>
        @endif

        <a href="/" class="btn">Return Home</a>
    </div>
</body>
</html>