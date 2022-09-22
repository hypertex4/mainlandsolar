<?php include_once("inc/header.inc.php") ; ?>
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>
                            ADD MAINTENANCE HISTORY<small>Mainlandsolar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Maintenance History</li>
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
                        <h5>Add Maintenance History</h5>
                    </div>
                    <form name="createMaintenanceHistory" id="createMaintenanceHistory">
                        <?php $res = $admin->read_installation_histories_by_id( isset($_GET['historyId'])?$_GET['historyId']:''); ?>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="col-form-label pt-0"><span>*</span> Name of installation:</label>
                                        <input class="form-control" id="name" name="name" type="text"
                                               value="<?=isset($res['name_of_ins'])?$res['name_of_ins']:'';?>">
                                        <input id="project_id" name="project_id" type="hidden"
                                               value="<?= isset($_GET['historyId'])?$_GET['historyId']:'';?>">
                                        <input type="hidden" name="action_code" value="1002">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="size" class="col-form-label pt-0"><span>*</span> Size of installation:</label>
                                        <input class="form-control" id="size" name="size" type="text"
                                               value="<?=isset($res['size_of_ins'])?$res['size_of_ins']:'';?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="components" class="col-form-label pt-0"><span>*</span> System components:</label>
                                        <input class="form-control" id="components" name="components" type="text"
                                               value="<?=isset($res['sys_comps'])?$res['sys_comps']:'';?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="comp_date" class="col-form-label pt-0"><span>*</span> Date of completion of installation:</label>
                                        <input class="form-control" id="comp_date" name="comp_date" type="date"
                                               value="<?=isset($res['date_of_com'])?$res['date_of_com']:'';?>">
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
                                        <input class="form-control" id="client_email" name="client_email" type="email"
                                               value="<?=isset($res['client_email'])?$res['client_email']:'';?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="client_add" class="col-form-label pt-0"><span>*</span> Client Address:</label>
                                        <input class="form-control" id="client_add" name="client_add" type="text"
                                               value="<?=isset($res['client_add'])?$res['client_add']:'';?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="client_city" class="col-form-label pt-0"><span>*</span> Client City/Area:</label>
                                        <input class="form-control" id="client_city" name="client_city" type="text"
                                               value="<?=isset($res['client_city'])?$res['client_city']:'';?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="client_state" class="col-form-label pt-0"><span>*</span> State:</label>
                                        <select class="form-control" name="client_state" id="client_state">
                                            <option value=""></option>
                                            <option value="Lagos" <?=($res['client_state']=="Lagos")?'selected':'';?>>Lagos</option>
                                            <option value="Osun" <?=($res['client_state']=="Osun")?'selected':'';?>>Osun</option>
                                            <option value="Oyo" <?=($res['client_state']=="Oyo")?'selected':'';?>>Oyo</option>
                                            <option value="Ogun" <?=($res['client_state']=="Ogun")?'selected':'';?>>Ogun</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><hr style="1px solid #ccc" /></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="product-buttons text-center">
                                        <button type="submit" class="btn btn-primary" id="createMainHistoryBtn">
                                            <i class="fa fa-spinner fa-spin mr-3 d-none"></i>Add Maintenance History
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