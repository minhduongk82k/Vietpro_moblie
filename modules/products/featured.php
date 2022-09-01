<?php
$sql = "SELECT * FROM product
        WHERE prd_featured=1
        ORDER BY prd_id DESC
        LIMIT 6";
$query = mysqli_query($conn, $sql);
?>

<!--	Feature Product	-->
<div class="products">
    <h3>Sản phẩm nổi bật</h3>
    <?php
    $i = 1;
    while ($row = mysqli_fetch_array($query)) {
        if ($i == 1) {
    ?>
            <div class="product-list card-deck">
            <?php
        }
            ?>
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image'];?>"></a>
                <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
                <p>Giá Bán: <span><?php  $prd_price = number_format($row['prd_price'], '0', '.','.');
                    echo $prd_price; ?>₫</span></p>
            </div>
            <?php
            if ($i == 3) {
            ?>
            </div>
        <?php
                $i = 1;
            } else {
                $i++;
            }
        ?>

    <?php
    }
    ?>
</div>
<!--	End Feature Product	-->