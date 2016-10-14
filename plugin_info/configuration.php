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
					<input type="checkbox" class="configKey" data-label-text="{{Activer}}" data-l1key="snapshot"/>
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

$('#bt_AddCamera').on('click',function(){
	var cameraNb= $('div.camera').length+1;
	var cameraId='camera_'+cameraNb;
	AddCamera($(this).closest('.form-horizontal').find('.CameraListe'),cameraId);
});
function openCv_postSaveConfiguration(){
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
