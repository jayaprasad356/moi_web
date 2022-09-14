<?php
include_once('includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;
// session_start();
$function_id = $_GET['id'];
?>
<section class="content-header">
    <h1>மொய்களை காட்டு</h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
<div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">மொய் விவரஙஂகளஂ</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <table class="table table-bordered">
                        <?php
                        $sql = "SELECT * FROM moi WHERE id = $function_id";
                        $db->sql($sql);
                        $res = $db->getResult();
                        $num = $db->numRows();
                        if($num >= 1){

                            $sql = "SELECT *,functions.id AS id FROM functions,moi,users WHERE moi.user_id=users.id AND moi.function_id=functions.id  AND functions.id = $function_id";
                            $db->sql($sql);
                            $res = $db->getResult();
                            ?>
                            <tr>
                                <th style="width: 200px">ID</th>
                                <td><?php echo $res[0]['id'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Name</th>
                                <td><?php echo $res[0]['name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Mobile</th>
                                <td><?php echo $res[0]['mobile'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Location</th>
                                <td><?php echo $res[0]['location'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Amount</th>
                                <td><?php echo $res[0]['amount'] ?></td>
                            </tr>
                           
                            <?php
                        }
                        else{
                            echo "<tr><td colspan='2'>No Data Found</td></tr>";
                        }
                        ?>
    
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="functions.php" class="btn btn-sm btn-default btn-flat pull-left">Back</a>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
</section>
<div class="separator"> </div>