<?php
include 'header.php';
include 'db_connection.php';

$sql = "SELECT * FROM client";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <h2>Client List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['Client_ID']}</td>
                            <td>{$row['First_Name']}</td>
                            <td>{$row['Last_Name']}</td>
                            <td>{$row['Gender']}</td>
                            <td>
                                <a href='client_form.php?id={$row['Client_ID']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_client.php?id={$row['Client_ID']}' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No clients found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="clientRegistration/clientRegistration.php" class="btn btn-primary">Add New Client</a>
</div>

<?php include 'footer.php'; ?>
