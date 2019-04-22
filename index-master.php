<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <link crossorigin="anonymous" href="./css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>

    <title>Admin page</title>
</head>
<body>
<header class="container-fluid">
    <div class="row navbar-dark bg-light justify-content-center">
        <h2 class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 text-xl-left justify-content-left">
            Brainfeeder (Admin page)
        </h2>
        <nav class="nav nav-pills flex-row flex-md-row flex-lg-row flex-xl-row justify-content-right">
            <a class="nav-link flex-sm-fill text-sm-center" href="admin.project17.ru">Admin page</a>
        </nav>
    </div>
</header>

<?php $dbhost = '188.68.209.50';
$dbuser = 'root';
$dbpass = 'xwdf265k6h';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
mysqli_select_db($conn , 'news');

$sql = 'SELECT * FROM articles';
$result = mysqli_query($conn, $sql);
?>

<section class="container-fluid text-dark bg-light">
    <div class="row bg-light d-flex justify-content-center">
        <h1 id="about">Feed</h1>
    </div>
    <div class="text-sm-left text-md-left text-lg-left text-xl-left">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<h2>" . $row["headline"] . "</h2>";
                echo "<p>" . $row["text"] . "</p>";
                ?>
                <form action="" method="POST">
                    <input type="hidden" name="article-id" value="<?php echo $row['id'] ?>"/>
                    <input class="btn btn-outline-dark" name="delete" type="submit" value="Delete"/>
                </form>
                <hr>
                <?php
            }
        } else {
            echo "0 results";
        }
        mysqli_close($conn);
        ?>
    </div>
</section>

<footer class="mt-auto py-sm-3 py-md-3 py-lg-3 py-xl-3" id="footer-to-top">
    <div class="container-fluid d-flex justify-content-center">
        <a href="#" id="link-to-top"><h3 class="text-secondary">GO TO TOP</h3></a>
    </div>
</footer>

</body>
</html>