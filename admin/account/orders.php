<?php
include_once("../inc/header.main.php");
if (!isset($_SESSION['USER_LOGIN']) && !isset($_SESSION['USER_LOGIN']['customer_id'])) header('Location: ../index');
?>
    </div>
    <div class="container my-md-5 w-100 user_account">
        <div class="row no-gutters">
            <div class="col-3"><?php include_once 'account-sidebar.php'; ?></div>
            <div class="col-12 col-md-9">
                <main class="main_area">
                    <div class="px-3">
                        <div>
                            <button class="btn p-0 my-3 d-block d-md-none" id="userAccountMenuBtn"><span data-feather="menu"></span></button>
                        </div>
                        <div class="container p-0">
                            <?php
                            $url = CONTROLLER_ROOT_URL."/v5/read-order.php?customer_id=".$_SESSION['USER_LOGIN']['customer_id'];
                            $object = $api->curlQueryGet($url);
                            if($object->status == 200)  {
                            ?>
                            <div class="table-responsive" style="border: 1px solid rgba(0,0,0,.125);">
                                <table class="table order_table table-borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="order_number">Order #</th>
                                        <th scope="col" class="date">Date</th>
                                        <th scope="col" class="ship_to">Ship To</th>
                                        <th scope="col" class="total_amount">Total Amount</th>
                                        <th scope="col" class="status">Status</th>
                                        <th scope="col" class="details">Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $n = 0; foreach ($object->orders as $item) { ?>
                                    <tr>
                                        <th scope="row"><?= ++$n; ?></th>
                                        <td><?= date('d/m/Y', strtotime($item->order_on)); ?></td>
                                        <td><?= $item->receiver_fullname; ?></td>
                                        <td>₦<?= number_format($item->order_amount,2); ?></td>
                                        <td>
                                            <?=($item->order_status==='Delivered')?
                                                "<span class='text-success'>Delivered</span>":
                                                "<span class='text-muted'>".$item->order_status."</span>"; ?>
                                        </td>
                                        <td>
                                        <a href="account/order-details/<?= bin2hex($item->order_id); ?>" class="btn btn_primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else { ?>
                            <div class="alert alert-info text-center" role="alert">No Orders</div>
                            <?php }  ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
<?php include_once("../inc/footer.main.php"); ?>