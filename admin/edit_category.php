<?php
	if(!defined("TEMPLATE")){
		die("Bạn không có quyền truy cập vào file này!"); //die sẽ xuất ra những gì truyền vào và dừng luôn
    }
    
    // $cat_id = $_GET['cat_id'];

    $sql_cat = "SELECT * FROM category 
                ORDER BY cat_id ASC";
    $query_cat = mysqli_query($conn,$sql_cat);
    $row = mysqli_fetch_array($query_cat);
?>	

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý danh mục</a></li>
				<li class="active"> <?php echo $row['cat_name']; ?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh mục: <?php echo $row['cat_name']; ?></h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                            <div class="alert alert-danger">Danh mục đã tồn tại !</div>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="cat_name" required value="Danh mục 1" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	
