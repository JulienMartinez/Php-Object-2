<?php
$page_title = 'Le détail de notre jouet';

global $mysqli;

$storeList = getStoreList($mysqli);
$toy = !empty($_POST['store']) ? getStoreToyDetail($mysqli) : getToyDetail($mysqli);

function getToyDetail($mysqli)
{
    if (!empty($_GET['id'])) {

        $q_prep = 'select toys.name, toys.description, toys.image, toys.price, brands.name as b_name, sum(stock.quantity) as total_stocks 
                   from toys 
                   join brands on brands.id = toys.brand_id 
                   join stock on stock.toy_id = toys.id 
                   where toys.id = ? 
                   group by stock.toy_id';

        if ($stmt = mysqli_prepare($mysqli, $q_prep)) {
            $id = $_GET['id'];
        }
        if (mysqli_stmt_bind_param($stmt, 'i', $id)) {
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);

            if ($result) {
                return $row = mysqli_fetch_assoc($result);
            }
        }
    }
}

function getStoreToyDetail($mysqli)
{
    if (!empty($_GET['id'])) {

        $q_prep = 'select toys.name, toys.description, toys.image, toys.price, brands.name as b_name, stock.quantity as total_stocks
        from toys
        join brands on brands.id = toys.brand_id
        join stock on stock.toy_id = toys.id
        join stores on stores.id = stock.store_id
        where toys.id = ? and stores.id = ?';

        if ($stmt = mysqli_prepare($mysqli, $q_prep)) {
            $id = $_GET['id'];
            $store = $_POST['store'];
        }

        if (mysqli_stmt_bind_param($stmt, 'ii', $id, $store)) {
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);

            if ($result) {
                return $row = mysqli_fetch_assoc($result);
            }
        }
    }
}

function getStoreList($mysqli)
{

    $q = 'select stores.id, stores.name from stores;';
    $q_result = mysqli_query($mysqli, $q);


    if ($q_result) {
        $storeList = [];
        while ($row = mysqli_fetch_assoc($q_result)) {
            array_push($storeList, $row);
        }
        return $storeList;
    }
}


?>

<div class="rezize flex">
    <h2><?php echo $page_title; ?></h2>
</div>

<div class="rezize flex"><?php echo ($toy['name']) ?></div>
<section>
    <div class="between toydetail">
        <div><img class="img-sql" src="/1media/<?php echo $toy['image'] ?>"></div>
        <div><?php echo ($toy['price']) ?> €</div>
        <div>
            <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                <select name="store">
                    <option value="Quel magasin ?">Quel magasin ?</option>
                    <?php foreach ($storeList as $store) { ?>
                        <option value="<?php echo $store['id'] ?>"><?php echo $store['name'] ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value=" OK ">
            </form>
            <div>Stock : <?php echo $toy['total_stocks'] ?></div>
        </div>
    </div>
    <div class="between">
        <div>Marque : <?php echo ($toy['b_name']) ?></div>
        <div><?php echo ($toy['description']) ?></div>
    </div>
</section>