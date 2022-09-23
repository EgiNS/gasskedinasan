<?php

function client_key()
{
    $midtrans = load_midtrans(['is_active' => 1]);

    $client_key = $midtrans['client_key'];
    return $client_key;
}

function server_key()
{
    $midtrans = load_midtrans(['is_active' => 1]);

    $server_key = $midtrans['server_key'];
    return $server_key;
}

function javascript_snap_url()
{
    $midtrans = load_midtrans(['is_active' => 1]);

    $url = $midtrans['javascript_snap_url'];
    return $url;
}

function is_production()
{
    $midtrans = load_midtrans(['environment' => 'production']);

    if ($midtrans['is_active'] == 1)
        $production = true;
    else if ($midtrans['is_active'] == 0)
        $production = false;

    return $production;
}

function load_midtrans($where)
{
    $ci = get_instance();
    $ci->load->model('Midtrans_settings_model', 'midtrans_settings');
    return $ci->midtrans_settings->get('one', $where);
}