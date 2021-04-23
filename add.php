<?php

    include 'database.php';

    $db = new Database();

    $add_message = '';

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        if (
            empty( $_POST['first_name'] ) ||
            empty( $_POST['last_name'] ) 
        ) {
            $add_message = 'Molimo popunite sva polja';
        } else {
            $db->add_clan( $_POST );
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add user</title>
</head>

<body>
    <h2>Dodavanje člana</h2>
    <p>
        <?php if ( !empty( $add_message ) ) {
                echo $add_message;
        }?>
    <form method="post">
        <label for="">Ime</label><br>
        <input type="text" name="first_name" placeholder="Unesi ime">
        <br><br>
        <label for="">Prezime</label><br>
        <input type="text" name="last_name" placeholder="Unesi prezime">
        <br><br><br>
        <input type="submit" value="Dodaj u bazu podataka">
    </form>
    </p>
</body>

</html>