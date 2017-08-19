@extends('layout')
@section('js')
	controllerScope.$apply(function() {
		controllerScope.commandes = {{ $commandes }};
		if (jQuery.isEmptyObject(controllerScope.commandes))
			controllerScope.commandes = [{'id': 'Aucune commande trouvée'}];
		controllerScope.medicaments = {{ $medicaments }};
		if (jQuery.isEmptyObject(controllerScope.medicaments))
			controllerScope.medicaments = [{'id_commande': 'Aucune commande trouvée','nom_medicament': 'Aucun medicament trouvé'}];
	});
@stop
@section('css')
	<style type="text/css">
		.header th{
			background-color: #B20000;
		}
		.header th a{
			color: #FFFFFF;
		}
		#commandes td{
			background-color: #FFF;
			border-top: 1px solid #d2d2d2;
		}
		a .fa-arrow-circle-o-left{
			display: none;
		}
		@media only screen and (min-width: 940px) {
			.responsive-table td:last-child {
				padding-bottom: 1em;
			}
		}
	</style>
@stop
@section('content')
	<div ng-controller="CommandeController">
		<div class="popup">
			<br />
			<p align="center">
				<i class="fa fa-exclamation-triangle fa-2x"></i>
				Voulez-vous vraiment supprimer cette Commmande ?
			</p>
			<br />
			<a class="btndanger" href="" ng-click="supprimer()">
				<i class="fa fa-trash-o fa-lg" style="color:#d2d2d2"></i> Supprimer
			</a>
			<a class="btnnone" href="" ng-click="annuler()">
				<i class="fa fa-check fa-lg" style="color:#d2d2d2"></i> Annuler
			</a>
		</div>
		<h2>Liste des Commandes</h2>
		<label for="search2">Filtrer ?</label>
		<input name="search2" type="search" ng-model="searchText2">
		{{ Form::open(array('url'=>'supprimer/commande')) }}
		<table class="responsive-table" cellspacing="0" cellpadding="0">
			<thead>
				<tr class="header">
					<th style="width: 5%"><button type="submit" class="Xbtn">
						<i id="supp" class="fa fa-trash fa-2x" style="color: #eee;"></i>
					</button>
					<a href="javascript:checkAll()"><i class="fa fa-check-square-o fa-1x" style="color: #eee;"></i></a>
					<a href="javascript:unCheckall()"><i class="fa fa-square-o fa-1x" style="color: #eee;"></i></a>
					</th>
					<th style="width: 15%"><a href="" ng-click="reverse=!reverse;order('id', reverse)">Commande <i class="fa fa-sort" style="color:#eee;"></i> </a></th>
					<th style="width: 20%"><a href="" ng-click="reverse=!reverse;order('created_at', reverse)">Date <i class="fa fa-sort" style="color:#eee;"></i> </a></th>
					<th style="width: 20%"><a href="" ng-click="reverse=!reverse;order('updated_at', reverse)">MAJ <i class="fa fa-sort" style="color:#eee;"></i> </a></th>
					<th style="width: 15%"><a href="" ng-click="reverse=!reverse;order('nom', reverse)">Fournisseur </a></th>
					<th style="width: 10%"><a href="" ng-click="reverse=!reverse;order('nom', reverse)">reçue ? </a></th>
					<th style="width: 5%"><a href="{{ url('commandes') }}">
						<i class="fa fa-arrow-circle-o-left fa-2x" style="color: #eee;"></i>
					</a>
				</th>
				<th style="width: 5%"><a href="#imprimer" ng-click="printAll()">
					<i class="fa fa-print fa-2x" style="color: #eee;"></i>
				</a></th>
				<th style="width: 10%"><a href="#show"  ng-click="test = true">
					<i class="fa fa-plus-square fa-2x" style="color: #eee;"></i>
				</a>
				<a href="#hide" ng-click="test = false">
					<i class="fa fa-minus-square fa-2x" style="color: #eee"></i>
				</a>
			</th>
			<th style="width: 6%; background-color: #3f3e3d; color: #eee">
				<a href="javascript:changeView()" style="color: inherit"><i class="fa fa-2x fa-th-list" style="color: inherit"></i></a>
			</th>
		</tr>
	</thead>
	<tbody class="slide-top" ng-repeat="commande in commandes | filter:searchText2" id="commande<% $index %>">
		<tr id="commandes">
			<td><input type="checkbox" name="sup[]" id="<% commandes[$index].id %>" value="<% commandes[$index].id %>"></td>
			<td data-th="Commande"><div><% commande.id %></div></td>
			<td data-th="Date de creation"><div><% commande.created_at %></div></td>
			<td data-th="Date de M.A.J"><div><% commande.updated_at %></div></td>
			<td data-th="Fournisseur"><div><% commande.fournisseur %></div></td>
			<td data-th="reçue ?"><% commande.reception %></td>
			<td>	</td>
			<td>	</td>
			<td>	</td>
			<td>
				<a href="#show" ng-click="test = true">
					<i class="icon fa fa-plus-square-o  fa-2x"></i>
				</a>
				<a href="#hide" ng-click="test = false">
					<i class="icon fa fa-minus-square-o  fa-2x"></i>
				</a>
				<a href="{{ url('modifier/commande') }}/<% commande.id %>">
					<i class="icon fa fa-pencil fa-2x"></i>
				</a>
				<a href="" ng-click="confirmer($index)">
					<i class="icon fa fa-close fa-2x" style="color: #B20000;"></i>
				</a>
				<a href="" ng-click="print($index)">
					<i class="icon fa fa-print fa-2x"></i>
				</a>
				<a href="{{ url('commandes') }}">
					<i class="icon fa fa-arrows-circle-o-left fa-2x"></i>
				</a>
			</td>
		</tr>
		<tr ng-hide="!test">
			<th></th>
			<th><a href="" ng-click="reverse=!reverse;order_med('nom', reverse)">Articles</a></th>
			<th><a href="" ng-click="reverse=!reverse;order_med('quantite', reverse)">Quantité <i class="fa fa-sort"></i></a></th>
			<th>	</th>
			<th>	</th>
			<th>	</th>
			<th>	</th>
			<th>	</th>
			<th><label for="search1">Filtrer ?</label>
			<input name="search1" type="search" ng-model="searchText1" style="width:80px;"></th>
			<th>	</th>
		</tr>
		<tr id="medicaments" ng-hide="!test" class="slide-top" ng-repeat="medicament in medicaments| filter:{id_commande:commande.id}  | filter:searchText1">
			<td></td>
			<td data-th="Nom"><div><% medicament.nom_medicament %></div></td>
			<td data-th="Quantité"><div><% medicament.quantite %></div></td>
			<td>	</td>
			<td>	</td>
			<td>	</td>
			<td>	</td>
			<td>	</td>
			<td>	</td>
			<td>	</td>
		</tr>
	</tbody>
	</table>
	{{ Form::close() }}
	</div>
@stop