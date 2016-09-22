<?php
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
class openCv extends eqLogic {
	public static function deamonRunning() {
		$result = exec("ps aux | grep opencv | grep -v grep | awk '{print $2}'");
		if($result != ""){
			return $result;
		}
        return false;
    	}
	public static function addEquipement($Name,$_logicalId) 	{
		$Equipement = self::byLogicalId($_logicalId, 'openCv');
		if (is_object($Equipement)) {
			$Equipement->setIsEnable(1);
			$Equipement->save();
		} else {
			$Equipement = new openCv();
			$Equipement->setName($Name);
			$Equipement->setLogicalId($_logicalId);
			$Equipement->setObject_id(null);
			$Equipement->setEqType_name('openCv');
			$Equipement->setIsEnable(1);
			$Equipement->setIsVisible(0);
			$Equipement->save();
		}
		return $Equipement;
	}
	public static function addCommande($eqLogic,$Name,$_logicalId, $subtype='binary') {
		$Commande = $eqLogic->getCmd(null,$_logicalId);
		if (!is_object($Commande))
		{
			$Commande = new openCvCmd();
			$Commande->setId(null);
			$Commande->setName($Name);
			$Commande->setLogicalId($_logicalId);
			$Commande->setEqLogic_id($eqLogic->getId());
			$Commande->setType('info');
			$Commande->setSubType($subtype);
			$Commande->setIsHistorized(1);
		}
		if($_logicalId =='*' || $_logicalId == 'lastdetect')
			$Commande->setIsVisible(0);
		$Commande->setTemplate('dashboard','PresenceGarage');
		$Commande->setTemplate('mobile','PresenceGarage');
		$Commande->save();
		return $Commande;
	}
	public static function dependancy_info() {
		$return = array();
		$return['log'] = 'openCv_update';
		$return['progress_file'] = '/tmp/compilation_openCv_in_progress';
		if(file_exists('/usr/local/src/openCv/'))
			$return['state'] = 'ok';
		else
			$return['state'] = 'nok';
		return $return;
	}
	public static function dependancy_install() {
		if (file_exists('/tmp/compilation_openCv_in_progress')) {
			return;
		}
		log::remove('openCv_update');
		$cmd = 'sudo /bin/bash ' . dirname(__FILE__) . '/../../ressources/install.sh';
		$cmd .= ' >> ' . log::getPathToLog('openCv_update') . ' 2>&1 &';
		exec($cmd);
	}
	public static function deamon_info() {
		$return = array();
		$return['log'] = 'openCv';	
		$return['state'] = 'ok';
		if(!self::deamonRunning())
			$return['state'] = 'nok';
		$return['launchable'] = 'ok';
		return $return;
	}
	public static function deamon_start($_debug = false) {
		$deamon_info = self::deamon_info();
		if ($deamon_info['launchable'] != 'ok') 
			return;
		log::remove('openCv');
		self::deamon_stop();
	}
	public static function deamon_stop() {
		exec('sudo pkill opencv');
	}
}
class openCvCmd extends cmd {
  
	public function execute($_options = array()) {
}
?>
