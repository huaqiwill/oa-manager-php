<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>无标题文档</title>
</head>

<body>

<div class="row">
    <div class="col-md-1">商品<br>名称</div>
    <div class="col-md-8">
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
        <a href="#" class="btn btn-primary" onclick="doadd()">添加</a>
    </div>

</div>


</body>
<script type="text/javascript">
    function doadd() {
        var selectIndex = document.getElementById("gid").selectedIndex;
        var id = document.getElementById('gid').options[selectIndex].id;
        window.location = "doadd.php?gid=" + id;
    }
</script>
</html>
