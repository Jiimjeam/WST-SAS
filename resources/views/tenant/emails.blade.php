<!DOCTYPE html>
<html>
<head>
    <title>Tenant Approved</title>
</head>
<body>
    <h2>Hello {{ $tenant->name }},</h2>

    <p>Your tenant account has been approved!</p>

    <p><strong>Login URL:</strong> <a href="{{ url('/tenant/login') }}">{{ url('/tenant/login') }}</a></p>
    <p><strong>Email:</strong> {{ $tenant->email }}</p>
    <p><strong>Temporary Password:</strong> {{ $password }}</p>

    <p>For security, please log in and change your password immediately.</p>

    <br>
    <p>Thank you,<br>SAAS-WST Team</p>
</body>
</html>
