<?php
// Admin Dashboard
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

require_once "db.php";

$orders_result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
$messages_result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Adolphe HOPE Hotel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1>Admin Dashboard</h1>
            <div class="admin-header-right">
                <p>Welcome, <?php echo $_SESSION["admin_username"]; ?></p>
                <a href="logout.php">Logout</a>
            </div>
        </header>

        <div class="admin-card">
            <h2>Customer Orders <span><?php echo $orders_result->num_rows; ?></span></h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Menu Item</th>
                        <th>Address</th>
                        <th>Order Date</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $orders_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo htmlspecialchars($row["full_name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                        <td><?php echo htmlspecialchars($row["menu_item"]); ?></td>
                        <td><?php echo htmlspecialchars($row["address"]); ?></td>
                        <td><?php echo $row["order_date"]; ?></td>
                        <td><?php echo $row["created_at"]; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="admin-card">
            <h2>Contact Messages <span><?php echo $messages_result->num_rows; ?></span></h2>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Message</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $messages_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo htmlspecialchars($row["full_name"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                        <td><?php echo htmlspecialchars($row["location"]); ?></td>
                        <td><?php echo htmlspecialchars($row["message"]); ?></td>
                        <td><?php echo $row["created_at"]; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>