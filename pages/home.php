<?php
$page_title = 'N°1 de la vente des jouets dans une vie passée';

global $mysqli;
$q = 'select toy_id, toys.name, price, image, toys.id from sales join toys on toy_id = toys.id group by toy_id order by sum(quantity) desc limit 3';
$q_result = mysqli_query( $mysqli, $q );


if( $q_result ) {
    $toys = [];
	while( $row = mysqli_fetch_assoc( $q_result ) ) {
        array_push($toys,$row);
		
	}
}

?>

 <div class="rezize flex"><h2><?php echo $page_title; ?></h2></div>

<section>
    <?php foreach ($toys as $toy):?>
        <div class="toytop">
            <div><img class="img-sql" src="/1media/<?php echo $toy['image']?>"></div>
            <div class="name"><a href="/details?id=<?php echo $toy['id']?>"><?php echo $toy['name']?></a></div>
            <div class="price"><?php echo( $toy['price'] ) ?> €</div>
        </div>
    <?php endforeach; ?>
</section>


