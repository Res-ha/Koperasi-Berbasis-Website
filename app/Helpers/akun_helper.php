<?php

function is_logged_in()
{
    $ci = &get_instance();
    if ($ci->session->userdata('username')) {
        redirect('admin');
    }
}

function is_logged_out()
{
    $ci = &get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('akun');
    }
}

function check_admin()
{
    $ci = &get_instance();
    if ($ci->session->userdata('id_role') != 1) {
        redirect('pengunjung');
    }
}

function get_user()
{
    $ci = &get_instance();
    $username = $ci->session->userdata('username');
    $user = $ci->db->get_where('user', ['username' => $username])->row_array();
    return $user;
}
