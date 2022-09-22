<?php include_once("inc/header.nav.php"); ?>
<?php if (isset($_POST['installation-choice']) && !empty($_POST['installation-choice'])) { ?>
    <style>
        .hint__circle {
            height: 15px;
            width: 15px;
            margin: 0 auto;
            -webkit-border-radius: 100px;
            color: black;
            text-align: center;
            line-height: 12px;
            font-family: arial;
            font-size: 10px;
            border: 2px solid black;
            opacity: .4;
        }

        .hint__circle:hover {
            border: 2px solid #f37920;
            color: #f37920;
            cursor: pointer;
            opacity: 1;
        }
    </style>
<div id="load-system-questionnaire-page">
    <div class="bg-white">
        <div class="container auto-wrapper">
            <ul class="breadcrumb">
                <li><a href="./">Home</a></li>
                <li><a href="services">Support and services</a></li>
                <li>Load/System Questionnaire</li>
            </ul>
            <div class="title-wrapper">
                <hr class="my-0">
                <h1 class="title mb-0 uppercase">Load/System Questionnaire</h1>
                <hr class="my-0">
            </div>
            <section class="py-4" id="step-2">
                <div id="progress-bar">
                    <div id="reader" class="default_width"></div>
                    <div class="inner">
                        <div class="label-wrapper">
                            <div class="label mb-3">CATEGORY</div>
                            <div class="bulb first active active-full"></div>
                        </div>
                        <div class="label-wrapper">
                            <div class="label mb-3">CALCULATE ENERGY NEEDED FOR YOUR PRODUCT</div>
                            <div class="bulb second active active-full"></div>
                        </div>
                    </div>
                </div>
                <div id="form-step-2">
                    <div class="inner">
                        <form id="EnergyCalculatorForm" name="EnergyCalculatorForm">
                            <div class="form_step" id="energy-calculator">
                                <div class="step-inner">
                                    <div class="card border-0 rounded-0">
                                        <div class="card-body">
                                            <div>
                                            <span class="btn btn-sm py-2 px-0" onclick="goBack()">
                                                <svg width="27" height="29" viewBox="0 0 31 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15.4997 0.876957C6.94514 0.87102 0.00844755 7.8687 0 16.4925C0.00844755 25.131 6.94514 32.1281 15.4997 32.125C24.0574 32.1281 30.9934 25.131 31 16.4925C30.9937 7.8687 24.0574 0.87102 15.4997 0.876957ZM15.4997 28.5243C8.9178 28.5243 3.58082 23.1418 3.58645 16.4925C3.57988 9.85794 8.9178 4.4736 15.4997 4.47704C22.0847 4.47391 27.4223 9.85826 27.4298 16.4925C27.4223 23.1418 22.0847 28.5243 15.4997 28.5243Z" fill="#EA4B4B" />
                                                    <path d="M22.3924 12.5845L19.421 9.61719L15.4998 13.5338L11.5783 9.61719L8.60693 12.5845L12.5297 16.5033L8.60693 20.4177L11.5783 23.3851L15.4998 19.4684L19.421 23.3851L22.3924 20.4177L18.4709 16.5033L22.3924 12.5845Z" fill="#EA4B4B" />
                                                </svg>
                                            </span>
                                            </div>
                                            <div id="result-screen">
                                                <table class="table table-borderless">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="col-left"></th>
                                                        <th scope="col" class="col-right"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row"><div class="load-value"><span id="loadValue">0</span> KW</div></th>
                                                        <td>LOAD</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"><div class="energy-value"><span id="energyValue">0</span> KWh</div></th>
                                                        <td>ENERGY</td>
                                                    </tr>
                                                    <tr><td colspan="2" class="text-center py-3">Below is an estimate of the requirements for the electrical load system</td></tr>
                                                    </tbody>
                                                </table>
                                                <table class="table table-borderless">
                                                    <tbody class="energy_details"></tbody>
                                                </table>
                                            </div>
                                            <p class="text-center mb-0">
                                            <button type="reset" class="btn rounded-0 uppercase dark-link" id="resetBtn">
                                                <svg width="15" height="16" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0)">
                                                        <path d="M11.9371 0.458984H6.54148C3.75127 0.458984 1.45996 2.71817 1.45996 5.51V9.91817C1.45996 10.3222 1.79257 10.6529 2.19909 10.6529C2.60561 10.6529 2.93822 10.3222 2.93822 9.91817V5.51C2.93822 3.5447 4.54583 1.94674 6.52301 1.94674H11.9002C13.9143 1.94674 15.5219 3.5447 15.5219 5.51V9.36715C15.5219 11.3325 13.9143 12.9304 11.9371 12.9304H5.26648L7.50235 10.708C7.798 10.4141 7.798 9.9549 7.50235 9.66102C7.2067 9.36715 6.74474 9.36715 6.44909 9.66102L2.93822 13.1508C2.64257 13.4447 2.64257 13.9039 2.93822 14.1978L6.44909 17.6876C6.59692 17.8345 6.7817 17.908 6.98496 17.908C7.16974 17.908 7.373 17.8345 7.52083 17.6876C7.81648 17.3937 7.81648 16.9345 7.52083 16.6406L5.26648 14.4182H11.9371C14.7458 14.4182 17.0187 12.159 17.0187 9.36715V5.51C17.0187 2.71817 14.7274 0.458984 11.9371 0.458984Z" fill="#414143" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0"><rect width="17" height="18" fill="white" /></clipPath>
                                                    </defs>
                                                </svg> Reset calculator
                                            </button>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card rounded-0 table-form-wrapper">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-form">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" id="action">#</th>
                                                        <th scope="col" id="qty-head">Quantity</th>
                                                        <th scope="col" id="appliance-head">Appliance</th>
                                                        <th scope="col" id="wattage-head">Wattage</th>
                                                        <th scope="col" id="hours-head">Hours</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="listing-more">
                                                        <tr>
                                                            <th scope="row"></th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control quantity_input" name="quantity[1]" id="quantity_1" title="Total number of devices" min="1">
                                                                    <input type="hidden" class="count-appliances" value="2">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="select-drop-wrapper">
                                                                        <select name="appliance[1]" id="appliance_1" class="w-100 appliance_input">
                                                                            <option value="" selected>Select an Appliance</option>
                                                                            <option value="Laptop">Laptop</option>
                                                                            <option value="Refrigerator">Refrigerator</option>
                                                                            <option value="Ceiling fan">Ceiling fan</option>
                                                                            <option value="Table fan">Table fan</option>
                                                                            <option value="Microwave">Microwave</option>
                                                                            <option value="Others">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control wattage_input" name="wattage[1]" id="wattage_1" title="Appliance needed Power(Watt)" min="0">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control hours_input" name="hours[1]" id="hours_1" title="Enter the number of hours the appliance operates in a day (in 24 hours)" min="1">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row"></th>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control quantity_input" name="quantity[2]" id="quantity_2" title="Total number of devices" min="1">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <div class="select-drop-wrapper">
                                                                        <select name="appliance[2]" id="appliance_2" class="w-100 appliance_input">
                                                                            <option value="" selected>Select an Appliance</option>
                                                                            <option value="Laptop">Laptop</option>
                                                                            <option value="Refrigerator">Refrigerator</option>
                                                                            <option value="Ceiling fan">Ceiling fan</option>
                                                                            <option value="Table fan">Table fan</option>
                                                                            <option value="Microwave">Microwave</option>
                                                                            <option value="Others">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control wattage_input" name="wattage[2]" id="wattage_2" title="Appliance needed Power(Watt)" min="0">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="form-control hours_input" name="hours[2]" id="hours_2" title="Enter the number of hours the appliance operates in a day (in 24 hours)" min="1">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="step-2-action-btn pt-0 px-4 pb-3" style="display: flex;justify-content: center;">
                                        <button type="button" class="btn my-1 btn-lg rounded-0 btn-white add-appliances">ADD ANOTHER APPLIANCE</button>
                                    </div>
                                    <div class="card rounded-0 step-footer">
                                        <div class="card-body">
                                            <div class="form-row" style="padding: 0 12px">
                                                <?php  if ($_POST['installation-choice']=='off-grid') { ?>
                                                <div class="form-group col-md-4">
                                                    <div class="select-drop-wrapper">
                                                        <input type="hidden" name="installation_type" value="<?=$_POST['installation-choice'];?>">
                                                        <select name="panel_type" id="panel_type" class="w-100">
                                                            <option value="" selected>Select Solar Panel Type</option>
                                                            <option value="350">350 Watt</option>
                                                            <option value="400">400 Watt</option>
                                                            <option value="450">450 Watt</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <?php } else { ?>
                                                    <div class="form-group col-md-4">
                                                        <input type="hidden" name="installation_type" value="<?=$_POST['installation-choice'];?>">
                                                        <div class="select-drop-wrapper">
                                                            <select name="backup_hrs" id="backup_hrs" class="w-100" title="Maximum backup hours">
                                                                <option value="" selected>Maximum Backup Hours</option>
                                                                <option value="1">1 hr</option>
                                                                <option value="2">2 hrs</option>
                                                                <option value="3">3 hrs</option>
                                                                <option value="4">4 hrs</option>
                                                                <option value="5">5 hrs</option>
                                                                <option value="6">6 hrs</option>
                                                                <option value="7">7 hrs</option>
                                                                <option value="8">8 hrs</option>
                                                                <option value="9">9 hrs</option>
                                                                <option value="10">10 hrs</option>
                                                                <option value="11">11 hrs</option>
                                                                <option value="12">12 hrs</option>
                                                                <option value="13">13 hrs</option>
                                                                <option value="14">14 hrs</option>
                                                                <option value="15">15 hrs</option>
                                                                <option value="16">16 hrs</option>
                                                                <option value="17">17 hrs</option>
                                                                <option value="18">18 hrs</option>
                                                                <option value="19">19 hrs</option>
                                                                <option value="20">20 hrs</option>
                                                                <option value="21">21 hrs</option>
                                                                <option value="22">22 hrs</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group col-md-8">
                                                    <div class="select-drop-wrapper">
                                                        <select name="battery_type" id="battery_type" class="w-100">
                                                            <option value="" selected>Select Battery Type</option>
                                                            <?php
                                                            $url = CONTROLLER_ROOT_URL."/v6/read-products-by-category.php?category=4908";
                                                            $object = $api->curlQueryGet($url);
                                                            if ($object->status == 200){
                                                            foreach ($object->productCategory as $cat) {
                                                            ?>
                                                            <option value="<?=$cat->batt_type;?>" data-battery_volt="<?=$cat->batt_volts;?>"><?=$cat->pro_title;?></option>
                                                            <?php } } ?>
                                                        </select>
                                                        <input type="hidden" name="battery_volt" id="battery_volt" value="12">
                                                    </div>
                                                </div>
<!--                                                <div class="form-group col-md-4">-->
<!--                                                    <div class="select-drop-wrapper">-->
<!--                                                        <select name="battery_volt" id="battery_volt" class="w-100">-->
<!--                                                            <option value="" selected>Select Battery Volt</option>-->
<!--                                                            <option value="12">12V</option>-->
<!--                                                            <option value="24">24V</option>-->
<!--                                                            <option value="48">48V</option>-->
<!--                                                        </select>-->
<!--                                                    </div>-->
<!--                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card rounded-0 step-footer">
                                        <div class="card-body">
                                            <div class="step-2-action-btn" style="display: flex;justify-content: center;">
                                                <button type="submit" class="btn my-1 btn-lg px-5 rounded-0 calc-btn" id="energyCalcBtn">CALCULATE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php } else { header("Location: system-questionnaire-step-one");} ?>
<?php include_once("inc/footer.nav.php"); ?>
<script>
    $(document).ready(function () {
        $("#load-system-questionnaire-page").on('click', '.add-appliances', function () {
        var count = $('.count-appliances').val();
        ++count;
		$('.count-appliances').val(count);
        $('.listing-more').append("" +
            "<tr id='dynamic_field"+count+"'><th scope='row'><button class='btn btn-sm text-danger p-0 btn_remove' id='"+count+"' type='button'>"+
            "<i class='fas fa-trash'></i></button></th><td><div class='form-group'>"+
            "<input type='number' class='form-control quantity_input' name='quantity["+count+"]' id='quantity_"+count+"' title='Total number of devices' min='1'>"+
            "</div></td><td><div class='form-group'><div class='select-drop-wrapper'>"+
            "<select name='appliance["+count+"]' id='appliance_"+count+"' class='w-100 appliance_input'>"+
            "<option value='' selected>Select an Appliance</option><option value='Laptop'>Laptop</option>"+
            "<option value='Refrigerator'>Refrigerator</option><option value='Ceiling fan'>Ceiling fan</option>"+
            "<option value='Table fan'>Table fan</option><option value='Microwave'>Microwave</option>"+
            "<option value='Others'>Others</option></select>"+
            "</div></div></td><td><div class='form-group'>"+
            "<input type='number' class='form-control wattage_input' name='wattage["+count+"]' id='wattage_"+count+"' title='Appliance needed Power(Watt)' min='0'>"+
            "</div></td><td><div class='form-group'>"+
            "<input type='number' class='form-control hours_input' name='hours["+count+"]' id='hours_"+count+"' title='Enter the number of hours the appliance operates in a day (in 24 hours)' min='1'></div></td></tr>");
        });

        $("#load-system-questionnaire-page").on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            var count = $('.count-appliances').val();
            count=count-1;
            $('.count-appliances').val(count);
            $('#dynamic_field'+button_id+'').remove();
        });

        $('form#EnergyCalculatorForm').on('submit', function () {
            $('.quantity_input').each(function () {
                $(this).rules("add",{required:true, messages:{required: "qty required",digits:"Invalid input"}});
            });

            $('.appliance_input').each(function () {
                $(this).rules("add",{required:true, messages:{required: ""}});
            });

            $('.wattage_input').each(function () {
                $(this).rules("add",{required:true,digits:true, messages:{required: "power required",digits:"Invalid input"}});
            });

            $('.hours_input').each(function () {
                $(this).rules("add",{required:true,digits:true, messages:{required: "hrs required",digits:"Invalid input"}});
            });
        });

        $("#EnergyCalculatorForm").validate({
            ignore:"",
            submitHandler: function(form, e) {
                e.preventDefault();
                let EnergyCalculatorForm = $('#EnergyCalculatorForm');
                let energyCalcBtn = $('#energyCalcBtn');

                energyCalcBtn.attr("disabled", true);energyCalcBtn.css("cursor", 'not-allowed');energyCalcBtn.html("<i class='fa fa-spinner fa-pulse'></i>");
                $.ajax({
                    url: "controllers/v6/calculate-solar-accessories", type: "POST", data: EnergyCalculatorForm.serialize(),
                    success: function (data) {
                        $("#loadValue").html(data.total_power);
                        $("#energyValue").html(data.total_energy);

                        if (data.status ==='offGrid'){
                            $('.energy_details').html('' +
                                '<tr class="pressure-info text-center"><th colspan="2" class="p-0">o &nbsp;'+data.solar_panel+' Solar panels needed</th></tr>'+
                                '<tr class="pressure-info text-center"><th colspan="2" class="p-0">o &nbsp;'+data.inverter+' Inverter needed</th></tr>'+
                                '<tr class="pressure-info text-center"><th colspan="2" class="p-0">o &nbsp;'+data.battery+' Batteries needed</th></tr>'+
                                '<tr class="pressure-info text-center"><th colspan="2" class="p-0">o &nbsp;'+data.charge_controller+' Charge controller needed</th></tr>'+
                            '');
                        } else {
                            $('.energy_details').html('' +
                                '<tr class="pressure-info text-center"><th colspan="2" class="p-0">o &nbsp;'+data.inverter+' Inverter needed</th></tr>'+
                                '<tr class="pressure-info text-center"><th colspan="2" class="p-0">o &nbsp;'+data.battery+' Batteries needed for 12v inverter</th></tr>'+
                            '');
                        }
                    },
                    error: function (errData) {},
                    complete: function () {
                        energyCalcBtn.attr("disabled", false);energyCalcBtn.css("cursor", 'pointer');energyCalcBtn.html("CALCULATE");
                    }
                });
            }
        });

        $("#load-system-questionnaire-page").on('click','#resetBtn', (e)=> {
            $("#loadValue").html("0");
            $("#energyValue").html("0");
            $('.energy_details').html('');
        });
    });
</script>
<script>
    $("#battery_type").on('change', function () {
        var battery_volt = $(this).find(':selected').data('battery_volt');
        $("#battery_volt").val(battery_volt);
    });
</script>