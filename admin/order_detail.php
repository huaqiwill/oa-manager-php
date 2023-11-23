<?php
include "../utils/check.php";
check_login();
header_html();

include '../utils/connect.php';
$sql1 = "select * from ding where id='" . $_GET['id'] . "'";
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
                        <h3 class="page-title">订单管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">主页</a></li>
                            <li class="breadcrumb-item"><a href="customers.php">订单管理</a></li>
                            <li class="breadcrumb-item active">查看信息</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <?php
            while ($rows = mysql_fetch_array($result1)){
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">基础信息</h4>
                            <form action="order.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>日期</label>
                                            <input type="date" name="date01" value="<?php echo $rows['date01']; ?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>订单类型</label>
                                            <input type="text" name="type" class="form-control"
                                                   value="<?php echo $rows['type']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>收货人姓名</label>
                                            <input type="text" name="shou" class="form-control"
                                                   value="<?php echo $rows['shouname']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>收货人电话</label>
                                            <input type="text" name="tel" class="form-control"
                                                   value="<?php echo $rows['tel']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>快递公司</label>
                                            <input type="text" name="kuainame" class="form-control"
                                                   value="<?php echo $rows['kuainame']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>快递单号</label>
                                            <input type="text" name="kuainum" class="form-control"
                                                   value="<?php echo $rows['kuainum']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>发货时间</label>
                                            <input type="date" name="date02" class="form-control"
                                                   value="<?php echo $rows['date02']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>客户姓名</label>
                                            <select name="kename" class="form-control">
                                                <option value="<?php echo $rows['kename']; ?>"><?php echo $rows['kename']; ?></option>
                                                <?php
                                                $sql1 = "select * from customers where uid in(select id from user where status='1')";
                                                $result1 = mysql_query($sql1);

                                                while ($rows1 = mysql_fetch_array($result1)) {
                                                    ?>
                                                    <option value="<?php echo $rows1['cname']; ?>"><?php echo $rows1['cname']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center">
                                    <table width="100%" class=" table-striped table-responsive text-center" width="100%"
                                           cellpadding="5">
                                        <tr height="30">
                                            <td width="75%">商品名称</td>
                                            <td width="10%">价格</td>
                                            <td width="10%">积分价格</td>
                                            <td width="10%">数量</td>
                                        </tr>


                                        <?php
                                        $v = explode(' ', $rows['gid']);
                                        $n = explode(' ', $rows['num']);
                                        @$i = 0;
                                        foreach ($v as $a) {

                                            $sql_query = "select * from goods where id='" . $a . "'";
                                            $ab = mysql_query($sql_query);
                                            while ($abs = mysql_fetch_array($ab)) {

                                                ?>


                                                <tr height="30">
                                                    <td><?php echo $abs['name']; ?></td>
                                                    <td><?php echo $abs['price']; ?></td>
                                                    <td><?php echo $abs['vprice']; ?></td>
                                                    <td><?php echo $n[$i]; ?></td>
                                                </tr>
                                                <?php $i++;
                                            }
                                        } ?>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><font
                                                color="#f00">总金额</font>&nbsp;&nbsp;<?php echo $rows['total']; ?></div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn btn-primary">返回</button>
                                    </div>
                                </div>

                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


<?php include "com_script.php" ?>
<script>
    $(document).ready(function () {
        $("#order").addClass("active");
    })
</script>


</body>
</html>