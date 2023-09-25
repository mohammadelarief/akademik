<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('_unix_id')) {
    function _unix_id($input_string)
    {
        // Menggabungkan input string dengan Unix Timestamp
        $timestamp = time();
        $result_string = $input_string . $timestamp;

        // Membuat karakter acak
        $random_chars = '';
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 4;
        for ($i = 0; $i < $length; $i++) {
            $random_chars .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Menggabungkan hasil dengan karakter acak
        $result_string .= $random_chars;

        return $result_string;
    }
}
if (!function_exists('cmb_periode')) {
    function cmb_periode($name, $table, $field, $pk, $selected = null, $order = null)
    {
        $ci = get_instance();
        $cmb = "<select name='$name' class='form-control filter select2' ids='" . $pk . "'>";
        if ($order) {
            $ci->db->order_by($field, $order);
        }
        $data = $ci->db->get_where($table, array('aktif' => 1))->result();
        // $data = $ci->db->get($table)->result();

        foreach ($data as $d) {
            $cmb .= "<option value='" . $d->$pk . "'";
            $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
            $cmb .= ">" .  strtoupper($d->$field) . "</option>";
        }
        $cmb .= "</select>";
        return $cmb;
    }
}
if (!function_exists('idperson_')) {
    function idperson_()
    {
        $CI = &get_instance();
        $CI->load->database();

        $tAwal = $CI->db->query("SELECT DATE_FORMAT(tglmulai,'%y') as tahun FROM tbl_periode WHERE aktif='1'")->row()->tahun;
        $akhiId_ = $tAwal + 1;
        $akhiId = $akhiId_ . '0000';
        $awalId = $tAwal . '0000';
        // $awalId = $tAwal . '5000';

        $result = $CI->db->query("SELECT ifnull(MAX(CONVERT(idperson, SIGNED INTEGER))," . $awalId . ")+1 as idbaru FROM tbl_person WHERE idperson BETWEEN " . $awalId . " AND " . $akhiId);

        $rows2     = $result->row()->idbaru;
        $idperson = '';
        if (empty($rows2)) {
            $idperson = $awalId;
        } else {
            $idperson = $rows2;
        }

        return $idperson;
    }
}
