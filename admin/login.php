<?php
	//Kiểm tra khi người dùng bấm Submit
	if(isset($_POST["sbm"])){
		$mail = $_POST["mail"];
		$pass = $_POST["pass"];

		//Kết nối với MySQL
		$sql = "SELECT * FROM user 
				WHERE user_mail = '$mail' 
				AND user_pass = '$pass'";
		$query = mysqli_query($conn,$sql);
		$rows = mysqli_num_rows($query);

		//Kiểm tra thông tin đăng nhập
		if($rows>0){
			$_SESSION["mail"] = $mail;
			$_SESSION["pass"] = $pass;
			//Chuyen huong toi trang admin
			header("location:index.php");
		}
		else{
			//bao loi khong hop le
			$error = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
		}
	}
	?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>

	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Vietpro Mobile Shop - Administrator</div>
				<div class="panel-body">
				<?php if(isset($error)) {echo $error;} ?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<!-- require trong form là bắt người dùng phải nhập dữ liệu còn không là sẽ báo đỏ -->
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button name="sbm" type="submit" class="btn btn-primary">Đăng nhập</button>
						</fieldset>
					</form>
					<center>
						<h5>Hoặc</h5>
						<div id="login-with-social">
                    <a href="#"><img src="img/facebook.png" alt='facebook login' title="Facebook Login" height="10%" width="10%" /></a>
                    
                </div>
					</center>
				</div>
				
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>
