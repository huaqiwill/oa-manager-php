<?php
include "../utils/check.php";
check_login();
header_html();

include '../utils/connect.php';
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
                            <form action="api/doadds.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="form-label">姓名</label>
                                            <div class="input-group has-validation">
                                                <input type="text" class="form-control " id="username"
                                                       name="username"
                                                       aria-describedby="validationUsername">
                                                <div id="validationUsername" class="invalid-feedback">
                                                    请输入用户名
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">密码</label>
                                            <input id="password" type="text" name="password" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tel">电话</label>
                                            <input id="tel" type="text" name="tel" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">微信号</label>
                                            <input id="email" type="text" name="email" value="" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="number">身份证号码</label>
                                            <input id="number" type="text" name="number" value="" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="otype">员工类型</label>
                                            <select id="otype" class="form-control">
                                                <option value="1">业务员</option>
                                                <option value="2">组长</option>
                                                <option value="3">主管</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="oname">紧急联系人姓名</label>
                                            <input id="oname" type="text" name="oname" value="" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="otel">紧急联系人手机号</label>
                                            <input id="otel" type="text" name="otel" value="" class="form-control"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-4">
                                    <button type="button" class="btn btn-primary" id="submit">保存</button>
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

<?php include "com_script.php" ?>
<script>
    $(document).ready(function () {
        $("#user").addClass("active");
    })
</script>

<script>
    $(document).ready(function () {
        $("#submit").click(function () {
            let $username = $("#username");
            let $password = $("#password");

            if ($username.val() === "") {
                $username.addClass("is-invalid");
            } else {
                $username.removeClass("is-invalid");
            }

            if ($password.val() === "") {
                $password.addClass("is-invalid");
            } else {
                $password.removeClass("is-invalid");
            }
        })
    })
</script>


</body>
</html>