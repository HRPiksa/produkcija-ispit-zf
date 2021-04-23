<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'DotEnv.php';

class Database
{
    private $connection;

    public function __construct()
    {
        if (file_exists(__DIR__ . '/.env')) {
            $dotenv = new DotEnv(__DIR__ . '/.env');
            $dotenv->load();
        }

        $dbhost = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $dbuser = getenv('DB_USER');
        $dbpass = getenv('DB_PASS');

        $dsn = "mysql:host=" . $dbhost . ";dbname=" . $dbname;

        try {
            $pdo = new PDO($dsn, $dbuser, $dbpass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->connection = $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get_clanovi()
    {
        $users = array();

        try {
            $stmt = $this->connection->prepare("
            SELECT * FROM clanovi
            ");

            $stmt->execute();

            if ($stmt->rowCount()) {
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            return $users;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get_clan($id)
    {
        $user = array();

        try {
            $stmt = $this->connection->prepare("
            SELECT * FROM clanovi
            WHERE id = :id
            ");

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            if ($stmt->rowCount()) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function add_clan($params)
    {
        try {
            $firstname = $params['first_name'];
            $lastname = $params['last_name'];

            $stmt = $this->connection->prepare("
            INSERT INTO clanovi
            (ime, prezime)
            VALUES
            ( :firstName, :lastName)
            ");

            $stmt->bindParam(':firstName', $firstname);
            $stmt->bindParam(':lastName', $lastname);

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        header('Location: index.php');
    }

    public function update_clan($params)
    {
        try {
            $id = $params['id'];
            $firstname = $params['first_name'];
            $lastname = $params['last_name'];

            $stmt = $this->connection->prepare("
            UPDATE clanovi SET ime = :firstName,
            prezime = :lastName
            WHERE id = :id
            ");

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':firstName', $firstname);
            $stmt->bindParam(':lastName', $lastname);

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        header('Location: index.php');
    }

    public function delete_clan($params)
    {
        try {
            $id = $params['id'];

            $stmt = $this->connection->prepare("
            DELETE FROM clanovi
            WHERE id = :id
            ");

            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        header('Location: index.php');
    }
}
