<?php
include './utils/check.php';
check_login();
header_html();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include './utils/db_customer.php';
    $id = $_GET['id'];
    $records = customer_info($id);
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './utils/db_customer.php';
    $a = substr($_SERVER["QUERY_STRING"], 3);
    $customer = $_POST;
    if (customer_edit($customer, $a)) {
        exit(ret_ok("修改成功"));
    } else {
        exit(ret_err("系统繁忙，请稍后再试"));
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
                        <h3 class="page-title">顾客管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="customer.php">主页</a></li>
                            <li class="breadcrumb-item"><a href="customer.php">顾客管理</a></li>
                            <li class="breadcrumb-item active">编辑信息</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <?php foreach ($records as $record): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">基础信息</h4>
                                <form action="customer_edit.php?id=<?php echo $record['id']; ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>姓名</label>
                                                <input type="text" value="<?php echo $record['cname']; ?>" name="cname"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>性别</label>
                                                <select name="sex" class="form-control">
                                                    <option value="<?php echo $record['sex']; ?>"><?php echo $record['sex']; ?></option>
                                                    <option value='女'>女</option>
                                                    <option value='男'>男</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>类型</label>

                                                <select name="ctype" class="form-control">
                                                    <option value="<?php echo $record['ctype']; ?>"><?php echo $record['ctype']; ?></option>
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
                                                <label>客户来源</label>
                                                <select name="laiyuan" class="form-control">
                                                    <option value="<?php echo $record['laiyuan']; ?>"><?php echo $record['laiyuan']; ?></option>
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
                                                <label>手机</label>
                                                <input type="text" value="<?php echo $record['tel']; ?>" name="tel"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>微信号</label>
                                                <input type="text" value="<?php echo $record['weixin']; ?>"
                                                       name="weixin"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>省份</label>
                                                <input type="text" value="<?php echo $record['sheng']; ?>"
                                                       class="form-control" name="sheng">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>城市</label>
                                                <input type="text" value="<?php echo $record['cheng']; ?>"
                                                       class="form-control" name="cheng">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>区县</label>
                                                <input type="text" value="<?php echo $record['qu']; ?>"
                                                       class="form-control" name="qu">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>邮箱</label>
                                                <input type="text" value="<?php echo $record['email']; ?>"
                                                       class="form-control" name="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>地址</label>
                                                <input type="text" value="<?php echo $record['address']; ?>"
                                                       class="form-control" name="address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>时间</label>
                                                <input type="date" value="<?php echo $record['date01']; ?>"
                                                       class="form-control" name="date01">
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
            <?php endforeach; ?>
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
</script>

</body>
</html>