<?php
include 'db_connection.php';

// Pagination setup
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Handle note updates
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_note'])) {
    $id = intval($_POST['id']);
    $note = $conn->real_escape_string($_POST['note']);
    $updateSql = "UPDATE contact_us SET note='$note' WHERE id=$id";
    $conn->query($updateSql);
}

// Fetch data
$sql = "SELECT * FROM contact_us LIMIT $start, $limit";
$result = $conn->query($sql);

// Count total records
$countResult = $conn->query("SELECT COUNT(*) as count FROM contact_us");
$total = $countResult->fetch_assoc()['count'];
$pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prelette | Responses</title>
    <link rel="icon" type="image/x-icon" href="assets/imgs/logo/fav.png">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .pagination a {
            margin: 20px 10px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
        }

        .pagination a:hover {
            background-color: #f0f0f0;
        }

        .note-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .note-form input[type="text"] {
            width: 100%;
            padding: 5px;
        }

        .note-form button {
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Contact Form Submissions</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td>
                        <form method="POST" class="note-form">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="text" name="note" value="<?php echo $row['note'] ?? ''; ?>">
                            <button type="submit" name="update_note">Save</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++) { ?>
            <a href="view_page.php?page=<?php echo $i; ?>">Page <?php echo $i; ?></a>
        <?php } ?>
    </div>
</body>

</html>