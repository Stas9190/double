<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=testing_system', 'root', '');
    foreach ($dbh->query("Select * From users") as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print_r($e->getMessage());
    die();
}
