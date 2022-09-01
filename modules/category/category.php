<?php
$cat_id = $_GET['cat_id'];
$cat_name = $_GET['cat_name'];

$sql = "SELECT * FROM product
            WHERE cat_id=$cat_id
            ORDER BY prd_id DESC";

$query = mysqli_query($conn, $sql);
// $row = mysqli_fetch_array($query);
$total_rows = mysqli_num_rows($query);
?>
<!--	List Product	-->
<div class="products">
    <h3> <?php echo $cat_name; ?> (Hiện có <?php echo $total_rows; ?> sản phẩm)</h3>
    <?php
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
        if ($i == 0) {
    ?>
            <div class="product-list card-deck">
            <?php
        }
            ?>
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
                <h4><a href="#"><?php echo $row['prd_name']; ?></a></h4>
                <p>Giá Bán: <span>
                    <?php 
                    $prd_price = number_format($row['prd_price'], '0', '.','.');
                    echo $prd_price; ?>
                    đ</span></p>
            </div>
            <?php
            $i++;
            if ($i == 3) {
                $i = 0;
            ?>
            </div>
        <?php
            } 
        ?>
    <?php
    }
    if($total_rows%3 !=0){
    ?>
    </div>
<?php } ?>
</div>
    

<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
    </ul>
</div>