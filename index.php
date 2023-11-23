<?php
include './utils/check.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include './utils/db_user.php';

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

            <div class="row">
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon bg-1">
											<i class="fas fa-dollar-sign"></i>
										</span>
                                <div class="dash-count">
                                    <div class="dash-title">订单总金额</div>
                                    <div class="dash-counts">
                                        <p>1,642</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i
                                            class="fas fa-arrow-down mr-1"></i>1.15%</span> 比上周</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
										<span class="dash-widget-icon bg-2">
											<i class="fas fa-users"></i>
										</span>
                                <div class="dash-count">
                                    <div class="dash-title">顾客数量</div>
                                    <div class="dash-counts">
                                        <p>3,642</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-3 mb-0"><span class="text-success mr-1"><i
                                            class="fas fa-arrow-up mr-1"></i>2.37%</span> 比上周</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">

                </div>
                <div class="col-xl-3 col-sm-6 col-12">

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
        $("#home").addClass("active");
    })
</script>

</body>
</html>