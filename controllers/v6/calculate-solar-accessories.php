<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

$number = count($_POST["appliance"]);
$inst_type = $_POST["installation_type"];
if ($inst_type =="off-grid"){
$panel_type = $_POST["panel_type"];
} else {
$max_backup_hrs = $_POST["backup_hrs"];
}
$batt_type = $_POST["battery_type"];
$batt_volt = $_POST["battery_volt"];

$tot_load=0;
$tot_energy=0;

if ($number > 0) {
    $error=0;

    for ($i = 1; $i <= $number; $i++) {
        if ($_POST["quantity"][$i] == '' || $_POST["appliance"][$i] == '' || $_POST["wattage"][$i] == '' || $_POST["hours"][$i] == '') {
            $error = $error + 1;
        } else {
            $tot_load = $tot_load + ($_POST["quantity"][$i] * $_POST["wattage"][$i]);
            $tot_energy = $tot_energy + ($_POST["quantity"][$i] * $_POST["wattage"][$i] * $_POST["hours"][$i]);
        }
    }

    if ($inst_type == "off-grid") {
        $solar_panel = ceil((1.5*$tot_load)/$panel_type);
        $batt = (($tot_energy/($batt_volt*$batt_type*0.6)));

        $inv = ($tot_load/0.8);
        if ($inv>0 && $inv<=1000) {
            $inv_volts = 12;
        } elseif ($inv>1000 && $inv <5000){
            $inv_volts = 24;
        } elseif ($inv > 5000) {
            $inv_volts = 48;
        }
        $batt_mul = $inv_volts/$batt_volt;
        if ($batt_mul == 1){
            $battery = round($batt);
        } else if ($batt_mul == 2) {
            $batt_div = $batt/2;
            $num = floor($batt_div);
            $num_dec = $batt_div - $num;
            if ($num_dec < 0.5){
                $battery = $num*2;
            } else {
                $battery = ($num +1)*2;
            }
        } else if ($batt_mul == 4){
            $batt_div = $batt/4;
            $num = floor($batt_div);
            $num_dec = $batt_div - $num;
            if ($num_dec < 0.5){
                $battery = $num*4;
            } else {
                $battery = ($num +1)*4;
            }
        }

        $ch_controller = ceil(1.5 * $tot_load);

        if ($error == 0) {
            http_response_code(200);
            echo json_encode(array(
                "status" => 'offGrid',
                "total_power" => ($tot_load/1000),
                "total_energy" => ($tot_energy/1000),
                "solar_panel" => $solar_panel,
                "battery" => $battery,
                "inverter" => ceil($inv/1000)."KW",
                "charge_controller"=>$ch_controller."W"
            ));
        } else {
            http_response_code(400);
            echo json_encode(array("status" => 0, "message" => 'Enter at least one product'));
        }
    } else {
        $batt = ceil(($tot_load*$max_backup_hrs)/($batt_volt*$batt_type*0.6));
        $inv = ($tot_load/0.8);
        if ($inv>0 && $inv<=1000) {
            $inv_volts = 12;
        } elseif ($inv>1000 && $inv <5000){
            $inv_volts = 24;
        } elseif ($inv > 5000) {
            $inv_volts = 48;
        }
        $batt_mul = $inv_volts/$batt_volt;
        if ($batt_mul == 1){
            $battery = $batt;
        } else {
            $battery = (round($batt) % $batt_mul === 0) ? round($batt) : round(($batt + $batt_mul / 2) / $batt_mul) * $batt_mul;
        }

        if ($error == 0) {
            http_response_code(200);
            echo json_encode(array(
                "status" => 'ups',
                "total_power" => ($tot_load/1000),
                "total_energy" => ($tot_energy/1000),
                "battery" => $batt,
                "inverter" => ceil($inv/1000)."KW"
            ));
        } else {
            http_response_code(400);
            echo json_encode(array("status" => 0, "message" => 'Enter at least one product'));
        }
    }
} else {
    http_response_code(400);
    echo json_encode(array("status"=>0,"message"=>"No data found"));
}

?>
