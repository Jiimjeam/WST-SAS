<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tenant Access Disabled</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #fff;
      font-family: 'Poppins', sans-serif;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
    }
    .disabled-message {
      border: 2px solid #dc3545;
      padding: 40px 30px;
      border-radius: 12px;
      background-color: rgba(220, 53, 69, 0.1);
      box-shadow: 0 4px 20px rgba(220, 53, 69, 0.2);
      max-width: 600px;
    }
    .icon {
      font-size: 4rem;
      color: #dc3545;
      margin-bottom: 10px;
    }
    h1 {
      font-size: 3rem;
      color: #dc3545;
      margin-bottom: 20px;
    }
    p {
      font-size: 1.1rem;
      color: #555;
      margin-bottom: 10px;
    }
    .footer {
      margin-top: 1.5rem;
      font-size: 0.9rem;
      color: #888;
    }
  </style>
</head>
<body>

  <div class="container disabled-message">
    <div class="icon">
      <i class="bi bi-exclamation-triangle-fill"></i>
    </div>
    <h1>503 Service Unavailable</h1>
    <p><strong>{{ $tenant->name }}</strong> is currently disabled.</p>
    <p>Your subscription may have expired or is inactive.</p>
    <p>Please contact your administrator for assistance.</p>
    <div class="footer">
      &copy; {{ date('Y') }} YourCompany. All rights reserved.
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
