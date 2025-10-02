<link rel="stylesheet" href="https://cdn.simplecss.org/simple-v1.css">
<?php
/**
 * CRUD: CREATE READ UPDATE DELETE
 * 
 * tfh: van egy cards tablam amiben van name email es id mezo
 * 
 * backtick `
 * 
 * 1. mysql
 * - READ: SELECT name, email FROM cards WHERE id=10;
 * - CREATE: INSERT INTO cards (`name`, `email`) VALUES ('tibi','tibi@mzsrk.hu');
 * - UPDATE: UPDATE cards SET email = 'tibi2004@mzsrk.hu' WHERE id = 10;
 * - DELETE: DELETE FROM cards WHERE id = 10;

*/
/*
CREATE DATABASE businesscards;

use businesscards;

CREATE table cards(
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `companyName` VARCHAR(100) DEFAULT NULL,
    `phone` VARCHAR(20) DEFAULT NULL,
    `email` VARCHAR(100) DEFAULT NULL,
    `photo` VARCHAR(255) DEFAULT NULL,
    `status` VARCHAR(20) DEFAULT NULL,
    `note` TEXT DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
 */

//data source name
$dsn = 'mysql:host=localhost;dbname=busnisscards;charset-utf8';
$user = 'root';
$pass = '';

try{
    $pdo = new PDO($dsn, $user, $pass);
    //Hiba mód : exception dobasa hiba eseten;
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "sikeres kapcs";
    //xss vedekezes a htmlspecialchars-al
    //xss($pdo);
    //sql_injection
    //sql_injection($pdo);
    echo "<br>";
    //prepared_statement($pdo); //védekezés sql injection ellen
    checked_insert($pdo);
} catch(PDOException $ex){
    echo "kapcs hiba {$ex->getMessage()}";
    exit();
}
function xss($pdo){
    $name="odett";
    $companyName=htmlspecialchars("<script>alert(\"idk\")</script>");
    $phone="06205667898";
    $email="valami@gmail.com";
    $photo=null;
    $note="webfejleszto";
    $sql = "INSERT INTO cards(`name`,companyName,phone,email,photo,note)
            VALUES ('$name','$companyName','$phone','$email','$photo','$note')";
    $pdo->exec($sql);
    $sql = "SELECT * FROM cards WHERE name = 'odett'";
    $result = $pdo->query($sql);
    $card = $result->fetch(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($card);
}
function sql_injection($pdo){
    $name_i="' OR '1' = '1";
    $sql = "SELECT * FROM cards WHERE name = '$name_i'";
    $result = $pdo->query($sql);
    $card = $result->fetchAll(PDO::FETCH_ASSOC);
    echo "<br>";
    print_r($card);
    //$sql = "INSERT INTO cards(`name`,companyName,phone,email,photo,note)
    //        VALUES (?,?,?,?,?,?)";
    //$pdo->exec($sql);
}
function prepared_statement($pdo)
{
$name_i = "' OR '1' = '1";
$sql = "SELECT * FROM cards WHERE name = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name_i]);
$card = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($card);
    //$sql = "INSERT INTO cards(`name`,companyName,phone,email,photo,note) VALUES (?,?,?,?,?,?)";
    //$pdo->exec($sql);
}
function checked_insert($pdo)
{
    $name = "patrik";
    $companyName = htmlspecialchars("<script>alert(\"asf\")</script>");
    $phone = "0630934534";
    $email = "vali@gmail.com";
    $photo = null;
    $note = "igen";

    // Biztonságos prepared statement használata
    $sql = "INSERT INTO cards (`name`, `companyName`, `phone`, `email`, `photo`, `note`) 
            VALUES (:name, :companyName, :phone, :email, :photo, :note)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':companyName' => $companyName,
        ':phone' => $phone,
        ':email' => $email,
        ':photo' => $photo,
        ':note' => $note
    ]);

    // Ha szeretnél visszaolvasni az új rekordot:
    $lastId = $pdo->lastInsertId();
    $stmt = $pdo->prepare("SELECT * FROM cards WHERE id = :id");
    $stmt->execute([':id' => $lastId]);
    $card = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<br>";
    print_r($card);
}
?>