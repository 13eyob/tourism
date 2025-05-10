<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - Explore Ethiopia</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      font-family: Arial;
      background-color: #f4f4f4;
      padding: 60px 20px;
    }
    .contact-form {
      max-width: 500px;
      margin: auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    .contact-form h2 {
      color: #0b3d91;
    }
    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .contact-form button {
      width: 100%;
      padding: 10px;
      background-color: #0b3d91;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .success-message {
      color: green;
      margin-top: 15px;
    }
    .error-message {
      color: red;
      margin-top: 15px;
    }
  </style>
</head>
<body>

<div class="contact-form">
  <h2>Contact Us</h2>

  <?php if (isset($_SESSION['message'])): ?>
    <p class="success-message"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <p class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
  <?php endif; ?>

  <form action="process_contact.php" method="POST">
    <input type="text" name="name" placeholder="Your Full Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
</div>

</body>
</html>