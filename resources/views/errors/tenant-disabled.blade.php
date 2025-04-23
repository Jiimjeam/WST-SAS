<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Access Disabled</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        h1 {
            font-size: 5rem;
            color: #28a745;
            text-shadow: 0 0 20px rgba(40, 167, 69, 0.5);
            margin-bottom: 20px;
        }
        p {
            font-size: 1.25rem;
            color: #555;
            max-width: 600px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .footer {
            margin-top: 1.5rem;
            font-size: 1rem;
            color: #888;
        }
        .disabled-message {
            border: 2px solid #28a745;
            padding: 30px;
            border-radius: 10px;
            background-color: rgba(40, 167, 69, 0.1);
            box-shadow: 0px 4px 15px rgba(40, 167, 69, 0.2);
        }
    </style>
</head>
<body>

    <div class="container disabled-message">
        <h1>503</h1>
        <p>Sorry, the tenant <strong>{{ $tenant->name }}</strong> is currently disabled.</p>
        <p>Your subscription may have been due.</p>
        <p>Please contact your administrator for more information.</p>
    </div>

    <!-- Bootstrap 5 JS (Optional for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
