<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Installation Histories <small>Mainlandsolar Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Installation</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Installation Histories</h5>
                    </div>
                    <div class="card-body">
                        <table class="display" id="Product" style="font-size: 12px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Project ID</th>
                                <th>Client Email</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Components</th>
                                <th>Ins. Completed On</th>
                                <th>Issued Raised</th>
                                <th>Re. Issued On</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $res = $admin->list_installation_histories();
                            if ($res->num_rows > 0) {
                                while ($ins = $res->fetch_assoc()) {$n=1;
                                    ?>
                                    <tr>
                                        <td><?=$n++;?></td>
                                        <td class="font-weight-bold">
                                            <a href="history-details?historyId=<?= $ins['history_id'];?>" title="View and Print"><?= $ins['history_id'];?></a>
                                        </td>
                                        <td><?=$ins['client_email'];?></td>
                                        <td>
                                            <a href="history-details?historyId=<?= $ins['history_id'];?>" title="View and Print"><?= $ins['name_of_ins'];?></a>
                                        </td>
                                        <td><?= $ins['size_of_ins'];?></td>
                                        <td><?= $ins['sys_comps'];?></td>
                                        <td><?= $ins['date_of_com'];?></td>
                                        <td><?= substr($ins['issues_raised'],0,20)."...";?></td>
                                        <td><?= $ins['date_issued'];?></td>
                                    </tr>
                                <?php } }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("inc/footer.inc.php") ; ?>
    <script src="assets/js/admin-form-reducer.js"></script>
    <script>
        $(document).ready(function() {
            $('#Product').DataTable({
                "bSort":false
            });
        });
    </script>
