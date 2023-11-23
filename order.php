<?php
include './utils/check.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './utils/db_order.php';
    include './utils/db_user.php';
    include './utils/result.php';

    $page = $_POST['page'];
    $page_size = $_POST['page_size'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    $uid = user_get_id($_SESSION['username']);
    $records = order_list($uid, $page, $page_size, $name, $phone);
    ret_ok("请求成功", $records);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include './utils/db_order.php';
    include './utils/db_user.php';

    //参数列表
    $uid = user_get_id($_SESSION['username']);
    // 分页上限
    $page_size = isset($_GET['page_size']) ? $_GET['page_size'] : 10;
    $amount = order_count($uid);
    $pages = ceil($amount / $page_size);
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
                        <h3 class="page-title">订单管理</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="order.php">主页</a>
                            </li>
                            <li class="breadcrumb-item active">订单管理</li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="order_add.php" class="btn btn-primary mr-1">
                            <i class="fas fa-plus"></i>
                        </a>
                        <a class="btn btn-primary filter-btn" id="filter_search">
                            <i class="fas fa-filter"></i>
                        </a>
                    </div>
                </div>
            </div>

            <form action="order.php" method="post">
                <!-- /Page Header -->
                <div id="filter_inputs" class="card filter-card">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="name">客户姓名</label>
                                    <input id="name" type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="tel">客户手机</label>
                                    <input id="tel" type="text" class="form-control" name="tel">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <input type="button" value="查找"
                                           class="form-control btn-primary text-white"
                                           onclick="order_query()">
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
                                        <th>订单状态</th>
                                        <th>订单号</th>
                                        <th>金额</th>
                                        <th>收件人姓名</th>
                                        <th>客户手机</th>
                                        <th>快递公司</th>
                                        <th>快递单号</th>
                                        <th>录入日期</th>
                                        <th>提交日期</th>
                                        <th>客户姓名</th>
                                        <th class="text-center">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table_items">
                                    <!--数据位置-->
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="12" align="right">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                 id="DataTables_Table_0_paginate">
                                                <!--分页-->
                                                <?php for ($i = 1; $i <= $pages; $i++): ?>
                                                    <a href="order.php?page=<?php echo $i ?>&page_size=<?php echo $page_size ?>"
                                                       style=" color:#333; text-decoration:none; padding:3px 10px; margin-right:5px; border:1px solid #333;">
                                                        <?php echo $i ?>
                                                    </a>
                                                <?php endfor; ?>
                                                共<?php echo $amount ?>条记录
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
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
        return undefined;
    }

    $(document).ready(function () {
        $("#order").addClass("active");
        $("#filter_search").click(function () {
            let status = document.getElementById('filter_inputs');
            const element = document.getElementById('filter_inputs');
            const computedStyle = getComputedStyle(element);
            const display = computedStyle.display;
            if (display === 'none') {
                document.getElementById('filter_inputs').style.display = 'block';
            } else {
                document.getElementById('filter_inputs').style.display = 'none';
            }
        })
        order_query();
    })

    function order_delete(id) {
        if (confirm('确认删除吗?')) {
            location.href = 'order_delete.php?id=' + id;
        }
    }

    function order_submit(id) {

    }

    function order_list(page, page_size, name, phone) {
        $.ajax({
            url: "order.php",
            type: "POST",
            data: {name, phone, page, page_size},
            success: function (response) {
                let $table = $("#table_items");
                if (response.code === 200) {
                    $table.empty();
                    if (response.data === undefined) {
                        return;
                    }
                    for (let i = 0; i < response.data.length; i++) {
                        let data = response.data[i];
                        $tr = $(`
                            <tr>
                                <td>${data.id === 0 ? "录入" : "已提交"}</td>
                                <td>${data.ordernum}</td>
                                <td>${data.total}</td>
                                <td>${data.shouname}</td>
                                <td>${data.tel}</td>
                                <td>${data.kuainame}</td>
                                <td>${data.kuainum}</td>
                                <td>${data.date01}</td>
                                <td>${data.date02}</td>
                                <td>${data.kename}</td>
                                <td class="text-right">
                                    <a href="order_edit.php?id=${data.id}"
                                       class="btn btn-sm btn-white text-success mr-2">
                                        <i class="far fa-edit mr-1"></i>
                                        修改
                                    </a>
                                    <a onclick="order_delete(${data.id})"
                                       class="btn btn-sm btn-white text-danger mr-2">
                                        <i class="far fa-trash-alt mr-1"></i>
                                        删除
                                    </a>
                                    <a onclick="order_submit(${data.id})"
                                       class="btn btn-sm btn-white text-primary mr-2">
                                        <i class="far fa-trash-alt mr-1"></i>
                                        提交
                                    </a>
                                </td>
                            </tr>`);
                        $table.append($tr);
                    }
                } else {
                    alert(response.message);
                }
            }
        })
    }


    function order_query() {
        let name = $("#name").val();
        let phone = $("#tel").val();
        let page = getQueryVariable("page") || 1;
        let page_size = getQueryVariable("page_size") || 10;
        console.log(name)
        order_list(page, page_size, name, phone);
    }

</script>
</body>
</html>