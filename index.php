<?php
    include 'database.php';

    $db = new Database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Članovi</title>
</head>

<body>
    <h2>Popis članova</h2>

    <table border="1">
        <tr>
            <th>#</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th colspan="2">Akcija</th>
        </tr>
        <?php
            $users = $db->get_clanovi();
        ?>

        <?php if ( !empty( $users ) ): ?>
            <?php foreach ( $users as $user ): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['ime']; ?></td>
                    <td><?php echo $user['prezime']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $user['id']; ?>"> Edit</a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo $user['id']; ?>"> Delete</a>
                    </td>
                </tr>
            <?php endforeach;?>
        <?php endif;?>
    </table>

    <br>

    <a href="add.php"><button>Dodavanje člana</button></a>
    
    <br><br><br><br><br>
    Ovo je dodao predavač!
</body>

</html>
