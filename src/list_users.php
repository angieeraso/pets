<?php
require('../config/database.php');

// Manejo de eliminación de usuarios
if (isset($_GET['delete_id'])) {
    $user_id = intval($_GET['delete_id']);
    
    // Realizar la eliminación del usuario
    $query_delete = "DELETE FROM users WHERE id = $user_id";
    
    $result_delete = pg_query($conn, $query_delete);

    if ($result_delete) {
        // Redirigir de nuevo a la lista de usuarios con un mensaje de éxito
        header('Location: ' . $_SERVER['PHP_SELF'] . '?message=User deleted successfully');
        exit;
    } else {
        // Manejo de errores
        $error_message = "Error deleting user: " . pg_last_error($conn);
    }
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Pets | List users</title>
</head>
<body>
    <center><h1>LIST USERS</h1></center>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($_GET['message']); ?>
        </div>
    <?php elseif (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fullname</th>
                <th>Email</th>
                <th>Status</th>
                <th>Foto</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query_users = "
                    SELECT 
                        id,
                        fullname,
                        email,
                        CASE 
                            WHEN status = true THEN 'Active' ELSE 'Inactive' 
                        END as status  
                    FROM 
                        users
                ";
                $result = pg_query($conn, $query_users);

                if (!$result) {
                    echo "<tr><td colspan='5'>Error retrieving users: " . pg_last_error($conn) . "</td></tr>";
                } else {
                    while($row = pg_fetch_assoc($result)){
                        echo "<tr>";
                            echo "<td>". htmlspecialchars($row['fullname']) ."</td>";
                            echo "<td>". htmlspecialchars($row['email']) ."</td>";
                            echo "<td>". htmlspecialchars($row['status']) ."</td>";
                            echo "<td><img src='icons/profile.png' width='30' alt='Profile'></td>";
                            echo "<td>
                                <a href='#'><img src='icons/edit.png' width='20' alt='Edit'></a>
                                <a href='" . $_SERVER['PHP_SELF'] . "?delete_id=" . htmlspecialchars($row['id']) . "' onclick=\"return confirm('Are you sure you want to delete this user?');\"><img src='icons/delete.png' width='20' alt='Delete'></a>
                            </td>";
                        echo "</tr>";
                    }
                }
            ?>
        </tbody>
    </table>     
</body>
</html>
