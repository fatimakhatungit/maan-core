<?php
function maan_envato_api() {
    $envato_item_id = get_download_meta( 'item_unique_id');
    $personal_token = maan_options('envato_api');
//set header for API
    $personal_token   = 'Bearer ' .$personal_token;
    $api_header   = array();
    $api_header[] = 'Content-length: 0';
    $api_header[] = 'Content-type: application/json; ch_themearset=utf-8';
    $api_header[] = 'Authorization: ' . $personal_token;
    $item_id = $envato_item_id;
    $api_url = 'https://api.envato.com/v3/market/catalog/item?id='.$item_id;

//START GET DATA FROM API
    $api_init_item = curl_init();

    curl_setopt($api_init_item, CURLOPT_URL, $api_url );
    curl_setopt( $api_init_item, CURLOPT_HTTPHEADER, $api_header );
    curl_setopt( $api_init_item, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt($api_init_item, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt( $api_init_item, CURLOPT_CONNECTTIMEOUT, 5 );
    curl_setopt( $api_init_item, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    $api_item_results = curl_exec($api_init_item);
    return $api_item_results;
}

function maan_envato_total_sales(){

    $personal_token= maan_options('envato_api');

//set header for API
    $personal_token   = 'Bearer ' .$personal_token;
    $api_header   = array();
    $api_header[] = 'Content-length: 0';
    $api_header[] = 'Content-type: application/json; ch_themearset=utf-8';
    $api_header[] = 'Authorization: ' . $personal_token;

    $envato_username = maan_options('envato_username');
    $api_url = 'https://api.envato.com/v1/market/user:'.$envato_username.'.json';

//START GET DATA FROM API
    $api_init_item = curl_init();

    curl_setopt($api_init_item, CURLOPT_URL, $api_url );
    curl_setopt( $api_init_item, CURLOPT_HTTPHEADER, $api_header );
    curl_setopt( $api_init_item, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt($api_init_item, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt( $api_init_item, CURLOPT_CONNECTTIMEOUT, 5 );
    curl_setopt( $api_init_item, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

    $api_item_results = curl_exec($api_init_item);
    $api_item_results = json_decode($api_item_results, true);

    $total_sale = $api_item_results['user'];
    $total_sale[] = $total_sale;
    return $total_sale['sales'];
}