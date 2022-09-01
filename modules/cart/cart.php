
<script>
    function byNow() {
        document.getElementById('frm').submit();
    }
</script>

<script>
    function thongBao() {
        var conf = confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?");
        return conf;
    }
</script>

<!--	Cart	-->
<?php
include('PHPMailer/src/Exception.php');
include('PHPMailer/src/OAuth.php');
include('PHPMailer/src/PHPMailer.php');
include('PHPMailer/src/POP3.php');
include('PHPMailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (isset($_SESSION['cart'])) {
    if (isset($_POST['sbm'])) {
        foreach ($_POST['quantity'] as $prd_id => $quantity) {
            $_SESSION['cart'][$prd_id] = $quantity;
        }
    }

    $arr_id = array();
    foreach ($_SESSION['cart'] as $prd_id => $quantity) {
        $arr_id[] = $prd_id;
    }
    $str_id = implode(', ', $arr_id);
    $sql = "SELECT * FROM product
            WHERE prd_id 
            IN($str_id)";
    $query = mysqli_query($conn, $sql);

?>
    <div id="my-cart">
        <div class="row">
            <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
            <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
            <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
        </div>
        <form method="post">
            <?php
            $total_price = 0;
            $total_price_all = 0;
            while ($row = mysqli_fetch_array($query)) {
                $total_price = $_SESSION['cart'][$row['prd_id']] * $row['prd_price'];
                $total_price_all += $total_price;
            ?>
                <div class="cart-item row">
                    <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        <img src="admin/img/products/<?php echo $row['prd_image']; ?>">
                        <h4><?php echo $row['prd_name']; ?></h4>
                    </div>

                    <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                        <input type="number" id="quantity" class="form-control form-blue quantity" name="quantity[<?php echo $row['prd_id']; ?>]" value="<?php echo $_SESSION['cart'][$row['prd_id']]; ?>" min="1">
                    </div>
                    <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo $total_price; ?>đ</b><a onclick="return thongBao();" href="modules/cart/del_cart.php?prd_id=<?php echo $row['prd_id']; ?>">Xóa</a></div>
                </div>
            <?php
            }
            ?>

            <div class="row">
                <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                    <button id="update-cart" class="btn btn-success" type="submit" name="sbm">Cập nhật giỏ hàng</button>
                </div>
                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
                <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo $total_price_all; ?>đ</b></div>
            </div>
        </form>

    </div>
<?php
} else {
?>
    <div class="alert alert-danger" style="margin-top: 20px">Hiện không sản phẩm nào trong giỏ hàng.</div>
<?php
}
?>
<!--	End Cart	-->

<!--	Customer Info	-->
<?php
if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['mail']) && isset($_POST['add'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $user_mail = $_POST['mail'];
    $add = $_POST['add'];

    $str_body = '';
    $str_body .= '
    <p>
        <b>Khách Hàng:</b>' . $name . '<br>
        <b>Điện Thoại:</b>' . $phone . '<br>
        <b>Địa Chỉ:</b>' . $add . '<br>
    </p>
    ';

    $str_body .= '
    <table border="1" cellspacing="0" cellspacing="10" bordercolor="#305eb3" width="100%">
        <tr>
            <td width="70%"><b><front color="#FFFFFF">Sản Phẩm</front></b></td>
            <td width="10%"><b><front color="#FFFFFF">Số Lượng</front></b></td>
            <td width="20%"><b><front color="#FFFFFF">Tổng Tiền</front></b></td>
        </tr>
    ';

    $sql = "SELECT * FROM product
            WHERE prd_id 
            IN($str_id)";
    $query = mysqli_query($conn, $sql);

    $total_price = 0;
    $total_price_all = 0;
    while ($row = mysqli_fetch_array($query)) {
        $total_price = $_SESSION['cart'][$row['prd_id']] * $row['prd_price'];
        $total_price_all += $total_price;

        $str_body .= '
        <tr>
            <td width="70%">' . $row['prd_name'] . '</td>
            <td width="10%">' . $_SESSION['cart'][$row['prd_id']] . '</td>
            <td width="20%">' . $total_price . 'đ</td>
        </tr>
        ';
    }

    $str_body .= '
        <tr>
            <td colspan="2" width="70%"></td>
            <td width="20%"><b><font color="#FF0000">' . $total_price_all . ' đ</font></b></td>
        </tr>
        </table>
    ';

    $str_body .= '
        <p>
            Cảm ơn quý khách đã mua hàng. Bộ phận giao hàng sẽ liên hệ với quý khách để xác nhận sau 5 phút nữa!
        </p>
    ';

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'duydz1202@gmail.com'; //anhnhatdev2504
        $mail->Password = 'aooetapcleuuisun'; //aooetapcleuuisun
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('pvdktr08@gmail.com', 'PVDRH');
        $mail->addAddress($user_mail);
        // $mail->addReplyTo('ceo.vietpro@gmail.com', 'Information');
        $mail->addCC('pvdktr08@gmail.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment(/var/tmp/file.tar.gz);
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');


        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Xác nhận đơn hàng từ Vietpro Mobile Shop';
        $mail->Body = $str_body;
        $mail->AltBody = 'Mô tả đơn hàng';

        $mail->send();
        $str_body;
        header('location:index.php?page_layout=success');
    } catch (Exception $e) {
        $str_body;
        echo 'Message could not be sent. Maier Error: ', $mail->ErrorInfo;
    }
}
?>
<div id="customer">
    <form  id="frm" method="post">
        <div class="row">

            <div id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Họ và tên (bắt buộc)" type="text" name="name" class="form-control" required>
            </div>
            <div id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Số điện thoại (bắt buộc)" type="text" name="phone" class="form-control" required>
            </div>
            <div id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                <input placeholder="Email (bắt buộc)" type="text" name="mail" class="form-control" required>
            </div>
            <div id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text" name="add" class="form-control" required>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="by-now col-lg-6 col-md-6 col-sm-12">
            <a href="#" onclick="byNow();">
                <b>Mua ngay</b>
                <span>Giao hàng tận nơi siêu tốc</span>
                </a>
        </div>
        <div class="by-now col-lg-6 col-md-6 col-sm-12">
            <a href="#">
                <b>Trả góp Online</b>
                <span>Vui lòng call (+84) 0988 550 553</span>
            </a>
        </div>
    </div>
</div>
<!--	End Customer Info	-->