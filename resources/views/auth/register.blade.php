<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Register</title>
    <link rel="stylesheet" href="{{ 'https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css' }}">

    <style>
        /*
        |--------------------------------------------------------------------------
        | Styles Copied from login.blade.php
        |--------------------------------------------------------------------------
        */
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

        /* Adjusted max-width for register form due to more fields */
        form {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); 
            width: 100%;
            max-width: 480px; /* Slightly wider to accommodate more fields cleanly */
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 15px; /* Reduced gap slightly since there are more fields */
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

        /* Targeting all common text/password/email/tel inputs and select for consistency */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="file"] {
            width: 100%;
            padding: 14px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease-in-out;
            background-color: #fff; /* Ensure file input background is white */
        }
        
        /* Specific styling for file inputs to make them less intrusive */
        input[type="file"] {
            padding: 10px;
            cursor: pointer;
            line-height: 1.5;
        }


        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="tel"]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.2);
            outline: none;
            background-color: #f9fdf9;
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
            margin-top: 15px; /* Added spacing after the many inputs */
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
            max-width: 480px; /* Matching form width */
        }

        p {
            margin-top: 15px; 
            margin-bottom: 0;
            font-size: 0.9rem;
            color: #777;
        }

        a {
            color: #4CAF50; 
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

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        <a href="{{ url('/') }}" aria-current="page" class="header_logo" aria-label="home">
            <img src="{{ asset('assets/img/logo/logo_a_3.png') }}" loading="lazy" alt="" class="nav-logo">
        </a>
        <h2>Create Account</h2>
        @csrf

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
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="phoneNo">Phone Number:</label>
            <input type="text" id="phoneNo" name="phoneNo" value="{{ old('phoneNo') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="profile_p">Profile Picture:</label>
            <input type="file" id="profile_p" name="profile_p" accept="image/*">
        </div>

        <div class="form-group">
            <label for="id_card">ID Card:</label>
            <input type="file" id="id_card" name="id_card" accept="image/*,application/pdf">
        </div>

        <div class="form-group">
            <label for="passport">Passport:</label>
            <input type="file" id="passport" name="passport" accept="image/*,application/pdf">
        </div>

        <button type="submit">Register</button>

        <a href="{{ url('auth/google') }}" class="google-signin-btn">
            <i class="ri-google-fill" style="color: #3eae5c; font-size: 1.5rem;"></i> Sign up with Google
        </a>
        
        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </form>

</body>
</html>