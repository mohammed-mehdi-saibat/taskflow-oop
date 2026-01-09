<?php

require 'app/Core/Database.php';

use App\Core\Database;

echo "---Testing Database Connection---\n";

try {
    $db1 = Database::getInstance();
    echo "FIRST INSTANCE CREATED\n";

    $db2 = Database::getInstance();
    echo "SECOND INSTANCE CREATED\n";

    if ($db1 === $db2) {
        echo "INSTANCES ARE IDENTICAL\n";
    } else {
        echo "INSTANCES ARE DIFFERENT!!";
    }

    $pdo = $db1->getConnection();
    echo "PDO connection success! Connected to database!\n";
} catch (Exception $e) {
    echo "ERROR" . $e->getMessage();
}
