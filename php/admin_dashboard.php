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
    <style>
        .dashboard-links {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 40px;
        }
        .dashboard-links a {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            text-decoration: none;
            background-color: #007BFF;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }
        .dashboard-links a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav class="navbar">
            <ul class="nav-list">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h2>Welcome, <?php echo $_SESSION['admin']['username']; ?></h2>

        <div class="dashboard-links">
            <a href="manage_places.php">Manage Places</a>
            <a href="manage_contact.php" class="btn">Manage Contact Messages</a>
            <a href="manage_bookings.php">Manage Bookings</a>
        </div>
    </main>
</body>
</html>
