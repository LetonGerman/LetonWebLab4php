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
            <a class="nav-link flex-sm-fill text-sm-center" href="#about">Main page</a>
        </nav>
    </div>
</header>

<section class="container-fluid" id="contact">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <h1>Add new article</h1>
        </div>
        <form action="" method="POST">
            <div class="row d-flex justify-content-center">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Headline</span>
                    </div>
                    <input type="text" class="form-control" name="headline" id="headline" aria-label="headline" required>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Body</span>
                    </div>
                    <textarea class="form-control" name="body" id="body" aria-label="body" placeholder="What happened..." required></textarea>
                </div>
                <input class="btn btn-lg btn-outline-dark" type="submit" name="add" value="Add"/>
            </div>
        </form>
    </div>
</section>

<?php $dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = 'shiestwind';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

if(! $conn ) {
    die('Could not connect: ' . mysqli_error());
}
mysqli_select_db($conn , 'TUTORIALS');

$sql = 'SELECT * FROM tutorials_news';
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

<?php
if(isset($_POST["add"])) {

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($conn , 'TUTORIALS');
    $now = time();
    $sql = "INSERT IGNORE INTO tutorials_news (headline, text, datePublished) VALUES ('" . $_POST["headline"] . "', '" . $_POST["body"] . "', '" . $now . "')";

    if (mysqli_query($conn, $sql)) {
    } else {
        echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
    header('Location: '.$_SERVER['REQUEST_URI']);
}

if (isset($_POST["delete"])) {
// prevent SQL injection

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($conn , 'TUTORIALS');
    $articleId = mysqli_real_escape_string($conn, $_POST['article-id']);
    $res = mysqli_query($conn,'DELETE FROM tutorials_news WHERE id='.$articleId);

    if (!$res) {
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    header('Location: '.$_SERVER['REQUEST_URI']);
}
?>

</body>
</html>