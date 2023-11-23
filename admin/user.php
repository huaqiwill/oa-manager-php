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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">业务员管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">主页</a>
                            </li>
                            <li class="breadcrumb-item active">业务员管理</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="user_add.php" class="btn btn-primary mr-1">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->


            <div class="row">
                <div class="col-sm-12">

                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>姓名</th>
                                        <th>密码</th>
                                        <th>手机号</th>
                                        <th>微信号</th>
                                        <th>身份证号</th>
                                        <th>联系人</th>
                                        <th>联系人手机号</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    //定义变量由浏览器传入
                                    $page = isset($_GET['rows']) ? $_GET['rows'] : 1;
                                    // 每页数量
                                    $PageSize = 10;

                                    // 获取总数据量
                                    $sql = "select count(*) as amount from user";
                                    $result = mysql_query($sql);
                                    $row = mysql_fetch_row($result);
                                    $amount = $row[0];
                                    // 分页上限
                                    $pages = ceil($amount / $PageSize);
                                    $sql_query = "select * from user limit " . ($page - 1) * $PageSize . ",$PageSize";
                                    $result = mysql_query($sql_query);
                                    $records = array();
                                    while ($record = mysql_fetch_array($result)) {
                                        $records[] = $record;


                                        $PageHtml = ' ';
                                        for ($i = 1; $i <= $pages; $i++) {
                                            $PageHtml .= '<a href="db_user.php?rows=' . $i . '" style=" color:#333; text-decoration:none; padding:3px 10px; margin-right:5px; border:1px solid #333;">' . $i . '</a>';

                                        }
                                        $PageHtml .= '共 ' . $amount . " 条记录";
                                    }
                                    foreach ($records as $row) :
                                        ?>

                                        <tr>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['password'] ?></td>
                                            <td><?php echo $row['tel'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['number'] ?></td>
                                            <td><?php echo $row['oname'] ?></td>
                                            <td><?php echo $row['otel'] ?></td>


                                            <td class="text-right">
                                                <a href="user_update.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-success mr-2"><i
                                                            class="far fa-edit mr-1"></i>修改</a> <?php if ($row['status'] == 2) { ?>
                                                    <span class="btn btn-sm btn-white mr-2"
                                                          style="color:#eee;">已冻结</span>
                                                <?php } else { ?>
                                                <a onclick="if(confirm('冻结此账号吗?')){location.href='del.php?id=<?php echo $row['id'] ?>';}"
                                                   class="btn btn-sm btn-white text-danger mr-2">冻结</a><?php } ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="11" align="right">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                 id="DataTables_Table_0_paginate"><?php echo $PageHtml; ?></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
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


</body>
</html>