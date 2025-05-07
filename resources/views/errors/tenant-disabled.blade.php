<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Access Disabled</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            font-family: 'Poppins', sans-serif;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 5rem;
            color: #4A90E2;
            text-shadow: 0 0 20px rgba(74, 144, 226, 0.4);
            margin-bottom: 20px;
        }

        p {
            font-size: 1.25rem;
            color: #555;
            max-width: 600px;
            margin: 0 auto 10px;
            padding: 0 20px;
        }

        .footer {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #888;
        }

        .button {
            margin-top: 20px;
            padding: 10px 24px;
            font-size: 1rem;
            font-weight: 600;
            background-color: #4A90E2;
            color: #fff;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #3b7dc3;
        }
    </style>
</head>
<body>
    <h1>503</h1>
    <p><strong>{{ $tenant->name }}</strong> is currently not accessible.</p>
    <p>Your subscription might have expired.</p>
    <p>Please contact your administrator if you believe this is a mistake.</p>
    
    <div class="footer">
        &copy; {{ date('Y') }} All rights reserved.
    </div>
</body>
</html>
