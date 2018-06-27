<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Sketch</title>
</head>
<body>
    <h1>Welcome to SKETCH framework!!!</h1>
    <h2>SK Config:</h2>
    <?php
        foreach ($SK_props as $key=>$value) {
            echo "<h4>".$key.":";
            var_dump($value);
            echo "</h4>";
        }
    ?>
</body>
</html>
