<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Render Test</title>
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f3f4f6;
            color: #1f2937;
        }
        .card {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
        }
        h1 { color: #10b981; margin-bottom: 0.5rem; }
        p { margin-bottom: 1rem; color: #4b5563; }
        .info {
            background: #e5e7eb;
            padding: 0.5rem;
            border-radius: 0.5rem;
            font-family: monospace;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>IT WORKS! 🚀</h1>
        <p>Your Laravel app is running successfully on Render.</p>
        
        <div class="info">
            <strong>Time:</strong> {{ now() }}<br>
            <strong>Laravel:</strong> v{{ Illuminate\Foundation\Application::VERSION }}<br>
            <strong>PHP:</strong> v{{ phpversion() }}
        </div>

        <p style="margin-top: 15px; font-size: 12px; color: #6b7280;">
            (This page does not use a database query)
        </p>
    </div>
</body>
</html>
