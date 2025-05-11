<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav class="navbar">
            <ul class="nav-list">
                <!-- Your admin menu items here -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h2>Welcome, <?php echo $_SESSION['admin']['username']; ?></h2>
        <!-- Admin content here -->
    </main>
</body>
</html>