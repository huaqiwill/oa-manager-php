<?php
include './utils/check.php';
check_login();
header_html();

include './utils/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //定义变量由浏览器传入
    $page = isset($_GET['rows']) ? $_GET['rows'] : 1;
    // 每页数量
    $PageSize = 10;

    // 获取总数据量
    $sql = "select count(*) as amount from customers where uid in (select id from user where username='" . $_SESSION['username'] . "')";
    $result = mysql_query($sql);
    $row = mysql_fetch_row($result);
    $amount = $row[0];
    // 分页上限
    $pages = ceil($amount / $PageSize);
    $sql_query = "select * from customers where uid in (select id from user where username='" . $_SESSION['username'] . "') limit " . ($page - 1) * $PageSize . ",$PageSize";
    $result = mysql_query($sql_query);
    $records = array();
    while ($record = mysql_fetch_array($result)) {
        $records[] = $record;
        $page_num = ' ';
        for ($i = 1; $i <= $pages; $i++) {
            $page_num .= '<a href="db_customer.php?rows=' . $i . '" style=" color:#333; text-decoration:none; padding:3px 10px; margin-right:5px; border:1px solid #333;">' . $i . '</a>';

        }
        $page_num .= '共 ' . $amount . " 条记录";
    }
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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">顾客管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="customer.php">主页</a>
                            </li>
                            <li class="breadcrumb-item active">顾客管理</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="customer_add.php" class="btn btn-primary mr-1">
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
                                        <th>客户类型</th>
                                        <th>客户姓名</th>
                                        <th>性别</th>
                                        <th>客户来源</th>
                                        <th>手机</th>
                                        <th>微信号</th>
                                        <th>锁定日期</th>
                                        <th>省份</th>
                                        <th>城市</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($records as $row) : ?>
                                        <tr>
                                            <td><?php echo $row['ctype'] ?></td>
                                            <td><?php echo $row['cname'] ?></td>
                                            <td><?php echo $row['sex'] ?></td>
                                            <td><?php echo $row['laiyuan'] ?></td>
                                            <td><?php echo $row['tel'] ?></td>
                                            <td><?php echo $row['weixin'] ?></td>
                                            <td><?php echo $row['date01'] ?></td>
                                            <td><?php echo $row['sheng'] ?></td>
                                            <td><?php echo $row['cheng'] ?></td>
                                            <td class="text-right">
                                                <a href="customer_edit.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-success mr-2"><i
                                                            class="far fa-edit mr-1"></i>编辑</a>
                                                <a onclick="if(confirm('确认删除吗?')){location.href='delcustomer.php?id=<?php echo $row['id'] ?>';}"
                                                   class="btn btn-sm btn-white text-danger mr-2"><i
                                                            class="far fa-trash-alt mr-1"></i>删除</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="11" align="right">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                 id="DataTables_Table_0_paginate"><?php echo $page_num; ?></div>
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

<?php include "com_script.php"; ?>
<script>
    $(document).ready(function () {
        $("#customer").addClass("active");
    })
</script>

</body>
</html>