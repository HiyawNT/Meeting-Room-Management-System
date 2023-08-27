<?php
// Include database connection
require_once "../config/config.php";

// Check if the room ID is set and numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $room_id = $_GET['id'];

    // Check if the user confirmed the delete action
    if (isset($_POST['confirm_delete'])) {
        // Prepare a DELETE statement to remove the room from the database
        $sql = "DELETE FROM rooms WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$room_id]);

        // Redirect to rooms.php after deleting the room
        header("Location: ../admin/rooms.php");
        exit();
    }

    // Fetch the room details from the database
    $stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
    $stmt->execute([$room_id]);
    $room = $stmt->fetch();

    // Check if the room exists
    if (!$room) {
        // Room not found
        header("Location: rooms.php?error=room_not_found");
        exit();
    }
} else {
    // Invalid request
    header("Location: rooms.php?error=invalid_request");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Room</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        #confirmation {
            margin: 0 auto;
            margin-top: 50px;
            max-width: 500px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #d1d1d1;
            text-align: center;
        }

        #confirmation p {
            margin-top: 20px;
        }

        #confirmation button {
            margin-top: 20px;
        }

        #confirmation a {
            margin-top: 20px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div id="confirmation">
        <h1>Delete Room</h1>
        <p>Are you sure you want to delete the room "<?php echo $room['name']; ?>"?</p>
        <form action="delete_rooms_handler.php?id=<?php echo $room_id; ?>" method="post">
            <button type="submit" name="confirm_delete" class="btn btn-danger">Confirm</button>
            <a href="../admin/rooms.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
