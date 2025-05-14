<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Masuk</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');
    body {
      background-color: #fff;
      font-family: 'Poppins', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    .form-container {
      border: 1.5px solid #174ea6;
      border-radius: 20px;
      padding: 40px;
      width: 400px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    h2 {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 30px;
      color: #174ea6;
      font-family: 'Arial Black', sans-serif;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 10px;
      text-align: left;
    }
    label {
      font-size: 14px;
      font-weight: 500;
      color: #174ea6;
    }
    input[type="text"],
    input[type="password"] {
      padding: 10px;
      border-radius: 10px;
      border: none;
      background-color: #174ea6;
      color: white;
      font-size: 14px;
    }
    input::placeholder {
      color: #d1d1d1;
    }
    button {
      margin-top: 20px;
      background-color: #174ea6;
      color: white;
      padding: 10px;
      font-size: 14px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0f3d91;
    }
    p {
      margin-top: 10px;
      font-size: 12px;
      color: #37c2c1;
    }
    p a {
      text-decoration: none;
      color: #37c2c1;
      font-weight: 500;
    }
    p a:hover {
      text-decoration: underline;
    }
    .alert {
      color: green;
      font-size: 14px;
      margin-bottom: 10px;
    }
    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Masuk</h2>

    @if (session('success'))
      <div class="alert">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="error">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <label>Email</label>
        <input type="text" name="email" required autofocus>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>