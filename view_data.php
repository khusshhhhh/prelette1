<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include 'db_connection.php';

$searchQuery = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_note'])) {
    $id = intval($_POST['id']);
    $note = $conn->real_escape_string($_POST['note']);
    $conn->query("UPDATE contact_us SET note='$note' WHERE id=$id");
}

$sql = "SELECT * FROM contact_us";
if (!empty($searchQuery)) {
    $sql .= " WHERE name LIKE '%$searchQuery%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prelette | Admin Dashboard</title>
    <link rel="shortcut icon" href="./assets/imgs/logo/fav.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        <div class="bg-dark text-white p-4 vh-100" style="width: 250px;">
            <h4 class="mb-4">Prelette</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="indexp.html" class="nav-link text-white">Website</a></li>
                <li class="nav-item"><a href="view_data.php" class="nav-link text-white">View Data</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white">Report</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link text-white">Logout</a></li>
            </ul>
        </div>

        <div class="container-fluid p-4">
            <h3>Welcome, Khush & Kavan!</h3>
            <form method="GET" class="input-group my-3">
                <input type="text" name="search" class="form-control" placeholder="Search by Name"
                    value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit" class="btn btn-warning">Search</button>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bg-warning text-white">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th class="message-column">Message</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <td class="message-column">
                                    <div class="overflow-auto" style="max-height: 100px; max-width: 150px;">
                                        <?php echo $row['message']; ?>
                                    </div>
                                </td>
                                <td>
                                    <form method="POST" class="d-flex">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <textarea class="form-control" name="note"><?php echo $row['note']; ?></textarea>
                                        <button type="submit" name="update_note" class="btn btn-success ms-2">Save</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>