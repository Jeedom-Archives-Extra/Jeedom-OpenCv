<?php

require_once dirname(__FILE__) . '/../../../core/php/core.inc.php';
include_file('core', 'authentification', 'php');
if (!isConnect()) {
    include_file('desktop', '404', 'php');
    die();
}
?>
<form class="form-horizontal">
	<legend>Configuration des Camera<a class="btn btn-success btn-xs pull-right cursor" id="bt_AddCamera"><i class="fa fa-check"></i> {{Ajouter}}</a></legend>
	<fieldset>
		<table id="table_camera" class="table table-bordered table-condensed tablesorter">
			<thead>
				<tr>
					<th>{{Nom}}</th>
					<th>{{Url}}</th>
					<th>{{}}</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</fieldset>
</form>
<script>	
$.ajax({
	type: "POST",
	timeout:8000,
	url: "core/ajax/config.ajax.php",
	data: {
		action:'getKey',
		key:'{"configuration":""}',
		plugin:'openCv'
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
			var Camera= new Object();
			$.each(data.result['configuration'], function(param,valeur){
				switch(typeof(valeur)){
					case 'object':
						$.each(valeur, function(key,value ){
							if (typeof(Camera[key]) === 'undefined')
								Camera[key]= new Object();
							if (typeof(Camera[key]['configuration']) === 'undefined')
								Camera[key]['configuration']= new Object();
							Camera[key]['configuration'][param]=value;
						});
					break;
					case 'string':
						if (typeof(Camera[0]) === 'undefined')
							Camera[0]= new Object();
						if (typeof(Camera[0]['configuration']) === 'undefined')
							Camera[0]['configuration']= new Object();
						Camera[0]['configuration'][param]=valeur;
					break;
				}
			});
			$.each(Camera, function(id,data){
				AddCamera($('#table_camera tbody'),data);
			});
		}
	}
});
$('body').on('click','.bt_removecamera', function() {
	$(this).closest('tr').remove();
});
$('body').on('click','#bt_AddCamera', function() {
	AddCamera($('#table_camera tbody'),'');
});
function AddCamera(_el,data){
	var id= $('.configKey[data-l1key=configuration][data-l2key=cameraUrl]').length +1;
	var tr=$('<tr>');
	tr.append($('<td>')
		.append($('<input class="configKey form-control input-sm "data-l1key="configuration" data-l2key="name">')));
	tr.append($('<td>')
		.append($('<input type="text" class="configKey form-control" data-l1key="configuration" data-l2key="username" placeholder="{{Nom d\'utilisateur}}"/>'))
		.append($('<input type="password" class="configKey form-control" data-l1key="configuration" data-l2key="password" placeholder="{{Mot de passe}}"/>'))
		.append($('<input type="text" class="configKey form-control" data-l1key="configuration" data-l2key="cameraUrl" placeholder="{{URL de capture}}"/>')));
	tr.append($('<td>')
		.append($('<input type="hidden" class="configKey" data-l1key="configuration" data-l2key="id">'))
		.append($('<span class="input-group-btn">')
			.append($('<a class="btn btn-default btn-sm bt_removecamera">')
				.append($('<i class="fa fa-minus-circle">')))));
	_el.append(tr);
	_el.find('tr:last').setValues(data, '.configKey');
	_el.find('tr:last').find('.configKey[data-l1key=configuration][data-l2key=id]').val(id);
} 
</script>
