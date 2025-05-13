<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ethiopia";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Insert place
if (isset($_POST['add_place'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $duration = $_POST['duration'];
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($image_tmp, "../images/" . $image_name);

    $sql = "INSERT INTO places (name, location, description, image, cost, duration) 
            VALUES ('$name', '$location', '$description', '$image_name', '$cost', '$duration')";
    $conn->query($sql);
    header("Location: manage_places.php");
}

// Delete place
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM places WHERE id = $id");
    header("Location: manage_places.php");
}

// Update place
if (isset($_POST['update_place'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $duration = $_POST['duration'];

    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, "../images/" . $image_name);
        $sql = "UPDATE places SET name='$name', location='$location', description='$description',
                image='$image_name', cost='$cost', duration='$duration' WHERE id=$id";
    } else {
        $sql = "UPDATE places SET name='$name', location='$location', description='$description',
                cost='$cost', duration='$duration' WHERE id=$id";
    }

    $conn->query($sql);
    header("Location: manage_places.php");
}

// Get data for editing
$edit = false;
$edit_data = [];
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM places WHERE id = $id");
    $edit_data = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Places</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
        h2 { text-align: center; color: #333; }
        form, .search-form { background: #fff; padding: 20px; max-width: 600px; margin: 10px auto; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; box-sizing: border-box; }
        input[type="submit"] { background: #28a745; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #218838; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; background: #fff; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #007BFF; color: white; }
        a.delete-btn { color: red; text-decoration: none; }
        a.edit-btn { color: #007BFF; text-decoration: none; }
        img { border-radius: 4px; max-height: 80px; }
        .search-form input[type="text"] { width: 75%; display: inline-block; }
        .search-form input[type="submit"] { width: 20%; display: inline-block; }
        .show-all-btn {
            display: inline-block;
            background: #007BFF;
            color: white;
            padding: 9px 16px;
            margin-left: 10px;
            border-radius: 5px;
            text-decoration: none;
        }
        .action-links a {
            margin: 0 5px;
        }
    </style>
</head>
<body>

<h2>Manage Tourism Places</h2>

<!-- Search Form -->
<form class="search-form" method="GET" action="manage_places.php">
    <input type="text" name="search" placeholder="Search by Name or Location" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <input type="submit" value="Search">
    <a href="manage_places.php" class="show-all-btn">Show All</a>
</form>

<!-- Insert / Update Form -->
<form action="manage_places.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $edit ? $edit_data['id'] : '' ?>">
    <input type="text" name="name" placeholder="Place Name" value="<?= $edit ? $edit_data['name'] : '' ?>" required>
    <input type="text" name="location" placeholder="Location" value="<?= $edit ? $edit_data['location'] : '' ?>" required>
    <textarea name="description" placeholder="Description" required><?= $edit ? $edit_data['description'] : '' ?></textarea>
    <input type="file" name="image">
    <input type="number" step="0.01" name="cost" placeholder="Cost" value="<?= $edit ? $edit_data['cost'] : '' ?>" required>
    <input type="text" name="duration" placeholder="Duration (e.g. 3 days)" value="<?= $edit ? $edit_data['duration'] : '' ?>" required>
    <input type="submit" name="<?= $edit ? 'update_place' : 'add_place' ?>" value="<?= $edit ? 'Update Place' : 'Add Place' ?>">
</form>

<!-- Data Table -->
<table>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Location</th>
        <th>Description</th>
        <th>Cost</th>
        <th>Duration</th>
        <th>Action</th>
    </tr>
    <?php
    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
    $query = "SELECT * FROM places";
    if (!empty($search)) {
        $query .= " WHERE name LIKE '%$search%' OR location LIKE '%$search%'";
    }
    $query .= " ORDER BY created_at DESC";

    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td><img src='../image/{$row['image']}' alt='No image'></td>
                <td>{$row['name']}</td>
                <td>{$row['location']}</td>
                <td>{$row['description']}</td>
                <td>{$row['cost']}</td>
                <td>{$row['duration']}</td>
                <td class='action-links'>
                    <a class='edit-btn' href='manage_places.php?edit={$row['id']}'>Edit</a> |
                    <a class='delete-btn' href='manage_places.php?delete={$row['id']}' onclick='return confirm(\"Delete this place?\")'>Delete</a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No places found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
