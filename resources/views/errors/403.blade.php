<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Denied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0f7fa, #80deea);
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
            color: #00838f;
            text-shadow: 0 0 20px rgba(0, 131, 143, 0.3);
            margin-bottom: 10px;
        }

        p {
            font-size: 1.25rem;
            color: #444;
            max-width: 600px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #00838f;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #006064;
        }
    </style>
</head>
<body>
    <h1>403</h1>
    <p>Sorry, you don’t have permission to access this page. Please check your credentials or contact the administrator if you believe this is a mistake.</p>
    <a href="{{ url('/') }}" class="button">Return Home</a>
    
</body>
</html>
