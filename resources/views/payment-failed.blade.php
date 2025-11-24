<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <style>
        body { font-family: sans-serif; display: flex; height: 100vh; justify-content: center; align-items: center; background-color: #fef2f2; }
        .card { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; max-width: 400px; width: 100%; }
        h1 { color: #dc2626; margin-bottom: 20px; }
        p { margin: 10px 0; color: #555; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #dc2626; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Payment Failed</h1>
        <p>We could not process your donation.</p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

        {{-- This handles the message safely --}}
        <p style="color: #dc2626;">
            <strong>Reason:</strong> {{ $data['message'] ?? 'Unknown Error' }}
        </p>

        <a href="/" class="btn">Try Again</a>
    </div>
</body>
</html>