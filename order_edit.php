<?php
include './utils/check.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include "./utils/db_order.php";
    include './utils/db_goods.php';
    include './utils/db_customer.php';
    include './utils/db_user.php';

    $order_id = $_GET['id'];

    $result1 = order_info($order_id);
    $uid = user_get_id($_SESSION['username']);
    $customers = customer_list_find($uid);

    $goods = goods_list();
}

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
                        <h3 class="page-title">修改订单</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="order.php">主页</a></li>
                            <li class="breadcrumb-item"><a href="customer.php">订单管理</a></li>
                            <li class="breadcrumb-item active">录入信息</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <?php foreach ($result1 as $rows): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">基础信息</h4>
                                <form action="order.php" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="order_date">日期</label>
                                                <input id="order_date" type="date" name="date01"
                                                       value="<?php echo $rows['date01']; ?>"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="order_type">订单类型</label>
                                                <input id="order_type" type="text" name="type" class="form-control"
                                                       value="<?php echo $rows['type']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="customer_name">收货人姓名</label>
                                                <input id="customer_name" type="text" name="shou" class="form-control"
                                                       value="<?php echo $rows['shouname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="customer_phone">收货人电话</label>
                                                <input id="customer_phone" type="text" name="tel" class="form-control"
                                                       value="<?php echo $rows['tel']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="delivery_name">快递公司</label>
                                                <input id="delivery_name" type="text" name="kuainame"
                                                       class="form-control"
                                                       value="<?php echo $rows['kuainame']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="delivery_id">快递单号</label>
                                                <input id="delivery_id" type="text" name="kuainum" class="form-control"
                                                       value="<?php echo $rows['kuainum']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="delivery_time">发货时间</label>
                                                <input id="delivery_time" type="date" name="date02" class="form-control"
                                                       value="<?php echo $rows['date02']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="customer_name">客户姓名</label>
                                                <select id="customer_name" name="kename" class="form-control">
                                                    <option value="<?php echo $rows['kename']; ?>"><?php echo $rows['kename']; ?></option>
                                                    <?php foreach ($customers as $customer): ?>
                                                        <option value="<?php echo $customer['cname']; ?>"><?php echo $customer['cname']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-1" style="align-self: center">商品名称</div>
                                        <div class="col-md-8">
                                            <select name="gid" id="gid" class="form-control">
                                                <?php foreach ($goods as $good): ?>
                                                    <option id="<?php echo $good['id']; ?>"><?php echo $good['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-primary" onclick="order_shop_add(event)">添加</a>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <table class=" table-striped table-responsive text-center" style="margin-top: 20px;margin-bottom: 20px;">
                                            <thead>
                                            <tr height="30">
                                                <td style="width: 80%">商品名称</td>
                                                <td style="width: auto">价格</td>
                                                <td style="width: auto">积分价格</td>
                                                <td style="width: auto">数量</td>
                                                <td style="width: auto">操作</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $gids = explode(' ', $rows['gid']);
                                            foreach ($gids as $gid) {
                                                $good = goods_info($gid);
                                                ?>
                                                <tr height="30">
                                                    <td><?php echo $good['name']; ?></td>
                                                    <td><?php echo $good['price']; ?></td>
                                                    <td><?php echo $good['vprice']; ?></td>
                                                    <td>0</td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger">删除</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <span style="color: red">总金额</span>&nbsp;&nbsp;<?php echo $rows['total']; ?>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="button" onclick="history.go(-1)" class="btn btn-primary"
                                                    style="width: 100px">返回
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->


<?php include "com_script.php"; ?>

<script>
    $(document).ready(function () {
        $("#order").addClass("active");
    })

    function order_shop_add(event) {
        event.preventDefault();
        let selectIndex = document.getElementById("gid").selectedIndex;
        let id = document.getElementById('gid').options[selectIndex].id;
        fetch("doadd.php?gid=" + id);
    }
</script>

</body>
</html>