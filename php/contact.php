<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us - Explore Ethiopia</title>

  <!-- CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/contact.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css "
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypAS1Q..." 
        crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Page-Specific Styles -->
  <style>
    .contact-form {
      max-width: 500px;
      margin: 80px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .contact-form h2 {
      color: #0b3d91;
      margin-bottom: 20px;
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
      transition: background-color 0.3s ease;
    }

    .contact-form button:hover {
      background-color: #092c6c;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h1>Ethiopia</h1>
    <nav class="navbar">
      <ul class="nav-list">
        <li><a href="../html/index.html">Home</a></li>
        <li><a href="../html/about.html">About</a></li>
        <li><a href="../html/place.html">Places</a></li>
        <li><a href="../html/gallery.html">Gallery</a></li>
        <li><a href="contact.php" class="active">Contact</a></li>
        <li><a href="login.php">Login</a></li>
        
      </ul>
    </nav>
  </header>

  <!-- Contact Form -->
  <main>
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
  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <!-- Left: Company Info -->
      <div class="footer-left">
        <img src="../image/logo.png" alt="Logo" class="footer-logo" />
        <p class="footer-description">
          Explore Ethiopia is your gateway to discovering the rich culture, history, and natural beauty of Ethiopia.
        </p>
      </div>

      <!-- Middle: Contact Info -->
      <div class="footer-middle">
        <h3>Contact Us</h3>
        <ul class="contact-info">
          <li><i class="fas fa-phone"></i> +01 (123) 4567 90</li>
          <li><i class="fas fa-envelope"></i> info@exploreethiopia.com</li>
          <li><i class="fas fa-map-marker-alt"></i> Addis Ababa, Ethiopia</li>
        </ul>
      </div>
    </div>

    <!-- Bottom: Copyright & Social Media -->
    <div class="footer-bottom">
      <p class="copyright">&copy; 2025 Explore Ethiopia. All rights reserved.</p>
      <div class="social-icons">
        <a href="https://www.facebook.com/ExploreEthiopia " target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="mailto:info@exploreethiopia.com"><i class="fas fa-envelope"></i></a>
        <a href="https://telegram.me/ExploreEthiopia " target="_blank"><i class="fab fa-telegram-plane"></i></a>
        <a href="https://www.instagram.com/ExploreEthiopia " target="_blank"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </footer>

  <!-- JS -->
  <script src="../js/contact.js"></script>
</body>
</html>