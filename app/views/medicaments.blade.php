@extends('layout')
@section('js')
	controllerScope.$apply(function() {
		controllerScope.medicaments = {{ $medicaments }};
		if (jQuery.isEmptyObject(controllerScope.medicaments))
				controllerScope.medicaments = [{'id': 'Aucun medicament trouvé','code': 'Aucun medicament trouvé'}];
	});
@stop
@section('content')
	<div ng-controller="MedicamentController">
		<div class="popup">
			<p>
				<i class="fa fa-exclamation-triangle fa-2x"></i>
				Voulez-vous vraiment supprimer ce medicament ? (les notes et les commandes relatives à ce medicament ne seront pas supprimées)
			</p>
			<a class="btndanger" href="" ng-click="supprimer()">
				<i class="fa fa-trash-o fa-lg" style="color:#d2d2d2"></i> Supprimer
			</a>
			<a class="btnnone" href="" ng-click="annuler()">
				<i class="fa fa-check fa-lg" style="color:#d2d2d2"></i> Annuler
			</a>
		</div>
		<h2>Liste de Medicaments</h2>
		<label for="search">Filtrer ?</label>
		<input type="search" ng-model="searchText">
		{{ Form::open(array('url'=>'supprimer/medicament')) }}
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
					<th style="width: 10%"><a href="" ng-click="reverse=!reverse;order('code', reverse)">Code</a></th>
					<th style="width: 15%"><a href="" ng-click="reverse=!reverse;order('nom', reverse)">Nom</a></th>
					<th style="width: 15%">Famille</th>
					<th style="width: 7%"><a href="" ng-click="reverse=!reverse;order('q_stock', reverse)">Stock <i class="fa fa-sort"></i> </a></th>
					<th style="width: 7%"><a href="" ng-click="reverse=!reverse;order('q_minimum', reverse)">QM <i class="fa fa-sort"></i> </a></th>
					<th style="width: 7%"><a href="" ng-click="reverse=!reverse;order('ht', reverse)">HT <i class="fa fa-sort"></i> </a></th>
					<th style="width: 7%"><a href="" ng-click="reverse=!reverse;order('tt', reverse)">TT <i class="fa fa-sort"></i> </a></th>
					<th style="width: 22%">Description</th>
					<th style="width: 6%; background-color: #3f3e3d; color: #eee">
						<a href="javascript:changeView()" style="color: inherit"><i class="fa fa-2x fa-th-list" style="color: inherit"></i></a>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr class="slide-top" ng-repeat="medicament in medicaments | filter:searchText">
					<td><input type="checkbox" name="sup[]" id="<% medicaments[$index].id %>" value="<% medicaments[$index].id %>"></td>
					<td data-th="Code"><div><% medicament.code %></div></td>
					<td data-th="Nom"><div><% medicament.nom %></div></td>
					<td data-th="Famille"><div><% medicament.famille.nom %></div></td>
					<td data-th="Quantité en Stock"><div><% medicament.q_stock %></div></td>
					<td data-th="Quantité Minimum"><div><% medicament.q_minimum %></div></td>
					<td data-th="HT"><div><% medicament.ht %></div></td>
					<td data-th="TT"><div><% medicament.tt %></div></td>
					<td data-th="Description">
						<p>
							<% medicament.description %>
						</p>
					</td>
					<td>
						<a ng-href="{{ url('modifier/medicament') }}/<% medicament.id %>">
							<i class="icon fa fa-pencil fa-2x"></i>
						</a>
						<a href="" ng-click="confirmer($index)">
							<i class="icon fa fa-close fa-2x" style="color: #B20000;"></i>
						</a>
					</td>
				</tr>
			</tbody>
		</table>
		{{ Form::close() }}
	</div>
@stop