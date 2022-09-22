<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            ADD PRODUCTS<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Products</li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <div class="container-fluid">
        <div class="row product-adding">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Product Details</h5>
                    </div>
                    <form name="createProduct" id="createProduct">
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="title" class="col-form-label pt-0"><span>*</span> Product Title</label>
                                        <input class="form-control prep_slug" id="title" name="title" type="text">
                                        <input type="hidden" name="action_code" value="601">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="category" class="col-form-label pt-0"><span>*</span> Categories</label>
                                        <select class="custom-select" name="category" id="category">
                                            <option value="">--Select Category--</option>
                                            <?php
                                            $cat = $admin->list_product_category();
                                            if ($cat->num_rows > 0) {
                                                while ($category = $cat->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?=$category['category_id'];?>"><?=$category['category_name'];?></option>
                                                <?php } }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="dataset" class="col-form-label pt-0"><span></span> Upload Datasheet <small>(optionally)</small></label>
                                        <input type="file" id="dataset" name="dataset" class="form-control pt-1" style="height: 38px;" accept="application/pdf">
                                    </div>
                                    <div class="form-group col-md-6 tvExtraFilterSolar" style="display: none;">
                                        <label for="solar_type" class="col-form-label pt-0"><span>*</span> Solar Panel Type</label>
                                        <select class="custom-select" name="solar_type" id="solar_type">
                                            <option value="">--Select Solar Panel Type--</option>
                                            <option value="350">350 Watt</option>
                                            <option value="400">400 Watt</option>
                                            <option value="450">450 Watt</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 tvExtraFilterBattery" style="display: none;">
                                        <label for="battery_type" class="col-form-label pt-0"><span>*</span> Battery Type</label>
                                        <select class="custom-select" name="battery_type" id="battery_type">
                                            <option value="">--Battery Type--</option>
                                            <option value="150">150Ah</option>
                                            <option value="200">200Ah</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 tvExtraFilterBattery" style="display: none;">
                                        <label for="battery_volt" class="col-form-label pt-0"><span>*</span> Battery Volt</label>
                                        <select class="custom-select" name="battery_volt" id="battery_volt">
                                            <option value="">--Select Battery Volt--</option>
                                            <option value="12">12 Volt</option>
                                            <option value="24">24 Volt</option>
                                            <option value="48">48 Volt</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 tvExtraFilterInverter" style="display: none;">
                                        <label for="inverter_type" class="col-form-label pt-0"><span>*</span> Inverter Type</label>
                                        <select class="custom-select" name="inverter_type" id="inverter_type">
                                            <option value="">--Inverter Type--</option>
                                            <option value="500">500 Watt</option>
                                            <option value="1000">1000 Watt (1KW)</option>
                                            <option value="2000">2000 Watt (2KW)</option>
                                            <option value="3000">3000 Watt (3KW)</option>
                                            <option value="5000">5000 Watt (5KW)</option>
											<option value="8000">8000 Watt (8KW)</option>
                                            <option value="10000">10000 Watt (10KW)</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 tvExtraFilterInverter" style="display: none;">
                                        <label for="inverter_volt" class="col-form-label pt-0"><span>*</span> Inverter Volt</label>
                                        <select class="custom-select" name="inverter_volt" id="inverter_volt">
                                            <option value="">--Select Inverter Volt--</option>
                                            <option value="12">12 Volt</option>
                                            <option value="24">24 Volt</option>
                                            <option value="48">48 Volt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="slug" class="col-form-label pt-2"><span>*</span> SLUG</label>
                                        <input class="form-control" id="slug" name="slug" type="text">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="price" class="col-form-label pt-2"><span>*</span> Product Price (₦)</label>
                                        <input type="number" id="price" name="price" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label pt-2"><span>*</span> Product Image 1</label>
                                        <input type="file" id="image_1" name="image_1" class="form-control" accept="image/*">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label pt-2">Product Image 2</label>
                                        <input type="file" id="image_2" name="image_2" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label pt-2">Product Image 3</label>
                                        <input type="file" id="image_3" name="image_3" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="specification" class="col-form-label pt-2">Product Specifications</label>
                                        <textarea name="specification" id="specification" rows="5" cols="12" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="description" class="col-form-label pt-2">Product Description</label>
                                        <textarea name="description" id="description" rows="5" cols="12" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><hr style="1px solid #ccc" /></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="product-buttons text-center">
                                        <button type="submit" class="btn btn-primary" id="createProductBtn">
                                            <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Create Product
                                        </button>
                                        <button type="reset" class="btn btn-light">Discard</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once("inc/footer.inc.php") ; ?>
<script src="assets/js/admin-form-reducer.js"></script>
<script>
    $('.prep_slug').on('blur', function () {
        $('input[name="slug"]').val(($(this).val()).replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g,'-').toLowerCase());
        $('input[name="title"]').val(($(this).val()).replace(/[^a-z0-9\s]/gi, ''));
    });
    $("#category").on('change', function () {
        var selected_option = $('#category').val();
        if (selected_option === '4384') {$('.tvExtraFilterSolar').show();} else { $(".tvExtraFilterSolar").hide();}
        if (selected_option === '4908' || selected_option === '4172') {$('.tvExtraFilterBattery').show();} else { $(".tvExtraFilterBattery").hide();}
        if (selected_option === '4279') {$('.tvExtraFilterInverter').show();} else { $(".tvExtraFilterInverter").hide();}
    });
</script>
