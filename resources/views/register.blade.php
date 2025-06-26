@extends('admin_layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: #f4f4f9;
      margin: 0;
      padding: 0;
    }

    .form-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 80px); /* Adjust based on your top navbar height */
      padding: 20px;
    }

    .signup-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      width: 380px;
    }

    .signup-container h2 {
      margin-bottom: 25px;
      text-align: center;
      color: #333;
    }

    .form-control {
      height: 46px;
      font-size: 15px;
      margin-bottom: 18px;
    }

    .error-message {
      text-align: left;
      color: rgb(231, 40, 40);
      font-size: 14px;
      margin-top: -10px;
      margin-bottom: 10px;
    }

    .signup-container button {
      width: 100%;
      padding: 12px;
      background-color: #1768b4;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .signup-container button:hover {
      background-color: #62a9eb;
    }
  </style>
</head>
<body>

  <div class="form-wrapper">
    <div class="signup-container">
      <h2>Sign up</h2>

      <form action="{{ route('signup') }}" method="POST">
        @csrf

        <!-- Name -->
        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your name">
        <div class="error-message">@error('name') {{ $message }} @enderror</div>

        <!-- Email -->
        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
        <div class="error-message">@error('email') {{ $message }} @enderror</div>

        <!-- Password -->
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
        <div class="error-message">@error('password') {{ $message }} @enderror</div>

        <!-- Confirm Password -->
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password">
        <div class="error-message">@error('password_confirmation') {{ $message }} @enderror</div>

        <!-- Role Selection -->
        <select name="role" class="form-control @error('role') is-invalid @enderror" required>
          <option value="" disabled selected>Select your role</option>
          <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
          <option value="Employee" {{ old('role') == 'Employee' ? 'selected' : '' }}>Employee</option>
        </select>
        <div class="error-message">@error('role') {{ $message }} @enderror</div>

        <!-- Submit -->
        <button type="submit">Sign up</button>
      </form>
    </div>
  </div>

</body>
</html>
@endsection
