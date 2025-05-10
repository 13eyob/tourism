<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Explore Ethiopia</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body { font-family: Arial; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: white; padding: 30px; border-radius: 10px; width: 100%; max-width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1); text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #0b3d91; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #092c6c; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Register</h2>
        <?php
        session_start();
        if (!empty($_SESSION['error'])) {
            echo "<p style='color:red;'>".$_SESSION['error']."</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form action="process_register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Create Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>