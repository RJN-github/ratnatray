<?php
$datetime = "";
    if (!isset($_POST['Submit'])) {
        $date = $_POST['date'];
        $datetime = "$date" . "<br>"."23:59:59";
    }
    else{
        echo "heello";
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
    <form action="sample.php" method="post">
        <input type="date" name="date" id="">
        <input type="submit" value="Submit">
        <p><?php echo $datetime;?></p>
    </form>
</body>
</html>
