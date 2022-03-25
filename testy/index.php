<?php include_once "../php-assets/config.php";

$data = $database->query("SELECT followed FROM users WHERE id = " . $_SESSION['id']);
foreach ($data as $flw){
    $followed_ids = explode("#",filter_ids($flw["followed"]));
}
print_r($followed_ids);

$query = "SELECT * FROM poems WHERE owner_id IN " . create_id_for_sql($followed_ids) . " AND public = 1";

$data = $database->query($query);

//$count_results = mysqli_num_rows($data);

foreach ($data as $poem):?>


    <div class="poem">
        <div class="heading-container">
            <h3 class="heading"><?= $poem['heading'] ?></h3>
        </div>
        <a href="../poems/index.php?id=<?= $poem['id'] ?>">PREZERAŤ.</a>
    </div>
<?php endforeach;
