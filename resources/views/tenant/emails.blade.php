<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Platform</title>
</head>
<body>
    <h1>Hello {{ $tenant->name }},</h1>

    <p>Welcome to our platform! Your tenant account has been approved.</p>

    <p><strong>Here are your login details:</strong></p>
    <ul>
        <li><strong>Email:</strong> {{ $tenant->email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>

    <p>You can log in here: <a href="{{ $loginUrl }}">{{ $loginUrl }}</a></p>

    <p>We recommend changing your password after logging in for the first time.</p>

    <p>Thank you,<br/>The Admin Team</p>
</body>
</html>
