<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function formatBytes($bytes, $decimal = null){
	$satuan = ["bytes", 'kb', 'mb', 'gb', 'tb'];
	$i = 0;

	while($bytes > 1024){
		$bytes /= 1024;
		$i++;
	}

	return round($bytes, $decimal)." ".$satuan[$i];

}
function connect(){
	$api = new RouterosAPI();
	$api->connect('id-25.hostddns.us:2645', 'userapp', 'testapp');

	if(count($api->comm('/ppp/secret/print')) == 0){
		echo json_encode("Connection Failed");exit;
	}

	return $api;
}