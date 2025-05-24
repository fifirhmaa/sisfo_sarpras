<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
      background: linear-gradient(135deg, #174ea6, #a0c4ff);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .blob-bg {
      position: absolute;
      width: 800px;
      height: 800px;
      background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.1), transparent);
      border-radius: 45% 55% 55% 45% / 55% 45% 55% 45%;
      animation: blob 20s infinite ease-in-out;
      z-index: 0;
    }

    @keyframes blob {
      0%, 100% {
        border-radius: 45% 55% 55% 45% / 55% 45% 55% 45%;
        transform: scale(1) rotate(0deg);
      }
      50% {
        border-radius: 50% 50% 40% 60% / 60% 40% 60% 40%;
        transform: scale(1.05) rotate(2deg);
      }
    }

    .bubble {
      position: absolute;
      bottom: -100px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50%;
      animation: riseBubble 20s infinite linear;
      z-index: 0;
    }

    .bubble:nth-child(2) { width: 40px; height: 40px; left: 10%; animation-delay: 0s; }
    .bubble:nth-child(3) { width: 25px; height: 25px; left: 25%; animation-delay: 3s; }
    .bubble:nth-child(4) { width: 35px; height: 35px; left: 40%; animation-delay: 6s; }
    .bubble:nth-child(5) { width: 20px; height: 20px; left: 55%; animation-delay: 2s; }
    .bubble:nth-child(6) { width: 50px; height: 50px; left: 70%; animation-delay: 4s; }

    @keyframes riseBubble {
      0% { transform: translateY(0) scale(1); opacity: 0.3; }
      50% { opacity: 0.5; }
      100% { transform: translateY(-120vh) scale(1.2); opacity: 0; }
    }

    .login-box {
      z-index: 1;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
      width: 400px;
      text-align: center;
      animation: floatBox 1.5s ease;
    }

    @keyframes floatBox {
      0% { transform: translateY(30px); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    /* Melayang */
    .logo-float {
      width: 80px;
      height: auto;
      animation: floatLogo 3.5s ease-in-out infinite;
      margin-bottom: 20px;
    }

    @keyframes floatLogo {
      0% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-12px) rotate(2deg); }
      100% { transform: translateY(0px) rotate(-2deg); }
    }

    label {
      display: block;
      margin-top: 20px;
      margin-bottom: 6px;
      font-size: 14px;
      color: #e3eaff;
      text-align: left;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      margin-bottom: 16px;
      border: none;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.25);
      color: #fff;
      font-size: 15px;
      transition: background 0.3s;
    }

    input::placeholder {
      color: #d5e4ff;
    }

    input:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.35);
    }

    .button {
      width: 100%;
      padding: 13px;
      font-size: 16px;
      background-color: #174ea6;
      border: none;
      border-radius: 12px;
      color: white;
      font-weight: 600;
      box-shadow: 0 4px #0e3474;
      transition: 0.2s ease-in-out;
      cursor: pointer;
    }

    .button:hover {
      background-color: #0f3d91;
    }

    .button:active {
      transform: scale(0.98);
    }

    .error, .alert {
      color: #ffe3e3;
      font-size: 14px;
      margin-bottom: 12px;
    }

  </style>
</head>
<body>

  <!-- Blob & Bubbles -->
  <div class="blob-bg"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>
  <div class="bubble"></div>

  <!-- Login Box -->
  <div class="login-box">
    <img src="{{ asset('img/images.png') }}" class="logo-float" alt="Logo">
    
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
      <label for="email">Email</label>
      <input type="text" name="email" placeholder="Masukkan email" required>

      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Masukkan password" required>

      <button type="submit" class="button">Masuk</button>
    </form>
  </div>

</body>
</html>
