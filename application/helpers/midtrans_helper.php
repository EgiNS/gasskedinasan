<?php

function client_key()
{

    $client_key = getenv('CLIENT_KEY') ?: $_ENV['CLIENT_KEY'];

    return $client_key;
}

function server_key()
{

    $server_key = getenv('SERVER_KEY') ?: $_ENV['SERVER_KEY'];
        return $server_key;
}

function javascript_snap_url()
{
    // $midtrans = load_midtrans(['is_active' => 1]);

  // $url = $midtrans['javascript_snap_url'];
    // return $url;
}

function is_production()
{
    $environment = getenv('ENVIRONMENT') ?: $_ENV['ENVIRONMENT'];
    if ($environment == 'production')
       return true;
   return false;
}