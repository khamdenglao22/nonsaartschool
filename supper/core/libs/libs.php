<?php

function checkId($id)
{
    $tmp = '';
    if (strlen($id) == 1) {
        $tmp .= '0000' . $id;
    } else if (strlen($id) == 2) {
        $tmp .= '000' . $id;
    } else if (strlen($id) == 3) {
        $tmp .= '00' . $id;
    } else if (strlen($id) == 4) {
        $tmp .= '0' . $id;
    } else if (strlen($id) == 5) {
        $tmp .= $id;
    }
    return $tmp;
}

function checkOdId()
{
    $db = new Database();
    $db->query("SELECT MAX(tracking_number) as mx FROM tb_shipment");
    $db->execute();
    $result = $db->single();
    return $result['mx'];
}

function generateTrackingNumber($agentCode)
{
    $id = $agentCode . '-';
    $check = checkOdId();
    if (!empty($check)) {
        $temp_id = checkOdId();
        $temp = explode("-", $temp_id);
        if (!empty($temp[1])) {
            $tmp = (int)$temp[1];
            $tmp = $tmp + 1;
            $id .= checkId($tmp);
        } else {
            $id .= '00001';
        }
    } else {
        $id .= '00001';
    }
    return $id;
}

function genToken() {
    //Generate a random string.
    $token = openssl_random_pseudo_bytes(16);

    //Convert the binary data into hexadecimal representation.
    return bin2hex($token);
}

function genUsername($length = 8)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $username = substr(str_shuffle($chars), 0, $length);
    return $username;
}

function genPassword($length = 8)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $username = substr(str_shuffle($chars), 0, $length);
    return $username;
}

// ------------ CHECK IF LOGGED IN ----------------------
function isLoggedIn()
{
    return !!isset($_SESSION['loggedIn']);
}

// ------------ VALIDATE INPUT EMAIL ----------------------
function validateEmail($email)
{
    return (!filter_var($email, FILTER_VALIDATE_EMAIL)) ? "INVALID" : "";
}

// ------------ FORMAT CURRENCY ----------------------
function formatMoney($number, $fractional = false)
{
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

// ------------ GET PROVINCE ----------------------
function getProvince()
{
    $core = new Core();
    return $core->getAll("id, name, name_lao", "tb_province ORDER BY id ASC", "");
}

// ------------ GET SINGLE PROVINCE ----------------------
function getProvinceById($id)
{
    $core = new Core();
    return $core->getAll("id, name, name_lao", "tb_province", "id = " . $id . "");
}

// ------------ GET DISTRICT ----------------------
function getDistrict()
{
    $core = new Core();
    return $core->getAll("id, name, name_lao", "tb_district ORDER BY id ASC", "");
}

// ------------ GET SINGLE DISTRICT ----------------------
function getDistrictById($id)
{
    $core = new Core();
    return $core->getAll("id, name, name_lao", "tb_district", "id = " . $id . "");
}

// ------------ GET DISTRICT BY PROVINCE ----------------------
function getDistrictByProvince($province_id)
{
    $core = new Core();
    return $core->getAll("id, name, name_lao", "tb_district", "province_id = " . $province_id . "  ORDER BY id ASC");
}

// ------------ GET COUNTRY ----------------------
function getCountry()
{
    $core = new Core();
    return $core->getAll("id, iso, name, nicename, phonecode", "tb_country ORDER BY name ASC", "");
}

function getSenderCountry()
{
    $core = new Core();
    return $core->getAll("id, iso, name, nicename, phonecode", "tb_country", "`iso` IN ('LA', 'TH') ORDER BY name ASC");
}

// ------------ GET Payment Type ----------------------
function getPaymentType()
{
    $core = new Core();
    return $core->getAll("id, name", "tb_payment_type ORDER BY name ASC", "");
}

// ------------ GET Shipment Type ----------------------
function getShipmentType()
{
    $core = new Core();
    return $core->getAll("id, name, source, destination", "tb_shipment_type ORDER BY name ASC", "");
}

// ------------ GET TYPE ----------------------
function getShipmentTypeByType($type)
{
    $core = new Core();
    return $core->getAll("id, name, source, destination", "tb_shipment_type", "name = '" . $type . "'  ORDER BY name ASC");
}

function getShipmentTypeName($source, $destination)
{
    if ($source == 'province') {
        return 'ລະຫວ່າງແຂວງ';
    } else if ($source == 'district') {
        return 'ພາຍໃນແຂວງ';
    } else {
        return $source . ' - ' . $destination;
    }
}

function getBranch()
{
    $core = new Core();
    return $core->getAll("*", "tb_branch ORDER BY name ASC", "");
}

function getBranchById($id)
{
    $core = new Core();
    return $core->getSingle("*", "tb_branch", "id = $id ORDER BY name ASC");
}

function getAgent()
{
    $core = new Core();
    return $core->getAll("*", "tb_agent ORDER BY agent_code ASC", "");
}

function getAgentById($id)
{
    $core = new Core();
    return $core->getSingle("*", "tb_agent", "id = $id ORDER BY agent_code ASC");
}

function getCustomer()
{
    $core = new Core();
    return $core->getAll("*", "tb_customer ORDER BY id ASC", "");
}

function getCustomerById($id)
{
    $core = new Core();
    return $core->getSingle("*", "tb_customer", "id = $id ORDER BY id ASC");
}

function getCurrency()
{
    $core = new Core();
    return $core->getAll("*", "tb_currency ORDER BY id ASC", "");
}

function getShipmentPrice($weight, $mode, $type)
{
    if ($type == 'box') {
        return 250;
    } else if ($type == 'piece') {
        if ($mode == 'global') {
            return 150;
        } else {
            return 200;
        }
    } else {
        return 100;
    }
}

function ViewFormatDate($date){
    return  date("d/m/Y", strtotime($date));
}

function getWeight($weight, $volume) {
    if ($volume > $weight)
        return $volume;
    return $weight;
}

function getCurrencyNameById($id)
{
    $db = new Database();
    $db->query("SELECT name FROM tb_currency WHERE id = :id");
    $db->bind("id", $id);
    $db->execute();
    list($name) = $db->columns();
    return $name;
}

function genRandomString()
{
    $length = 5;
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ";

    $real_string_length = strlen($characters) ;
    $string="id";

    for ($p = 0; $p < $length; $p++)
    {
        $string .= $characters[mt_rand(0, $real_string_length-1)];
    }

    return strtolower($string);
}
