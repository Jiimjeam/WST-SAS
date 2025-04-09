<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
            text-align: center;
        }
        h1 {
            color: #2c3e50;
        }
        span {
            font-weight: bold;
            color: #3498db;
        }
    </style>
</head>
<body>
    <h1>Welcome to <span>{{ $tenantName }}</span> ({{ $tenantDomain }})!</h1>
</body>
</html>
