<html>

<head>
    <title>Hello World</title>
</head>

<body>

<div id = "main">
    <form action = "" method = "post">
        <label>Name :</label>
        <input type = "text" name = "headline" id = "headline" />
        <br>
        <br>
        <input type = "text" name = "body" id = "body" />
        <br>
        <br>
        <input type = "submit" value ="Submit" name = "submit"/>
        <br />
    </form>
</div>

<?php $dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'shiestwind';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully<br>';
/*$sql = "CREATE DATABASE TUTORIALS";

if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}*/

mysqli_select_db($conn , 'TUTORIALS');

$sql = 'SELECT * FROM tutorials_news';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<p>" . "Headline: " . $row["headline"] . "</p>";
        echo "<p>" . $row["text"] . "</p>";
        echo "<hr>";
    }
} else {
    echo "0 results";
}

$exists = mysqli_query($conn, 'SELECT 1 FROM tutorials_news');
if ($exists == FALSE) {

    $sql = "create table tutorials_news(
            id INT AUTO_INCREMENT, 
            headline VARCHAR(255) NOT NULL,
            text TEXT,
            datePublished datetime NOT NULL, 
            primary key (id))";

    if (mysqli_query($conn, $sql)) {
        echo "Table created successfully";
    } else {
        echo "Table is not created successfully ";
    }
}
/*$sql = "drop table tutorials_inf";

if(mysqli_query($conn, $sql)){
    echo "Table dropped successfully";
} else {
    echo "Table is not dropped successfully ";
}*/
mysqli_close($conn);
?>
<?php
if(isset($_POST["submit"])) {

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($conn , 'TUTORIALS');
    $now = time();
    $sql = "INSERT IGNORE INTO tutorials_news (headline, text, datePublished) VALUES ('" . $_POST["headline"] . "', '" . $_POST["body"] . "', '" . $now . "')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

</body>

</html>