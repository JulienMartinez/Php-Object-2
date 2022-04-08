<?php
$page_title = 'Liste de tout nos jouets';

$limit = 4;
$page = $_GET['page'] ?? NULL;
$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$toys_liste = !empty($_POST['brand']) ? getToyList($mysqli, $_POST['brand']) : getToyList($mysqli, NULL, $limit, $page);
$numbersOfLine = getTableToyLength($mysqli);
$numberOfPage =  ceil($numbersOfLine / $limit);

function getToyList($mysqli, $brand = NULL, $limit = NULL, $page = NULL)
{
    $toys_liste = [];

    if ($brand == NULL) {

        $liste = 'select toys.name, price, image, id from toys';
        if ($limit != NULL) {
            $liste .= ' limit ' . $limit;
        }
        if (!empty($_GET['page'])) {
            $liste .= ' offSet ' . ($page - 1) * $limit;
        }
        $liste_result = mysqli_query($mysqli, $liste);
        if ($liste_result) {

            while ($row = mysqli_fetch_assoc($liste_result)) {
                array_push($toys_liste, $row);
            }
        }
    } else {

        $q_prep = 'select toys.name, price, image, id from toys where toys.brand_id = ?';
        if ($stmt = mysqli_prepare($mysqli, $q_prep)) {
            $id = $brand;
        }
        if (mysqli_stmt_bind_param($stmt, 'i', $id)) {
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($toys_liste, $row);
                }
            }
        }
    }
    return $toys_liste;
}

$brandList = getBrandList($mysqli);

function getBrandList($mysqli)
{
    $q = 'select * from brands ';
    $q_result = mysqli_query($mysqli, $q);


    if ($q_result) {
        $storeList = [];
        while ($row = mysqli_fetch_assoc($q_result)) {
            array_push($storeList, $row);
        }
        return $storeList;
    }
}

function getTableToyLength($mysqli)
{
    $q = 'select count(*) as number from toys';
    $q_result =  mysqli_query($mysqli, $q);
    if ($q_result) {
        $row = mysqli_fetch_assoc($q_result);
        return $row['number'];
    }
}


?>

<div class="rezize flex">
    <h2><?php echo $page_title; ?></h2>
</div>
<div>
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
        <select name="brand">
            <option value="">Quel marque ?</option>
            <?php foreach ($brandList as $brand) { ?>
                <option value="<?php echo $brand['id'] ?>"><?php echo $brand['name'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" value=" OK ">
    </form>
</div>

<section class="wrap">
    <?php foreach ($toys_liste as $toy) : ?>
        <div class="toytop">
            <div><img class="img-sql" src="/1media/<?php echo $toy['image'] ?>"></div>
            <div class="name"><a href="/details?id=<?php echo $toy['id'] ?>"><?php echo $toy['name'] ?></a></div>
            <div class="price"><?php echo ($toy['price']) ?> €</div>
        </div>
    <?php endforeach; ?>
    <?php
    if (empty($_POST['brand'])) {
        for ($i = 1; $i < $numberOfPage + 1; $i++) { ?>
            <div class="end">
                    <a href="/liste?page=<?php echo ($i); ?>"><?php echo ($i); ?></a>
            </div>
        <?php }
    } ?>

</section>