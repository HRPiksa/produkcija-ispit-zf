<?php

    include 'database.php';

    if (
        !isset( $_GET['id'] ) ||
        empty( $_GET['id'] ) ||
        !is_numeric( $_GET['id'] )

    ) {
        header( 'Location: index.php' );
    }

    $db = new Database();

    $get_user = $db->get_clan( $_GET['id'] );

    $delete_message = '';

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if (
            empty( $_POST['id'] ) ||
            empty( $_POST['first_name'] ) ||
            empty( $_POST['last_name'] )
        ) {
            $delete_message = 'Molimo popunite sva polja';
        } else {
            $db->delete_clan( $_POST );
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete user</title>
</head>

<body>
    <h2>Brisanje člana</h2>
    <p>
        <?php if ( !empty( $delete_message ) ) {
                echo $delete_message;
        }?>
    <form method="POST">
        <input type="text" name="id" value="<?php echo $get_user['id'] ?> " hidden>
        <br><br>
        <label for="">Ime</label><br>
        <input type="text" name="first_name" value="<?php echo $get_user['ime'] ?> " readonly>
        <br><br>
        <label for="">Prezime</label><br>
        <input type="text" name="last_name" value="<?php echo $get_user['prezime'] ?> " readonly>
        <br><br><br>
        <input type="submit" value="Obriši u bazi podataka">

    </form>
    </p>
</body>

</html>