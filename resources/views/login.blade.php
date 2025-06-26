<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <!-- Toastr (optional) -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      background-color: #fff;
      padding: 30px 25px;
      border-radius: 8px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 360px;
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 25px;
      color: #333;
    }

    .login-container form {
      display: flex;
      flex-direction: column;
    }

    .login-container input[type="email"],
    .login-container input[type="password"] {
      padding: 10px 12px;
      margin-bottom: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 15px;
    }

    .error-message {
      text-align: left;
      color: rgb(231, 40, 40);
      font-size: 13px;
      margin-top: -5px;
      margin-bottom: 10px;
    }

    .login-container button {
      padding: 10px;
      background-color: #3498db;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
      transition: background-color 0.3s ease;
    }

    .login-container button:hover {
      background-color: #2980b9;
    }

    .forgot-password {
      margin-top: 10px;
      font-size: 14px;
      color: #3498db;
      text-decoration: none;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .google-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background-color: #fff;
      border: 1px solid #dadce0;
      border-radius: 24px;
      padding: 10px 24px;
      text-decoration: none;
      font-size: 16px;
      color: #3c4043;
      font-family: Roboto, sans-serif;
      font-weight: 500;
      box-shadow: none;
      transition: background-color 0.3s ease;
      margin-top: 15px;
    }

    .google-btn img {
      height: 20px;
      margin-right: 12px;
    }

    .google-btn:hover {
      background-color: #f7f8f8;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Login</h2>
    <form action="{{ route('login') }}" method="POST">
      @csrf

      <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
      @error('email')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <input type="password" name="password" placeholder="Enter your password">
      @error('password')
        <div class="error-message">{{ $message }}</div>
      @enderror

      <button type="submit">Login</button>

      <a href="{{ url('/auth/google') }}" class="google-btn">
        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo">
        <span>Sign in with Google</span>
      </a>
    </form>

    <a href="#" class="forgot-password">Forgot Password?</a>
  </div>

</body>
</html>
