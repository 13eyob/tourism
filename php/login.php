<?php
session_start();

// Redirect logged-in users
if(isset($_SESSION['user'])) {
    header("Location: user_dashboard.php");
    exit();
} elseif(isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php"); 
    exit();
}

$error = '';

// Simple database configuration (create db_config.php for production)
$db_config = [
    'host' => 'localhost',
    'db'   => 'ethiopia_tourism',
    'user' => 'root',
    'pass' => '',
    'charset' => 'utf8mb4'
];

// Process login
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Temporary database connection (replace with db_config.php include in production)
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['db']};charset={$db_config['charset']}";
        $pdo = new PDO($dsn, $db_config['user'], $db_config['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        
        // For testing: Bypass to admin dashboard
        $_SESSION['admin'] = [
            'username' => 'admin',
            'role' => 'admin',
            'is_approved' => 1
        ];
        header("Location: admin_dashboard.php");
        exit();
        
     
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        if($user && password_verify($password, $user['password'])) {
            if($user['role'] == 'admin') {
                $_SESSION['admin'] = $user;
                header("Location: admin_dashboard.php");
                exit();
            } else {
                if($user['is_approved']) {
                    $_SESSION['user'] = $user;
                    header("Location: user_dashboard.php");
                    exit();
                } else {
                    $error = "Account pending approval";
                }
            }
        } else {
            $error = "Invalid credentials";
        }
        
    } catch (PDOException $e) {
        // If database connection fails, still allow admin access for testing
        if($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
            $_SESSION['admin'] = [
                'username' => 'admin',
                'role' => 'admin'
            ];
            header("Location: admin_dashboard.php");
            exit();
        }
        $error = "System temporarily unavailable";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Explore Ethiopia</title>
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .login-box {
      max-width: 500px;
      margin: 80px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin-top: 120px;
    }
    .login-box h2 { color: #0b3d91; margin-bottom: 20px; }
    .login-box input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
    .login-box button { width: 100%; padding: 10px; background-color: #0b3d91; color: white; border: none; border-radius: 5px; cursor: pointer; }
    .login-box button:hover { background-color: #092c6c; }
    .error-message { color: red; margin-bottom: 15px; }
  </style>
</head>
<body>
  

  <div class="login-box">
    <h2>Login</h2>
    <?php if (!empty($error)): ?>
      <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password " required>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
  </div>
  <script src="../js/script.js"></script>
</body>
</html>