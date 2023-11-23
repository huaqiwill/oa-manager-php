<?php
include "../utils/check.php";
check_login();
header_html();

include '../utils/connect.php';
$sql1 = "select * from user where id='" . $_GET['id'] . "'";
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
                        <h3 class="page-title">业务员管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">主页</a></li>
                            <li class="breadcrumb-item"><a href="customers.html">业务员管理</a></li>
                            <li class="breadcrumb-item active">编辑信息</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <form action="api/doedit.php?id=<?php echo $_GET['id']; ?>" method="post">
                <?php
                while ($rows = mysql_fetch_array($result1)) {
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">基础信息</h4>
                                    <form action="api/doedit.php?id=<?php echo $rows['id']; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>姓名</label>
                                                    <input type="text" name="username"
                                                           value="<?php echo $rows['username']; ?>"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>密码</label>
                                                    <input type="text" name="password"
                                                           value="<?php echo $rows['password']; ?>"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>电话号码</label>
                                                    <input type="text" name="tel" value="<?php echo $rows['tel']; ?>"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>微信号</label>
                                                    <input type="text" name="email"
                                                           value="<?php echo $rows['email']; ?>" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>身份证号码</label>
                                                    <input type="text" name="number"
                                                           value="<?php echo $rows['number']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>联系人</label>
                                                    <input type="text" name="oname"
                                                           value="<?php echo $rows['oname']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>联系人手机号</label>
                                                    <input type="text" name="otel" value="<?php echo $rows['otel']; ?>"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>单位名称</label>
                                                    <input type="text" name="oname"
                                                           value="<?php echo $rows['oname']; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">

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

<?php include "com_script.php" ?>
<script>
    $(document).ready(function () {
        $("#user").addClass("active");
    })
</script>

</body>
</html>