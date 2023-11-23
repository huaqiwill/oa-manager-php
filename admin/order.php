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
                        <h3 class="page-title">订单管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">主页</a>
                            </li>
                            <li class="breadcrumb-item active">订单管理</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="order_add.php" class="btn btn-primary mr-1">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-primary filter-btn" onclick="panduan()" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <form action="order.php" method="post">
                <!-- /Page Header -->
                <div id="filter_inputs" class="card filter-card">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>客户姓名</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>客户手机</label>
                                    <input type="text" class="form-control" name="tel">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label></label>
                                    <input type="button" value="查找" class="form-control btn-primary" style="color:#fff;"
                                           onclick="searchOrders()">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <div class="row">
                <div class="col-sm-12">

                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>订单类型</th>
                                        <th>销售订单</th>
                                        <th>金额</th>
                                        <th>收件人姓名</th>
                                        <th>客户手机</th>
                                        <th>快递公司</th>
                                        <th>快递单号</th>
                                        <th>发货日期</th>
                                        <th>提交日期</th>
                                        <th>确认日期</th>
                                        <th>客户姓名</th>
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
                                    $sql = "select count(*) as amount from ding";
                                    $result = mysql_query($sql);
                                    $row = mysql_fetch_row($result);
                                    $amount = $row[0];
                                    // 分页上限
                                    $pages = ceil($amount / $PageSize);
                                    $sql_query = "select * from ding limit " . ($page - 1) * $PageSize . ",$PageSize";
                                    $result = mysql_query($sql_query);
                                    $records = array();
                                    while ($record = mysql_fetch_array($result)) {
                                        $records[] = $record;


                                        $PageHtml = ' ';
                                        for ($i = 1; $i <= $pages; $i++) {
                                            $PageHtml .= '<a href="db_customer.php?rows=' . $i . '" style=" color:#333; text-decoration:none; padding:3px 10px; margin-right:5px; border:1px solid #333;">' . $i . '</a>';

                                        }
                                        $PageHtml .= '共 ' . $amount . " 条记录";
                                    }
                                    foreach ($records as $row) :
                                        ?>

                                        <tr>
                                            <td><?php echo $row['type'] ?></td>
                                            <td><?php echo $row['ordernum'] ?></td>
                                            <td><?php echo $row['total'] ?></td>
                                            <td><?php echo $row['shouname'] ?></td>
                                            <td><?php echo $row['tel'] ?></td>
                                            <td><?php echo $row['kuainame'] ?></td>
                                            <td><?php echo $row['kuainum'] ?></td>
                                            <td><?php echo $row['date01'] ?></td>
                                            <td><?php echo $row['date02'] ?></td>
                                            <td><?php echo $row['date03'] ?></td>
                                            <td><?php echo $row['kename'] ?></td>
                                            <td class="text-right">
                                                <a href="order_confirm.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-success mr-2"><i
                                                            class="far fa-edit mr-1"></i>确认</a>
                                                <a href="order_confirm.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-success mr-2"><i
                                                            class="far fa-edit mr-1"></i>打印</a>
                                                <a href="order_detail.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-success mr-2"><i
                                                            class="far fa-detail mr-1"></i>查看</a>
                                                <a href="order_delete.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-danger mr-2"><i
                                                            class="far fa-trash-alt mr-1"></i>删除</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="12" align="right">
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
<script type="text/javascript">
    function panduan() {
        var status = document.getElementById('filter_inputs');
        const element = document.getElementById('filter_inputs');
        const computedStyle = getComputedStyle(element);
        const display = computedStyle.display;
        if (display == 'none') {
            document.getElementById('filter_inputs').style.display = 'block';
        } else {
            document.getElementById('filter_inputs').style.display = 'none';
        }
    }

    function searchOrders() {
        var name = document.getElementsByName('name')[0].value.toLowerCase();
        var tel = document.getElementsByName('tel')[0].value.toLowerCase();

        var table = document.querySelector('.datatable');
        var rows = table.querySelectorAll('tbody tr');

        for (var i = 0; i < rows.length; i++) {

            var row = rows[i];
            var cells = row.cells; // Get all cells in the row

            if (cells.length >= 5) {
                var customerName = cells[10].textContent.toLowerCase();
                var customerTel = cells[4].textContent.toLowerCase();

                if ((name === '' || customerName.includes(name)) && (tel === '' || customerTel.includes(tel))) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            } else {
                console.error('Row does not have enough cells');
            }
        }
    }
</script>
<?php include "com_script.php" ?>
<script>
    $(document).ready(function () {
        $("#order").addClass("active");
    })
</script>

</body>
</html>