<?php

require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';
include_file('core', 'authentification', 'php');
if (!isConnect()) {
    include_file('desktop', '404', 'php');
    die();
}
?>
<div class="col-sm-6">
	<form class="form-horizontal">
		<legend>Général</legend>
		<fieldset>
			<div class="form-group">
                <label class="col-lg-4 control-label">{{Commande d'alerte (mail, slack...)}}</label>
                <div class="col-lg-4">
					<div class="input-group">
                        <input type="text" class="configKey" data-l1key="alertMessageCommand" placeholder="{{Commande mail pour l'envoi d'une capture}}"/>
                        <span class="input-group-btn">
                            <a class="btn btn-default listCmdActionMessage" id="bt_selectActionMessage"><i class="fa fa-list-alt"></i></a>
                        </span>
                    </div>
                </div>      
            </div>   
			<div class="form-group">    
				<label class="col-lg-4 control-label">Nombre de captures</label>
                <div class="col-lg-4">
                    <input type="text" class="configKey" data-l1key="NbSnap">
                </div>
            </div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Création automatique de plaque inconnue}}</label>
				<div class="col-lg-4">
					<input type="checkbox" class="configKey bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="inconnue" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Personnalisé les paramettre par defaut de openCv}}</label>
				<div class="col-lg-4">
					<input type="checkbox" class="configKey bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="openParam" />
				 </div>
			</div> 
		</fieldset>
	</form>
</div>
<div class="col-sm-6">
	<form class="form-horizontal">
		<legend>Configuration du demon Alprd</legend>
		<fieldset>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Repertoire Snapshot}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey" data-l1key="SnapshotFolder">
				 </div>
			</div> 
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Activer le Snapshot}}</label>
				<div class="col-lg-4">
					<input type="checkbox" class="configKey bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="snapshot"/>
				 </div>
			</div> 
		</fieldset>
		<legend>Configuration des Camera<a class="btn btn-success btn-xs pull-right cursor" id="bt_AddCamera"><i class="fa fa-check"></i> {{Ajouter}}</a></legend>
		<fieldset>
			<div class="form-group">
				<label>{{Liste des camera}}</label>
				<div class="CameraListe"></div>
			</div> 
		</fieldset>
	</form>
</div>
<div class="col-sm-6 openCvParamters">
	<form class="form-horizontal">
		<fieldset>
			<legend>Configuration de parametre de détéction openCv</legend>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{state_id_img_size_percent}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="state_id_img_size_percent" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{ocr_img_size_percent}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="ocr_img_size_percent" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Calibrage de votre camera améliore la précision de la détection dans les cas où des plaques d'immatriculation sont capturés à un angle raide (Utilisez l'utilitaire openCv-utils-calibration pour calibrer votre camera fixe pour ajuster un angle )}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="prewarp" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{La détection ignorera plaques qui sont trop grands. Ceci est une bonne technique de l'efficacité à utiliser si les plaques vont être à une distance fixe de la caméra (par exemple, vous ne verrez jamais plaques qui remplissent la totalité de l'image}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="max_plate_width_percent" />
					<input type="text" class="configKey "  data-l1key="max_plate_height_percent" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Augmentation détection d'itération est le pourcentage que le cadre de LBP augmente chaque itération. Il doit être supérieur à 1,0. Une valeur de 1,01 signifie augmentation de 1%, 1,10 augmentation de 10% de chaque fois. Ainsi, une augmentation de 1% serait ~ 10x plus lent que 10% à traiter, mais il a une plus grande chance de l'atterrissage directement sur la plaque et d'obtenir une détection forte}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="detection_iteration_increase" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{La force minimale de détection détermine comment assurer l'algorithme de détection doit être avant de signaler qu'une région de la plaque existe. Techniquement, cela correspond à LBP voisins les plus proches (par exemple, combien de détectives sont regroupés autour de la même zone). Par exemple, 2 = très indulgent, 9 = très stricte}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="detection_strictness" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{La détection n'a pas nécessairement besoin d'une image de très haute résolution pour détecter les plaques. En utilisant une image d'entrée plus petit doit encore trouver les plaques et le fera plus rapidement. Peaufiner les valeurs de max_detection_input va redimensionner l'image d'entrée si elle est plus grande que ces tailles (exprimées en pixels}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="max_detection_input_width" />
					<input type="text" class="configKey "  data-l1key="max_detection_input_height" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Technique utilisée pour trouver des régions de plaque d'immatriculation d'une image. La valeur peut être réglée sur}}</label>
				<div class="col-lg-4">
					<select type="text" class="configKey "  data-l1key="detector" >
						<option value="lbpcpu">LBP par défaut utilise le CPU du système</option>
						<option value="lbpgpu">LBP-base utilise Nvidia GPU pour augmenter la vitesse de reconnaissance</option>
						<option value="lbpopencl">LBP-base  utilise OpenCL GPU pour augmenter la vitesse de reconnaissance. Nécessite OpenCV 3.0</option>
						<option value="morphcpu">Expérimental qui détecte rectangles blancs dans une image. Ne nécessite pas de formation.</option>
					</select>
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Les résultats doivent correspondre un textpattern de post-traitement si un modèle est disponible.}}</label>
				<div class="col-lg-4">
					<input type="checkbox" class="configKey bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="must_match_pattern" checked/>
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Contourne la détection de la plaque. Si elle est positionnée à 1, la bibliothèque suppose que chaque zone prévue est une zone de la plaque susceptible.}}</label>
				<div class="col-lg-4">
					<input type="checkbox" class="configKey bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="skip_detection" checked/>
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{openCv peut balayer la même image plusieurs fois avec randomisation différent. Mettre ce paramètre à une valeur plus grande que 1 peut augmenter la précision, mais augmentera le temps de traitement linéaire}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="analysis_count" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{openCv détecte les cultures de plaque à contraste élevé et utilise une technique de détection de bord alternatif. Mettre cette option à 0.0 classerait toutes les images comme contraste élevé, la mise à 1.0 classerait pas d'images comme contraste élevé.}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="contrast_detection_threshold" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{max_plate_angle_degrees}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="max_plate_angle_degrees" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{ocr_min_font_point}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="preocr_min_font_pointwarp" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Minimum de confiance OCR à considérer(%)}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="postprocess_min_confidence" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Tout caractère OCR inférieur à ce parametre sera ignorée.}}</label>
				<div class="col-lg-4">
					<input type="text" class="configKey "  data-l1key="postprocess_confidence_skip_level" />
				 </div>
			</div>
			<div class="form-group">
				<label class="col-lg-4 control-label">{{Mode Débug}}</label>
				<div class="col-lg-4">
					<input type="checkbox" class="configKey bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="debug"/>
				 </div>
			</div>
		</fieldset>
	</form>
</div>

<script>
$.ajax({
	type: "POST",
	timeout:8000, 
	url: "core/ajax/config.ajax.php",
	data: {
		action:'getKey',
		key:'{"configuration":""}',
		plugin:'openCv',
	},
	dataType: 'json',
	error: function(request, status, error) {
		handleAjaxError(request, status, error);
	},
	success: function(data) { 
		if (data.state != 'ok') {
			$('#div_alert').showAlert({message: data.result, level: 'danger'});
			return;
		}
		if (data.result['configuration']!=''){
			$.each(data.result['configuration'], function( key, value ){
				AddCamera($('.CameraListe'),key);	
				$('.configKey[data-l1key=configuration][data-l2key='+key+'][data-l3key=cameraUrl]').val(data.result['configuration'][key]['cameraUrl']);
				});
		}
	}
});	
$("#bt_selectActionMessage").on('click', function () {
    jeedom.cmd.getSelectModal({cmd: {type: 'action',subType : 'message'}}, function (result) {
        $(".configKey[data-l1key=alertMessageCommand]").atCaret('insert',result.human);
    });
});
$('body').on('switchChange.bootstrapSwitch change','.configKey[data-l1key=snapshot]',function(){
	if($(this).is(':checked')){
		$(".configKey[data-l1key=alertMessageCommand]").parent().parent().parent().show();    
		$(".configKey[data-l1key=NbSnap]").parent().parent().show();     
	}
	else{
		$(".configKey[data-l1key=alertMessageCommand]").parent().parent().parent().hide();
		$(".configKey[data-l1key=NbSnap]").parent().parent().hide();
	}
});
$('body').on('switchChange.bootstrapSwitch change','.configKey[data-l1key=openParam]',function(){
	if($(this).is(':checked'))
		$('.openCvParamters').show();
	else
		$('.openCvParamters').hide();
});
$('#bt_AddCamera').on('click',function(){
	var cameraNb= $('div.camera').length+1;
	var cameraId='camera_'+cameraNb;
	AddCamera($(this).closest('.form-horizontal').find('.CameraListe'),cameraId);
});
function openCv_postSaveConfiguration(){
	$.ajax({
		type: "POST",
		timeout:8000, 
		url: "plugins/openCv/core/ajax/openCv.ajax.php",
		data: {
			action: "ConfigopenCv",
		},
		dataType: 'json',
		error: function(request, status, error) {
			handleAjaxError(request, status, error);
		},
		success: function(data) { 
			if (data.state != 'ok') {
				$('#div_alert').showAlert({message: data.result, level: 'danger'});
				return;
			}
		}
	});	
};
function AddCamera(div,cameraId){
	div.append($('<div class="camera">')
		.append($('<div class="form-group">')
			.append($('<label class="col-lg-4 control-label">').text('{{Url de la Camera}}'))
			.append($('<div class="col-lg-4 ">')
				.append($('<input class="configKey form-control" data-l1key="configuration" data-l2key="'+cameraId+'" data-l3key="cameraUrl">'))))
		.append('<legend></legend>')
		.append($('<div class="form-group">')
			.append($('<label class="col-lg-4 control-label">').text('{{Supprimer cette camera}}'))
			.append($('<div class="col-lg-4">')
				.append($('<a class="btn btn-danger" id="bt_removecamera">')
					.append($('<i class="fa fa-check">'))
					.text('{{Supprimer}}'))))
		.append('<legend></legend>'));
	$('body').on('click','#bt_removecamera', function() {
		$(this).closest('.camera').remove();
	}); 
}

</script>
