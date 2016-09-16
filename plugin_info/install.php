<?php
require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';

function openCv_install() {
	$Source = dirname(__FILE__) . '/../ressources/Plate';
    $Destination=dirname(__FILE__) . '/../../../../Video/';
    if(!file_exists($Destination))
      mkdir($Destination,0777);
    $Destination.='openCv';
    if(!file_exists($Destination))
      mkdir($Destination,0777);
	if(file_exists($Source)){
		exec('sudo mv '.$Source.'/* '.$Destination);
		exec('sudo rm -R '.$Source);
	}
}

function openCv_update() {
	$Source = dirname(__FILE__) . '/../ressources/Plate';
    $Destination=dirname(__FILE__) . '/../../../../Video/';
    if(!file_exists($Destination))
      mkdir($Destination,0777);
    $Destination.='openCv';
    if(!file_exists($Destination))
      mkdir($Destination,0777);
	if(file_exists($Source)){
		exec('sudo mv '.$Source.'/* '.$Destination);
		exec('sudo rm -R '.$Source);
	}
}
function openCv_remove() {
}

?>