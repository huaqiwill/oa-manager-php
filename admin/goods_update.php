<?php
include "../utils/check.php";
check_login();
header_html();

include '../utils/connect.php';
$id = $_GET['id'];
$sql1 = "select * from goods where id='$id'";
$result1 = mysql_query($sql1);
?>
<!DOCTYPE html>
<html lang="zh">
<?php include 'com_head.php' ?>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <?php include 'com_header.php' ?>
    <?php include 'com_sidebar.php' ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">商品管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">主页</a></li>
                            <li class="breadcrumb-item"><a href="customers.html">商品管理</a></li>
                            <li class="breadcrumb-item active">编辑信息</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <form action="doedits.php?id=<?php echo $_GET['id']; ?>" method="post">
                <?php
                while ($rows = mysql_fetch_array($result1)) {
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">基础信息</h4>
                                    <form action="api/do.php?id=<?php echo $rows['id']; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>商品名称</label>
                                                    <input type="text" name="name" class="form-control"
                                                           value="<?php echo $rows['name']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>价格</label>
                                                    <input type="text" name="price" class="form-control"
                                                           value="<?php echo $rows['price']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>积分价格</label>
                                                    <input type="text" name="vprice" class="form-control"
                                                           value="<?php echo $rows['vprice']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>数量</label>
                                                    <input type="text" name="num" class="form-control"
                                                           value="<?php echo $rows['num']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-right mt-4">
                                            <button type="submit" class="btn btn-primary">保存</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<?php include "com_script.php"; ?>
<script>
    $(document).ready(function () {
        $("#goods").addClass("active");
    })
</script>

</body>
</html>