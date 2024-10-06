<html>
<head>
    <title>View News</title>
    <meta http-equiv="Content-Type" content="text/html; charset="iso"-8859-1">
</head>
<body>
<?php
$link = getLink($mysqli);
$query = "SELECT id, headline, timestamp FROM news ORDER BY timestamp DESC";
$result = @mysqli_query($query);
if(!$result){
    echo('Error selecting news: '); printf("Errormessage: %s\n", $mysqli->error);;
    exit();
}
if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_object($result))
    {
        ?>
        <font size="-1"><b><?php echo $row->headling; ?></b> <i><?php echo formatDate($row->timestamp); ?></i></font>
        <?php
    }
}else{
    ?>
    <font size="-2">No news in the database</font>
<?php }
mysqli_close($link); ?>
</body>
</html>
