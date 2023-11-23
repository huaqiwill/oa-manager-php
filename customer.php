<?php
include './utils/check.php';
check_login();
header_html();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include './utils/db_customer.php';
    //参数列表
    $username = $_SESSION['username'];
    $wechat = isset($_GET['wechat']) ? $_GET['wechat'] : '';
    $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
    $page = isset($_GET['rows']) ? $_GET['rows'] : 1;
    $page_size = isset($_GET['page_size']) ? (int)$_GET['page_size'] : 10;
    $records = customer_list($username, $phone, $wechat, $page, $page_size);
    // 计算分页上限
    $amount = customer_count($username);
    $pages = ceil($amount / $page_size);
    foreach ($records as $record) {
        $page_num = ' ';
        for ($i = 1; $i <= $pages; $i++) {
            $page_num .= '<a href="db_customer.php?rows=' . $i . '" style=" color:#333; text-decoration:none; padding:3px 10px; margin-right:5px; border:1px solid #333;">' . $i . '</a>';
        }
        $page_num .= '共 ' . $amount . " 条记录";
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './utils/db_customer.php';


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
                        <a class="btn btn-primary filter-btn" onclick="orderListGet()" id="filter_search">
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
                                    <label for="wechat">客户微信</label>
                                    <input id="wechat" type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="phone">客户手机</label>
                                    <input id="phone" type="text" class="form-control" name="tel">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label></label>
                                    <input id="search_orders" type="button" value="查找" class="form-control btn-primary"
                                           style="color:#fff;"
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
                                        <th>客户类型</th>
                                        <th>客户姓名</th>
                                        <th>性别</th>
                                        <th>客户来源</th>
                                        <th>手机</th>
                                        <th>微信号</th>
                                        <th>锁定日期</th>
                                        <th>省份</th>
                                        <th>城市</th>
                                        <th>搭配总额</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($records as $row) : ?>
                                        <tr class="customer-row" data-id="<?php echo $row['id']; ?>">
                                            <td><?php echo $row['ctype'] ?></td>
                                            <td><?php echo $row['cname'] ?></td>
                                            <td><?php echo $row['sex'] ?></td>
                                            <td><?php echo $row['laiyuan'] ?></td>
                                            <td><?php echo $row['tel'] ?></td>
                                            <td><?php echo $row['weixin'] ?></td>
                                            <td><?php echo $row['date01'] ?></td>
                                            <td><?php echo $row['sheng'] ?></td>
                                            <td><?php echo $row['cheng'] ?></td>
                                            <td>0</td>
                                            <td class="text-right">
                                                <a href="customer_edit.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-success mr-2"><i
                                                            class="far fa-edit mr-1"></i>编辑</a>
                                                <a href="customer_edit.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-info mr-2"><i
                                                            class="far fa-edit mr-1"></i>录订单</a>
                                                <a href="customer_delete.php?id=<?php echo $row['id'] ?>"
                                                   class="btn btn-sm btn-white text-danger mr-2"><i
                                                            class="far fa-trash-alt mr-1"></i>删除</a>
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
                                <div id="dingDataContainer">

                                </div>
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

<script type="text/javascript">
    function getQueryVariable(variable) {
        let query = window.location.search.substring(1);
        let vars = query.split("&");
        for (let i = 0; i < vars.length; i++) {
            let pair = vars[i].split("=");
            if (pair[0] === variable) {
                return pair[1];
            }
        }
        return '';
    }

    $(document).ready(function () {
        $(".customer-row").click(function () {
            let customerName = $(this).find("td:eq(1)").text(); // Assuming the customer name is in the second column (index 1)
            $.ajax({
                type: "GET",
                url: "customer_order_list.php",
                data: {
                    customerName: customerName
                },
                success: function (data) {
                    $("#dingDataContainer").empty().append(data);
                },
                error: function () {
                    alert("从服务器获取数据时出错。");
                },
            });
            $(this).css({
                backgroundColor: "#c7e8ef"
            })
            $(this).siblings().css({
                backgroundColor: "#fff"
            })
        });

        let phone = getQueryVariable("phone");
        let wechat = getQueryVariable("wechat");
        if (wechat !== '' || phone !== '') {
            $("#filter_search").click();
            $("#phone").val(phone);
            $("#wechat").val(wechat);
        }
    });

    function orderListGet() {
        let status = document.getElementById('filter_inputs');
        const element = document.getElementById('filter_inputs');
        const computedStyle = getComputedStyle(element);
        const display = computedStyle.display;
        if (display === 'none') {
            document.getElementById('filter_inputs').style.display = 'block';
        } else {
            document.getElementById('filter_inputs').style.display = 'none';
        }
    }

    function searchOrders() {
        let wechat = $("input[name='name']").val().toLowerCase();
        let phone = $("input[name='tel']").val().toLowerCase();
        window.location.href = 'db_customer.php?phone=' + phone + '&wechat=' + wechat;
    }
</script>


</body>

</html>