<?php
include './utils/check.php';
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './utils/db_customer.php';
    include './utils/result.php';
    $cname = $_POST['cname'];
    $tel = $_POST['tel'];
    $username = $_SESSION['username'];
    $customer = array_splice($_POST, 0);
    if ($cus = customer_exists($cname, $tel)) {
        $customer_name = $cus['username'];
        exit(ret_err("此号码已存在！业务员：$customer_name"));
    } else {
        if ($res = customer_add($customer, $username)) {
            exit(ret_ok("添加成功"));
        } else {
            exit(ret_err("业务繁忙，请稍后再试！"));
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header_html();

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
                        <h3 class="page-title">顾客管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../login.php">主页</a></li>
                            <li class="breadcrumb-item"><a href="customer.php">顾客管理</a></li>
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
                            <h4 class="card-title">基础信息</h4>
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cname">姓名</label>
                                            <input id="cname" type="text" name="cname" class="form-control"
                                                   required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sex">性别</label>
                                            <select id="sex" name="sex" class="form-control">
                                                <option value='女'>女</option>
                                                <option value='男'>男</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctype">类型</label>
                                            <select id="ctype" name="ctype" class="form-control">
                                                <option value='a.准客户'>a.准客户</option>
                                                <option value='b.潜力客户'>b.潜力客户</option>
                                                <option value='c.一般客户'>c.一般客户</option>
                                                <option value='d.未有兴趣'>d.未有兴趣</option>
                                                <option value='e.抗拒型客户'>e.抗拒型客户</option>
                                                <option value='h.黑名单'>h.黑名单</option>
                                                <option value='y.员工客户'>y.员工客户</option>
                                                <option value='n.无效资料'>n.无效资料</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="laiyuan">客户来源</label>
                                            <select id="laiyuan" name="laiyuan" class="form-control">
                                                <option value='微信添加'>微信添加</option>
                                                <option value='VIP转介绍'>VIP转介绍</option>
                                                <option value='抖音'>抖音</option>
                                                <option value='快手'>快手</option>
                                                <option value='小红书'>小红书</option>
                                                <option value='视频号'>视频号</option>
                                                <option value='小程序'>小程序</option>
                                                <option value='淘宝'>淘宝</option>
                                                <option value='京东'>京东</option>
                                                <option value='其他'>其他</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tel">手机</label>
                                            <input id="tel" type="text" name="tel" class="form-control"
                                                   required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="weixin">微信号</label>
                                            <input id="weixin" type="text" name="weixin" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sheng">省份</label>
                                            <input id="sheng" type="text" class="form-control" name="sheng">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cheng">城市</label>
                                            <input id="cheng" type="text" class="form-control" name="cheng">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="qu">区县</label>
                                            <input id="qu" type="text" class="form-control" name="qu">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">邮箱</label>
                                            <input id="email" type="text" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">地址</label>
                                            <input id="address" type="text" class="form-control" name="address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date01">时间</label>
                                            <input id="date01" type="date" class="form-control" name="date01">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-4">
                                    <button onclick="customer_add()" type="button" class="btn btn-primary">保存</button>
                                </div>
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
        $("#customer").addClass("active");
    })

    function customer_add() {
        let data = {
            cname: $("#cname").val(),
            ctype: $("#ctype").val(),
            sex: $("#sex").val(),
            laiyuan: $("#laiyuan").val(),
            tel: $("#tel").val(),
            weixin: $("#weixin").val(),
            date01: $("#date01").val(),
            sheng: $("#sheng").val(),
            cheng: $("#cheng").val(),
            qu: $("#qu").val(),
            email: $("#email").val(),
            address: $("#address").val(),
        }

        $.ajax({
            url: "customer_add.php",
            type: "POST",
            data,
            success: function (data) {
                if (data.code === 200) {
                    alert(data.message);
                    window.location = "db_customer.php";
                } else {
                    alert(data.message);
                }
            }
        })
    }
</script>

</body>
</html>