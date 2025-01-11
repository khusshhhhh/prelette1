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

// Search functionality
$searchQuery = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM contact_us WHERE name LIKE '%$searchQuery%' LIMIT $start, $limit";
    $countResult = $conn->query("SELECT COUNT(*) as count FROM contact_us WHERE name LIKE '%$searchQuery%'");
} else {
    $sql = "SELECT * FROM contact_us LIMIT $start, $limit";
    $countResult = $conn->query("SELECT COUNT(*) as count FROM contact_us");
}

$result = $conn->query($sql);
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
</head>

<body>
    <h1>Contact Form Submissions</h1>

    <form method="GET" class="search-form">
        <input type="text" name="search" placeholder="Search by Name"
            value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit">Search</button>
    </form>

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
            <a href="view_page.php?page=<?php echo $i; ?>&search=<?php echo urlencode($searchQuery); ?>">Page
                <?php echo $i; ?></a>
        <?php } ?>
    </div>
</body>

</html>