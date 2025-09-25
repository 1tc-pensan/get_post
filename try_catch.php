<link rel="stylesheet" href="https://cdn.simplecss.org/simple-v1.css">
<?php  // Opcionális tisztítási műveletek
$datafile = 'data.txt';
$logfile = 'log.txt';
$massage = '';
$errorMessage = '';
try {
    if (file_exists($datafile)) 
        {
            $currentContent = file_get_contents($datafile);
        } 
    else 
        {
            throw new Exception("Hiba a fájl olvasásakor.");
        }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newdata'])) {
        $newdata = $_POST['newdata'];
        if (file_put_contents($datafile, $newdata) !=false) 
            {
            $massage = "Adatok sikeresen mentve.";
            //Napolozás
            $currentTime=date("Y-m-d H:i:s");
            $logentry="{[$currentTime]} Módosítás történt a {$datafile} fájl tartalmába";
            if (file_put_contents($logfile,$logentry,FILE_APPEND | LOCK_EX)==false) 
            {
                throw new Exception("Nem sikerült a $logfile napzolása");
            }
        } else {
            throw new Exception("Az $datafile nem lehezt üres");
        }
    }
} catch (Exception $e) {
    $errorMessage = "Hiba történt: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>A data.txt tartalma</h2>
    <?php
    if (isset($errorMessage)) {
        echo "<p style='color:red;'>$errorMessage</p>";
    }
    ?>
    <pre><?php echo htmlspecialchars($currentContent); ?></pre>
    <h2>Módosítás</h2>
    <form action="" method="post">
        <label for="newdata">Új adatok (Név:Kor formátumban):</label><br>
        <textarea type="text" name="newdata" id="newdata" cols="30" rows="10">
            <?php echo htmlspecialchars($currentContent); ?>
        </textarea>
        <button type="submit">Mentés</button>
    </form>
</body>
</html>