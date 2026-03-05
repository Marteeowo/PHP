<?php
session_start();
include("config.php");

$paring = "SELECT * FROM cars LIMIT 8";

if (isset($_GET["search"]) && $_GET["search"] != "") {
    $otsi = mysqli_real_escape_string($yhendus, $_GET["search"]);
    $paring .= " WHERE mark LIKE '%$otsi%' OR model LIKE '%$otsi%'";
}

$valjund = mysqli_query($yhendus, $paring);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Autod</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">Autorent</a>

        <form class="d-flex" method="GET">
            <input class="form-control me-2" 
                   type="search" 
                   name="search" 
                   placeholder="Otsi autot..."
                   value="<?php if(isset($_GET["search"])) echo $_GET["search"]; ?>">
            <button class="btn btn-outline-light" type="submit">Otsi</button>
        </form>
        <a href="admin/index.php" class="btn btn-light btn-sm">Logi sisse</a>
        </a>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
<?php
    $id = $_GET['id'];
    $paring = "SELECT * FROM cars WHERE id=".$id."";
    $valjund = mysqli_query($yhendus, $paring);
    $rida = mysqli_fetch_assoc($valjund);
    // print_r($rida);
?>
        <div class="col">
        <a href="index.php" class="btn btn-outline-dark">Tagasi</a>
        <h1><?php echo $rida["mark"]; ?> <?php echo $rida["model"]; ?></h1>
        <p>Kast:  <?php echo $rida["transmission"]; ?>
        <p>Kütus:   <?php echo $rida["fuel"]; ?></p>
        <p>Hind:    <?php echo $rida["price"]; ?></p>
        </div>
            <div class="card mb-4">
            <img src="https://loremflickr.com/600/350/<?php echo urlencode($rida["mark"]); ?>"
            class="card-img-top">
        <div class="col"></div>
    </div>

</div>
</div>

</body>
</html>