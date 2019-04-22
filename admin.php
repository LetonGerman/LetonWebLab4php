<html>

<head>
    <title>Hello World</title>
</head>

<body>
<?php
$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'shiestwind';
if (isset($_POST['article-id'])) {
// prevent SQL injection

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($conn , 'TUTORIALS');
$articleId = mysqli_real_escape_string($conn, $_POST['article-id']);
$res = mysqli_query($conn,'DELETE FROM tutorials_news WHERE id='.$articleId);

if (!$res) {
die(mysqli_error($conn));
}
    mysqli_close($conn);
}

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_select_db($conn , 'TUTORIALS');

$sql = 'SELECT * FROM tutorials_news';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        ?>
    <div>
        <?php
        echo "<p>" . "Headline: " . $row["headline"] . "</p>";
        echo "<p>" . $row["text"] . "</p>";
        echo "<hr>";
        ?>
        <form method="post">
            <input type="hidden" name="article-id" value="<?php echo $row['id'] ?>"/>
            <input type="submit" value="Delete article"/>
        </form>
    </div>
        <?php
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>

</body>

</html>