<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Login</title>
    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="{{ 'https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css' }}">

    <style>
        body {
            font-family: 'Inter', 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(to bottom right, #e0f2f7, #c8e6c9); 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            color: #333; 
        }

        form {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); 
            width: 100%;
            max-width: 420px; 
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 20px; 
        }

        h2 {
            color: #2c3e50; 
            text-align: center;
            margin-bottom: 25px;
            font-size: 2rem; 
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .form-group { 
            margin-bottom: 0; 
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4a4a4a;
            font-size: 0.95rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease-in-out;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.2);
            outline: none;
            background-color: #f9fdf9;
        }

        .remember-me-group {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #666;
            margin-top: -10px;
            user-select: none;
        }

        .remember-me-group label {
            font-weight: 500;
            color: #666;
            cursor: pointer;
            margin-bottom: 0;
            display: flex;
            align-items: center;
        }

        .remember-me-group input[type="checkbox"] {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #ccc;
            border-radius: 4px;
            margin-right: 8px;
            cursor: pointer;
            position: relative;
            display: inline-block;
            vertical-align: middle;
            transition: all 0.2s ease-in-out;
            margin-left: 0; 
        }

        .remember-me-group input[type="checkbox"]:checked {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .remember-me-group input[type="checkbox"]:checked::after {
            content: '\f00c'; 
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: white;
            font-size: 12px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        button[type="submit"] {
            width: 100%;
            background-color: #4CAF50; 
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 10px; 
            cursor: pointer;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease, transform 0.1s ease;
            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.2);
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #388E3C;
            box-shadow: 0 6px 15px rgba(76, 175, 80, 0.3);
        }

        button[type="submit"]:active {
            transform: translateY(1px);
        }

        .secondary-links {
            text-align: center;
            margin-top: 25px;
            width: 100%;
            max-width: 420px;
        }

        p {
            margin-top: 15px; 
            margin-bottom: 0;
            font-size: 0.9rem;
            color: #777;
        }

        a {
            color: #4CAF50; /* Green primary color */
            text-decoration: none;
            transition: color 0.3s ease, text-decoration 0.3s ease;
            font-weight: 600;
        }

        a:hover {
            color: #388E3C;
            text-decoration: underline;
        }

        .google-signin-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px; 
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin: 15px auto 0 auto;
            width: 100%;
            max-width: 300px; 
            font-size: 1rem;
            color: #555;
            background-color: #f7f7f7;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .google-signin-btn:hover {
            background-color: #e8e8e8;
            border-color: #ccc;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .google-signin-btn .fab.fa-google {
            color: #db4437; 
            font-size: 1.2rem;
        }

        .session-success {
            padding: 12px;
            margin-bottom: 20px;
            background-color: #e6ffed; 
            color: #2d663c;
            border: 1px solid #a3e0b7;
            border-radius: 8px;
            font-size: 0.9rem;
            text-align: center;
        }

        div:has(> ul) {
            background-color: #ffe6e6;
            border: 1px solid #e0b4b4;
            color: #a04040;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        div:has(> ul) ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }

        div:has(> ul) li {
            padding: 3px 0;
            font-size: 0.9rem;
        }
        .header_logo {
            width: 100%;
            margin: 0 auto -2rem;
            text-align: center;
        }
        .header_logo img{
            width: 200px;
        }
    </style>
</head>
<body>

    <form method="POST" action="{{ route('login') }}">
        <a href="{{ url('/') }}" aria-current="page" class="header_logo" aria-label="home">
            <img src="{{ asset('assets/img/logo/logo_a_3.png') }}" loading="lazy" alt="" class="nav-logo">
        </a>
        <h2>Login</h2>
        @csrf

        @if(session('success'))
            <div class="session-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="remember-me-group">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>
        
        <button type="submit">Login</button>

        <a href="{{ url('auth/google') }}" class="google-signin-btn">
            <i class="ri-google-fill" style="color: #3eae5c; font-size: 1.5rem;"></i> Sign in with Google
        </a>
        
        <p><a href="{{ route('password.request') }}">Forgot Password?</a></p>
        
        <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
    </form>
  

</body>
</html>