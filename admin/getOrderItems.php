<?php
include_once ('../controllers/classes/Admin.class.php');
$det = $admin->list_ordered_items($_GET['order_id']);
if ($det->num_rows > 0) {
    echo "<div class='container-fluid'><div class='row'>";
while ($detail = $det->fetch_assoc()) {
//    if($detail['category_id']==4899){
//        $rate = 0.02;
//    } elseif($detail['category_id']==4265){
//        $rate = 0.03;
//    } elseif($detail['category_id']==4188){
//        $rate = 0.015;
//    } elseif($detail['category_id']==4162){
//        $rate = 0.015;
//    } elseif($detail['category_id']==4531){
//        $rate = 0.01;
//    } else {
//        $rate = 0.00;
//    }
//    $total= $detail['pro_price'] * $detail['product_qty'];
//    $comm = $rate * $total;
//    $totPay= $total - $comm;
    ?>
    <div class="col-xl-3 col-sm-6">
        <div class="card w-100 product">
            <div class="card-body">
                <div class="product-box p-0">
                    <div class="product-imgbox">
                        <div class="product-front">
                            <img src="./<?=$detail['pro_image1'];?>" class="img-fluid" alt="product">
                        </div>
                        <div class="product-back">
                            <img src="./<?=$detail['pro_image2'];?>" class="img-fluid" alt="product">
                        </div>
                        <div class="new-label1"><div>Qty: <?=$detail['product_qty'];?></div></div>
                    </div>
                    <div class="product-detail detail-inline p-0">
                        <div class="detail-title">
                            <div class="detail-left">
                                <h6 class="price-title"><?=$detail['pro_title'];?></h6>
                            </div>
                            <div class="detail-left font-weight-bold">
                                Qty: <?=$detail['product_qty'];?>
                            </div>
                            <div class="detail-right">
                                <div class="price">
                                    <div class="price">₦<?=number_format($detail['pro_price'],0);?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } echo "</div></div>"; } ?>