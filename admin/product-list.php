<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Product List<small>Mainlandsolar Admin panel</small></h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Products</li>
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
                        <h5>Product List</h5>
                    </div>
                    <div class="card-body">
                        <table class="display table table-bordered table-striped" id="Product" style="font-size: 12px">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Panel</th>
                                <th>Batt.Type</th>
                                <th>Inv.Type</th>
                                <th>Status</th>
                                <th>StockStatus</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $prod = $admin->list_products();
                            if ($prod->num_rows > 0) {
                                while ($product = $prod->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold"><a href="edit-product/<?= $product['pro_id']; ?>">#<?= $product['pro_id'];?></a></td>
                                        <td><img src="<?=$product['pro_image1'];?>" alt="" style="height: 50px; width: 50px;"></td>
                                        <td><a href="edit-product/<?= $product['pro_id']; ?>"><?=$product['pro_title'];?></a></td>
                                        <td><?=$product['category_name'];?></td>
                                        <td class="font-weight-bold text-success">
                                            <h6>₦<?=number_format($product['pro_price'],0); ?></h6>
                                        </td>
                                        <td class="font-weight-bold"><?=!empty($product['solar_panel'])?$product['solar_panel'].'Watt':'';?></td>
                                        <td class="font-weight-bold"><?=!empty($product['batt_type'])?$product['batt_type'].'Ah / '.$product['batt_volts'].'V':'';?></td>
                                        <td class="font-weight-bold"><?=!empty($product['inv_type'])?$product['inv_type'].'W / '.$product['inv_volts'].'V':'';?></td>
                                        <?php if ($product['pro_active'] =="0") { ?>
                                            <td><span class="badge badge-danger">In-Active</span></td>
                                        <?php } elseif ($product['pro_active'] =="1") { ?>
                                            <td><span class="badge badge-success">Active</span></td>
                                        <?php } ?>
                                        <?php if ($product['pro_stock'] =="0") { ?>
                                            <td><span class="badge badge-dark"><small>Out of Stock</small></span></td>
                                        <?php } elseif ($product['pro_stock'] =="1") { ?>
                                            <td><span class="badge badge-success">In-Stock</span></td>
                                        <?php } ?>
                                        <td>
                                            <div style="display: flex;">
                                            <?php if ($product['pro_active'] =="0"){ ?>
                                                <button type="button" class="btn btn-sm px-2 btn-success" id="ApprovedProductBtn" data-id="<?= $product['pro_id'];?>" data-status="1">
                                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i> Activate
                                                </button>
                                            <?php } else if ($product['pro_active'] =="1"){ ?>
                                                <button type="button" class="btn btn-sm px-2 btn-danger" id="ApprovedProductBtn" data-id="<?= $product['pro_id'];?>" data-status="0">
                                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i> De-Activate
                                                </button>
                                            <?php } ?>
                                            <?php if ($product['pro_stock'] =="0"){ ?>
                                                <button type="button" class="btn btn-sm px-2 ml-2 btn-info" id="StockProductBtn" data-id="<?= $product['pro_id'];?>" data-status="1">
                                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i> Re-Stock
                                                </button>
                                            <?php } else if ($product['pro_stock'] =="1"){ ?>
                                                <button type="button" class="btn btn-sm px-2 ml-2 btn-dark" id="StockProductBtn" data-id="<?= $product['pro_id'];?>" data-status="0">
                                                    <i class="fa fa-spinner fa-spin mr-3 d-none"></i> OutOfStock
                                                </button>
                                            <?php } ?>
                                            </div>
                                        </td>
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
