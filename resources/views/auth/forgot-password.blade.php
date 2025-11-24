<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>

    @if(session('status'))
        <div>{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <button type="submit">Send Reset Link</button>
    </form>

    <p><a href="{{ route('login') }}">Back to Login</a></p>
</body>
</html>
