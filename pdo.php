<link rel="stylesheet" href="https://cdn.simplecss.org/simple-v1.css">
<?php
/*
READ:-SELECT name,email from cards where id=10;
CREATE:INSERT INTO CARDS (name,email) VALUE("Tibi","tibi@mzsrk.hu");
UDPATE: UPDATE cards set email="tibi2025@mzsrk.hu" where id=10;
-DELETE:DElETE from card Where id=10;

Creata Database busnisscards;
use busnisscards;

create table cards(
    `id` Int unsigned primary key auto_increment,
    `name` Varchar(100) not NUll,
    `companyname` Varchar(100) default NUll,
    `phone`Varchar(20) default NUll,
    `email` Varchar(100) default NUll,
    `photo`Varchar(20) default NUll,
    `status`Varchar(20) default NUll,
    `note` text 
) Engine=InnoDB default charset=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
 */
$dsn='mysql:host=localhost;dbname=busnisscards;charset=utf8';
$user='root';
$pass='';
try {
    $pdo=new PDO($dsn,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "sikere";;
} catch (PDOException $ex) {
    echo "Kapcs hiba: {$ex->Getmessage()}";
}
$name="P";
$companyName="cég";
$phone="063062054104";
$email="valami@valami.com";
$photo=null;
$note="valamideaznagyon";
//$sql ="INSERT INTO cards (`name`,`companyName`,phone,email,photo,note) values('$name','$companyName','$phone','$email','$photo','$note')";
echo "<br>";
$sql="INSERT INTO cards (`name`,`companyName`,phone,email,photo,note) values(?,?,?,?,?,?)";
$stmt=$pdo->prepare($sql);
$stmt->execute([$name,$companyName,$phone,$email,$photo,$note]);
$sql="SELECT * FROM cards where id=11";

$result = $pdo->query($sql);
$card = $result->fetch(PDO::FETCH_ASSOC);
print_r($card);



//$pdo->exec($sql);
?>