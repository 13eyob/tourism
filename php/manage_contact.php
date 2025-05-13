<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ethiopia");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = "";

// Delete message
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM contact WHERE id = $id");
    $success = "Message deleted successfully.";
}

// Reply message (simulated)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply_id'])) {
    $to = $_POST['email'];
    $message = $_POST['reply_message'];
    // Email logic goes here
    $success = "Reply sent to $to (simulated).";
}

// Fetch messages
$messages = $conn->query("SELECT * FROM contact ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Contact Messages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            padding: 10px;
            margin-bottom: 20px;
            border-left: 5px solid #28a745;
            color: #155724;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }
        .delete-btn { background-color: #dc3545; }
        .reply-btn  { background-color: #28a745; }
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        form.reply-form {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h1>Manage Contact Messages</h1>

    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $messages->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td>
                    <a href="?delete_id=<?= $row['id'] ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                </td>
            </tr>
            <tr>
                <td colspan="5">
                    <form method="POST" class="reply-form">
                        <input type="hidden" name="reply_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="email" value="<?= htmlspecialchars($row['email']) ?>">
                        <label><strong>Reply to <?= htmlspecialchars($row['email']) ?>:</strong></label>
                        <textarea name="reply_message" placeholder="Type your reply..." required></textarea>
                        <button type="submit" class="btn reply-btn">Send Reply</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>

<?php $conn->close(); ?>
