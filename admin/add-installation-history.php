<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            ADD INSTALLATION HISTORY<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Installation History</li>
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
                        <h5>Add Installation History</h5>
                    </div>
                    <form name="createInstallationHistory" id="createInstallationHistory">
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label pt-0"><span>*</span> Name of installation:</label>
                                        <input class="form-control" id="name" name="name" type="text">
                                        <input type="hidden" name="action_code" value="1001">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="size" class="col-form-label pt-0"><span>*</span> Size of installation:</label>
                                        <input class="form-control" id="size" name="size" type="text">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="components" class="col-form-label pt-0"><span>*</span> System components:</label>
                                        <input class="form-control" id="components" name="components" type="text">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="comp_date" class="col-form-label pt-0"><span>*</span> Date of completion of installation:</label>
                                        <input class="form-control" id="comp_date" name="comp_date" type="date">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="issues" class="col-form-label pt-2"><span>*</span> Issues raised:</label>
                                        <textarea name="issues" id="issues" rows="5" cols="12" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="action" class="col-form-label pt-2">
                                            <span>*</span> Troubleshooting and action performed for resolution:
                                        </label>
                                        <textarea name="action" id="action" rows="5" cols="12" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="issue_date" class="col-form-label pt-0"><span>*</span> Date of issue report:</label>
                                        <input class="form-control" id="issue_date" name="issue_date" type="date">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="resolved_date" class="col-form-label pt-0"><span>*</span> Date resolved:</label>
                                        <input class="form-control" id="resolved_date" name="resolved_date" type="date">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="client_email" class="col-form-label pt-0"><span>*</span> Client Email:</label>
                                        <input class="form-control" id="client_email" name="client_email" type="email">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="client_add" class="col-form-label pt-0"><span>*</span> Client Address:</label>
                                        <input class="form-control" id="client_add" name="client_add" type="text">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="client_city" class="col-form-label pt-0"><span>*</span> Client City/Area:</label>
                                        <input class="form-control" id="client_city" name="client_city" type="text">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="client_state" class="col-form-label pt-0"><span>*</span> State:</label>
                                        <select class="form-control" name="client_state" id="client_state">
                                            <option value=""></option>
                                            <option value="Lagos">Lagos</option>
                                            <option value="Osun">Osun</option>
                                            <option value="Oyo">Oyo</option>
                                            <option value="Ogun">Ogun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><hr style="1px solid #ccc" /></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="product-buttons text-center">
                                        <button type="submit" class="btn btn-primary" id="createInsHistoryBtn">
                                            <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Add History
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