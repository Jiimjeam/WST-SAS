<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Login | SAAS-WST</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap + Animate.css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            max-width: 420px;
            margin: 80px auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            animation: fadeInDown 1s;
        }

        .login-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-control {
            height: 45px;
        }

        .btn-green {
            background-color: #5DC07A;
            border-color: #5DC07A;
            color: white;
        }

        .btn-green:hover {
            background-color: #4aae6b;
            border-color: #4aae6b;
        }

        .form-floating > label {
            color: #6c757d;
        }

        .logo {
            width: 60px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }

        /* Style for eye icon */
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-container animate__animated animate__fadeInDown">
    <!-- <img src="{{ asset('images/buksu-logo.png') }}" alt="Logo" class="logo"> -->

    <div class="login-title">Tenant Login</div>

    <form method="POST" action="{{ route('tenant.login.submit') }}">
        @csrf

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="color: red;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required>
            <label for="email">Email Address</label>
        </div>

        <div class="form-floating mb-4 position-relative">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            <label for="password">Password</label>
            <i class="fas fa-eye eye-icon" id="toggle-password" onclick="togglePassword()"></i>
        </div>

        <button type="submit" class="btn btn-green w-100">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('welcome') }}" class="text-muted">← Back to Homepage</a>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("toggle-password");
        
        // Toggle password visibility
        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>

</body>
</html>
