<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Explore Ethiopia</title>

  <!-- Shared CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  
  <!-- Page-Specific Styles -->
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--light-color);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-top: 80px;
    }

    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .register-box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin: 20px 0;
    }

    .register-box h2 {
      color: var(--primary-color);
      margin-bottom: 20px;
    }

    .register-box input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .register-box button {
      width: 100%;
      padding: 10px;
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .register-box button:hover {
      background-color: #092c6c;
    }

    .register-box p {
      margin-top: 15px;
      font-size: 0.95rem;
    }

    .register-box a {
      color: var(--secondary-color);
      text-decoration: underline;
    }

    .success-message {
      color: green;
      margin-top: 15px;
    }

    .error-message {
      color: red;
      margin-top: 15px;
    }

    /* Footer styles to match other pages */
    .footer-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      padding: 30px 0;
      max-width: 1200px;
      margin: 0 auto;
    }
    
    .footer-left, .footer-middle {
      flex: 1;
      min-width: 250px;
      padding: 0 15px;
    }
    
    .footer-logo {
      max-width: 150px;
      margin-bottom: 15px;
    }
    
    .footer-bottom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 0;
      border-top: 1px solid #ddd;
      max-width: 1200px;
      margin: 0 auto;
    }
    
    .social-icons a {
      margin-left: 15px;
      color: #0b3d91;
      font-size: 18px;
    }

    .contact-info {
      list-style: none;
    }

    .contact-info li {
      margin-bottom: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
  </style>
</head>
<body>

  

  <!-- Registration Form -->
  <main>
    <div class="register-box">
      <h2>Register</h2>

      <?php if (!empty($_SESSION['error'])): ?>
        <p class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
      <?php endif; ?>

      <?php if (!empty($_SESSION['message'])): ?>
        <p class="success-message"><?= $_SESSION['message']; unset($_SESSION['message']); ?></p>
      <?php endif; ?>

      <form action="process_register.php" method="POST">
        <input type="text" name="Fullname" placeholder="Fullname" required>
        <input type="text" name="username" placeholder="Choose a username" required>
        <input type="email" name="email" placeholder="Your email address" required>
        <input type="password" name="password" placeholder="Create a password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
      </form>

      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
  </main>

  

  <!-- JS -->
  <script src="../js/script.js"></script>
</body>
</html>