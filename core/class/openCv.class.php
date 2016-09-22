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
		$br = (php_sapi_name() == "cli")? "":"<br>";
		if(!extension_loaded('opencv')) {
			dl('opencv.' . PHP_SHLIB_SUFFIX);
		}
		$function = 'confirm_' . $module . '_compiled';
		if (extension_loaded($module)) 
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
	use OpenCV\Capture as Capture;
	use OpenCV\Image as Image;
	use OpenCV\Histogram as Histogram;
	public function execute($_options = array()) {
		switch($this->getLogicalId()){
			case "JpegCapture":
				/* Test the face detectoin feature, using a capture from the camera */
				$capture = Capture::createCameraCapture(0);
				$image = $capture->queryFrame();
				$result = $image->haarDetectObjects("/usr/share/opencv/haarcascades/haarcascade_frontalface_default.xml");
				foreach ($result as $r) {
					$image->rectangle($r['x'], $r['y'], $r['width'], $r['height']);
				}
				//$image = $image->convertColor(7);
				$image->save('/tmp/camera.jpg');
			
			break;
			case "MovieCapture":
				$capture = OpenCV\Capture::createFileCapture('movie.avi');
				$image = $capture->queryFrame();
				$result = $image->haarDetectObjects("data/haarcascades/haarcascade_frontalface_default.xml");
				foreach ($result as $r) {
					$image->rectangle($r['x'], $r['y'], $r['width'], $r['height']);
				}
				$image->save('/tmp/video.jpg');
			break;
			case "edgeDetect":
				$i = Image::load("test.jpg", Image::LOAD_IMAGE_COLOR);
				$dst = $i->sobel(1, 0, 1);
				$dst->save("test_sobel.jpg");
				$dst2 = $i->canny(10, 50, 3);
				$dst2->save("test_canny.jpg");
			break;
		}
}
?>
