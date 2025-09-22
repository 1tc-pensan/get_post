<?php  // Opcionális tisztítási műveletek
$datafile = 'data.txt';
$logfile = 'log.txt';
$massage = '';
try {
    if (file_exists($datafile)) 
        {
            $currentContent = file_get_contents($datafile);
        } 
    else 
        {
            throw new Exception("Hiba a fájl olvasásakor.");
        }
} catch (Exception $e) {
    $errorMessage = "Hiba történt: " . $e->getMessage();
    file_put_contents($logfile, $errorMessage . PHP_EOL, FILE_APPEND);
    $currentContent = "Hiba történt a fájl olvasásakor.";
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
</body>
</html>