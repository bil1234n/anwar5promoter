<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Anwar5Promoter')</title>
    <style>
        /* Reset some default styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: #4CAF50;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        header h1 {
            font-size: 24px;
        }

        nav {
            background: #333;
            color: white;
            padding: 10px 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #4CAF50;
        }

        main {
            padding: 20px;
            min-height: calc(100vh - 120px); /* header + footer height */
        }

        footer {
            background: #333;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }

        /* Buttons */
        button {
            cursor: pointer;
        }

        /* Form inputs */
        input, select, textarea {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            font-size: 14px;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Alerts */
        .alert {
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <h1>Anwar5Promoter</h1>
    </header>

    <nav>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('donate.form') }}">Donate</a>
        {{-- Add other menu links here --}}
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Anwar5Promoter. All rights reserved.
    </footer>

    @stack('scripts')
</body>
</html>
