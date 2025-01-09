<?php
include 'db_connection.php';

// Pagination setup
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

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
    <title>Contact Form Submissions</title>
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
            margin: 0 5px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
        }

        .pagination a:hover {
            background-color: #f0f0f0;
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
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $pages; $i++) { ?>
            <a href="view_data.php?page=<?php echo $i; ?>">Page <?php echo $i; ?></a>
        <?php } ?>
    </div>
</body>

</html>