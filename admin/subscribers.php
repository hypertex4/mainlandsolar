<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            News Subscribers<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Subscribers</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>News Letter Subscriber List</h5>
                    </div>
                    <div class="card-body">
                        <div class="btn-popup pull-right">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Copy All Subscribers</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="exampleModalLabel">All Subscribers</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form>
                                            <div class="modal-body">
                                                <div class="form">
                                                    <textarea class="form-control" cols="30" rows="7" aria-label="" readonly><?php
                                                        $sub = $admin->list_news_subscribers();
                                                        if ($sub->num_rows > 0) {$em = '';
                                                            while ($row = $sub->fetch_assoc()) {$em .= $row['subscriber_email'] . ',';}
                                                            echo $tem = substr($em, 0, -1);
                                                        }
                                                        ?></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="display" id="Product">
                        <thead>
                        <tr>
                            <th>Subscriber ID</th>
                            <th>Client Email</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sub = $admin->list_news_subscribers();
                        if ($sub->num_rows > 0) {
                            while ($subscriber = $sub->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td class="font-weight-bold">#<?= $subscriber['subscriber_id'];?></td>
                                    <td><h6><?=$subscriber['subscriber_email'];?></h6></td>
                                    <td class="text-success"><i class="fa fa-circle font-success f-12 mr-2"></i><span>Active</span></td>
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
