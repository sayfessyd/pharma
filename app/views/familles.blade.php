@extends('layout')
@section('js')
	controllerScope.$apply(function() {
		controllerScope.familles = {{ $familles }};
		if (jQuery.isEmptyObject(controllerScope.familles))
				controllerScope.familles = [{'id': 'Aucune famille trouvée','code': 'Aucune famille trouvée'}];
	});
@stop
@section('content')
	<div ng-controller="FamilleController">
		<div class="popup">
			<p>
				<i class="fa fa-exclamation-triangle fa-2x"></i>
				Voulez-vous vraiment supprimer cette famille ? (<em style="color:red">Attention:</em> tous les médicaments appartenant à cette famille seront supprimés)
			</p>
			<a class="btndanger" href="" ng-click="supprimer()">
				<i class="fa fa-trash-o fa-lg" style="color:#d2d2d2"></i> Supprimer
			</a>
			<a class="btnnone" href="" ng-click="annuler()">
				<i class="fa fa-check fa-lg" style="color:#d2d2d2"></i> Annuler
			</a>
		</div>
		<h2>Liste de Familles </h2>
		<label for="search">Filtrer ?</label>
		<input type="search" ng-model="searchText">
		{{ Form::open(array('url'=>'supprimer/famille')) }}
		<table class="responsive-table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th style="width: 5%">
						<button type="submit" class="Xbtn">
						<i id="supp" class="fa fa-trash fa-2x" style="color: #3f3e3d;"></i>
						</button>
						<a href="javascript:checkAll()"><i class="fa fa-check-square-o fa-1x" style="color: #3f3e3d;"></i></a>
						<a href="javascript:unCheckall()"><i class="fa fa-square-o fa-1x" style="color: #3f3e3d;"></i></a>	
					</th>
					<th style="width: 15%"><a href="" ng-click="reverse=!reverse;order('code', reverse)">Code</a></th>
					<th style="width: 15%"><a href="" ng-click="reverse=!reverse;order('nom', reverse)">Nom</a></th>
					<th style="width: 60%;">Description</th>
					<th style="width: 6%; background-color: #3f3e3d; color: #eee">
							<a href="javascript:changeView()" style="color: inherit"><i class="fa fa-2x fa-th-list" style="color: inherit"></i></a>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr class="slide-top" ng-repeat="famille in familles | filter:searchText">
					<td><input type="checkbox" name="sup[]" id="<% familles[$index].id %>" value="<% familles[$index].id %>"></td>
					<td data-th="Code"><div><% famille.code %></div></td>
					<td data-th="Nom"><div><a href="{{ url('medicaments/famille/') }}/<% famille.id %>" style="text-decoration: underline;"><% famille.nom %></a></div></td>
					<td data-th="Description"><p><% famille.description %></p></td>
					<td>
						<a ng-href="{{ url('modifier/famille') }}/<% famille.id %>">
							<i class="icon fa fa-pencil fa-2x"></i>
						</a>
						<a href="" ng-click="confirmer($index)">
							<i id="supp" class="icon fa fa-close fa-2x" style="color: #B20000;"></i>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
		{{ Form::close() }}
	</div>
@stop