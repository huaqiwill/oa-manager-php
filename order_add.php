<?php
include './utils/check.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include './utils/db_order.php';


} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './utils/db_order.php';
    include './utils/db_cart.php';
    include './utils/db_user.php';
    include './utils/result.php';

    //必填参数
    $keys = array("type", "totals", "shou", "tel", "kuainame", "kuainum",
        "date01", "date02", "kename", "gid", "num");
    if (!$data = data_check($_POST, $keys)) {
        ret_err("参数异常");
    }
    $uid = user_get_id($_SESSION['username']);
    $o_num = date('YmdHis') . rand(100, 999);
    // 执行SQL语句
    $result = order_add($data['type'], $o_num, $data['totals'], $data['shou'],
        $data['tel'], $data['tel'], $data['kuainame'], $data['date01'],
        $data['date02'], $data['kename'], $data['gid'], $data['num'], $uid);

    // 检查执行结果
    if (!$result) {
        // 操作失败，返回错误信息
        ret_err("订单保存失败" . mysql_error());
    } else {
        cart_clear($uid);
        // 操作成功，返回成功信息和订单号
        ret_ok("订单保存成功");
    }
} else {
    exit();
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
                        <h3 class="page-title">订单管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="order.php">主页</a></li>
                            <li class="breadcrumb-item"><a href="customer.php">订单管理</a></li>
                            <li class="breadcrumb-item active">录入信息</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">基础信息<font color="#ccc">(请先选好商品，再录入其他信息)</font>
                            </h4>
                            <form id="doorder_form" action="api/order_add.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>日期</label>
                                            <input type="date" name="date01" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>订单类型</label>
                                            <input type="text" name="type" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>收货人姓名</label>
                                            <input type="text" name="shou" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>收货人电话</label>
                                            <input type="text" name="tel" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>快递公司</label>
                                            <input type="text" name="kuainame" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>快递单号</label>
                                            <input type="text" name="kuainum" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>发货时间</label>
                                            <input type="date" name="date02" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>客户姓名</label>
                                            <select name="kename" class="form-control">
                                                <?php
                                                $sql1 = "select * from customers where uid in(select id from user where status='1')";
                                                $result1 = mysql_query($sql1);

                                                while ($rows = mysql_fetch_array($result1)) {
                                                    ?>
                                                    <option value="<?php echo $rows['cname']; ?>"><?php echo $rows['cname']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- <?php include 'goods_list.php'; ?> -->
                                <div class="row">
                                    <div class="col-md-2">商品名称：</div>
                                    <div class="col-md-7">
                                        <select name="gid" id="gid" class="form-control">
                                            <?php
                                            $sql2 = "select * from goods";
                                            $result2 = mysql_query($sql2);
                                            while ($rows2 = mysql_fetch_array($result2)) {
                                                ?>
                                                <option id="<?php echo $rows2['id']; ?>"><?php echo $rows2['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="#" class="btn btn-primary" onclick="order_cart_add(event)">添加</a>
                                    </div>

                                </div>
                                <table class=" table-striped table-responsive text-center" width="100%" cellpadding="5">
                                    <tr height="30">
                                        <td width="5%">商品ID</td>
                                        <td width="55%">商品名称</td>
                                        <td width="10%">价格</td>
                                        <td width="10%">积分价格</td>
                                        <td width="10%">数量</td>
                                        <td width="10%">操作</td>
                                    </tr>
                                    <?php
                                    $sql3 = "select *,cart.num as gnum,cart.id as cid from cart,goods where cart.gid=goods.id and cart.uid in(select id from user where username ='" . $_SESSION['username'] . "')";
                                    $result3 = mysql_query($sql3);
                                    $number = mysql_num_rows($result3);

                                    $totals = '';
                                    if ($number) {
                                    while ($rows3 = mysql_fetch_array($result3)) {
                                        ?>
                                        <tr height="30" data-gid="<?php echo $rows3['id']; ?>">
                                            <td><?php echo $rows3['id']; ?></td>
                                            <td><?php echo $rows3['name']; ?></td>
                                            <td><?php echo $rows3['price']; ?></td>
                                            <td><?php echo $rows3['vprice']; ?></td>
                                            <td><input type="text" name="num" value="<?php echo $rows3['gnum'];
                                                $o_count = $rows3['gnum'] * $rows3['price']; ?>"
                                                       style="width:30%; margin:0 35%; text-align:center;">
                                            </td>
                                            <td><a href="#" class="update-link" data-id="<?php echo $rows3['cid']; ?>">修改</a>
                                                | <a href="order_delete.php?id=<?php echo $rows3['cid']; ?>">删除</a></td>
                                        </tr>
                                        <?php if ($totals != '') {
                                            $totals += $o_count;
                                        } else {
                                            $totals = $o_count;
                                        } ?>
                                    <?php } ?>
                                </table>
                                <input type="hidden" name="totals" value="<?php echo $totals; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <font color="#f00">总金额</font>&nbsp;&nbsp;
                                        <span id="count"><?php echo $totals; ?></span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn btn-primary">保存</button>
                                    </div>
                                </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

<?php include "com_script.php"; ?>
<script>
    $(document).ready(function () {
        $("#order").addClass("active");
        $('.update-link').on('click', function (event) {
            event.preventDefault(); // 阻止默认事件

            var cid = $(this).data('id'); // 获取 cart ID
            var num = $(this).closest('tr').find('input[name=num]').val(); // 获取新的数量

            // 发送 AJAX 请求来更新 cart item
            $.ajax({
                url: 'update.php',
                method: 'POST',
                data: {
                    'id': cid,
                    'num': num
                },
                success: function (response) {
                    console.log(response); // 在控制台记录服务器响应
                }
            });
        });
        $("#doorder_form").submit(function (event) {
            // 阻止表单默认提交
            event.preventDefault();

            // 使用AJAX提交表单数据
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (response) {
                    // 请求成功，弹窗显示返回的结果
                    if (response) {
                        alert(response.msg);
                    }

                }
            });
        });
    })

    function order_cart_add(event) {
        event.preventDefault(); // 阻止默认事件
        let selectIndex = document.getElementById("gid").selectedIndex;
        let gid = document.getElementById('gid').options[selectIndex].id;//商品id
        $.ajax({
            url: 'order_shop_add.php',
            method: 'POST',
            data: {gid},
            dataType: 'json', // 告诉jQuery预期的响应类型是JSON
            success: function (response) {
                if (response.code === 200) {
                    // 获取现有的数量和价格
                    let numInput = $('tr[data-gid="' + id + '"]').find('input[name="num"]');
                    let num = parseInt(numInput.val()) || 0;
                    let price = parseFloat($('tr[data-gid="' + id + '"]').find('td[data-field="price"]').text());

                    if (numInput.length > 0) {
                        // 如果表格中已经存在该商品，则更新其数量和总价
                        numInput.val(num + 1);
                        $('tr[data-gid="' + id + '"]').find('td[data-field="total"]').text((num + 1) * price);
                    } else {
                        // 否则，新增一行记录该商品
                        let name = $('#gid option[id=' + id + ']').text();
                        let newRow = '<tr height="30" data-gid="' + id + '">' +
                            '<td>' + id + '</td>' +
                            '<td>' + name + '</td>' +
                            '<td data-field="price">' + response.price + '</td>' +
                            '<td>' + response.vprice + '</td>' +
                            '<td><input type="text" name="num" value="1" style="width:30%; margin:0 35%; text-align:center;"></td>' +
                            '<td><a href="#" class="update-link" data-id="' + response.id + '">修改</a> | <a href=' + response.cid + '"customer_delete.php?id=">删除</a></td>' +
                            '</tr>';
                        $('table tbody').append(newRow);
                    }

                    let newTotal = parseFloat($('input[name="totals"]').val()) + parseFloat(response.price);
                    $('input[name="totals"]').val(newTotal);

                    $('#count').text(newTotal);

                    alert('商品已成功添加到购物车');
                } else {
                    alert('添加商品到购物车时发生错误：' + response.msg);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert('发生了一个错误：' + errorThrown);
            }
        });
    }
</script>
</body>

</html>