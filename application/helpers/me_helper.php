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
    function cmb_where($name, $table, $field, $pk, $selected = null, $where = null, $order = null)
    {
        $ci = get_instance();
        $cmb = "<select name='$name' class='form-control filter select2' ids='" . $pk . "'>";
        if ($order) {
            $ci->db->order_by($field, $order);
        }
        $data = $ci->db->get_where($table, array($where => 1))->result();
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
if (!function_exists('cmb_dinamis')) {
    function cmb_dinamis($name, $table, $field, $pk, $selected = null, $order = null)
    {
        $ci = get_instance();
        $cmb = '<select class="form-control filter select2" id="' . $pk . '" name="' . $name . '" style="width: 100%;">';
        if ($order) {
            $ci->db->order_by($field, $order);
        }
        $data = $ci->db->get($table)->result();

        foreach ($data as $d) {
            $cmb .= "\n<option value='" . $d->$pk . "'";
            $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
            $cmb .= ">" .  strtoupper($d->$field) . "</option>";
        }
        $cmb .= "\n</select>\n";
        return $cmb;
    }
}
if (!function_exists('cmb_filter')) {
    function cmb_filter($default, $name, $table, $field, $pk, $selected = null, $order = null)
    {
        $ci = get_instance();
        $cmb = "<select name='" . $name . "' class='form-control filter select2' id='" . $pk . "' style='width: 100%;'>";
        if ($order) {
            $ci->db->order_by($field, $order);
        }
        $data = $ci->db->get($table)->result();
        $cmb .= "<option value='" . $default . "' selected='selected'>" . $default . "</option>";

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

if (!function_exists('token_')) {
    function token_($timestamp, $variable1, $variable2)
    {
        $CI = &get_instance();
        $CI->load->library('encryption');

        // Dapatkan timestamp sekarang
        // $timestamp = time();

        // Gabungkan timestamp dan dua variable dengan karakter titik
        $string_to_encrypt = $timestamp . '.' . $variable1 . '.' . $variable2;

        // Enkripsi string
        $encrypted_string = $CI->encryption->encrypt($string_to_encrypt);

        return $encrypted_string;
    }
}

if (!function_exists('sessionsDb')) {
    function sessionsDb($table_name, $data_array)
    {
        $CI = &get_instance();
        $CI->load->database();

        // Pastikan $data_array adalah array yang tidak kosong
        if (!empty($data_array) && is_array($data_array)) {
            // Masukkan data ke dalam tabel
            $CI->db->insert($table_name, $data_array);

            // Periksa apakah operasi penyisipan berhasil
            if ($CI->db->affected_rows() > 0) {
                return true; // Sukses
            } else {
                return false; // Gagal
            }
        } else {
            return false; // Data tidak valid
        }
    }
}
