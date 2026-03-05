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

<?php while($rida = mysqli_fetch_row($valjund)){ ?>

    <div class="col-sm-3">
        <div class="card mb-4">
            <img src="https://loremflickr.com/600/350/<?php echo urlencode($rida[1]); ?>"
                 class="card-img-top">

            <div class="card-body">
                <h5><?php echo $rida[1]; ?> <?php echo $rida[2]; ?></h5>

                <p>
                    <?php echo $rida[3]; ?><br>
                    <?php echo $rida[4]; ?><br>
                    <?php echo $rida[5]; ?> €/päev
                </p>

                <a href="car.php?id=<?php echo $rida[0]; ?>" class="btn btn-dark btn-sm">
                    Rendi
                </a>
            </div>

        </div>
    </div>

<?php } ?>
    <!-- üks auto -->
<?php
    $paring = "SELECT * FROM cars";
    if (!empty($_GET["otsi"])) {
        $otsing = $_GET["otsi"];
        $paring .= " WHERE mark LIKE '%".$otsing."%'";
    } else 
    
    $paring .= " LIMIT 8";

    $valjund = mysqli_query($yhendus, $paring);
    while($rida = mysqli_fetch_assoc($valjund))

?>
</div>
</div>

</body>
</html>