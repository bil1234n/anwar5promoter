<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Email</title>
</head>
<body>
    <h2>Verify Your Email</h2>
    <p>Before proceeding, please check your email for a verification link.</p>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
