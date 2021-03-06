@extends('layout')

@section('homeJS')
	<script>
		$(document).ajaxStart(function() {
	    	$("#ajax").show();
		});
		$(document).ajaxStop(function() {
		    $("#ajax").hide();
		});
		$(document).ready(function() {
		    $.ajax({
		        url: '{{ action('HomeController@test') }}',
		        type: 'GET',
		        datatype: 'html',
		        success: function(html_code, status) {
		        	if (html_code != '')
		        	{
		        		$(".errors").fadeIn();
		            	$(".errors").append(html_code);
		            }
		        }
	    	});
	    	
		});
	</script>
@stop

@section('js')
	$("#year").change(function()
	{
		var year = $("#year").val();
		$.ajax({
	        url: '{{ url("stat") }}/' + year,
	        type: 'GET',
	        datatype: 'json',
	        success: function(json_code, status) {
		        controllerScope.$apply(function() {
		        	controllerScope.stat =  $.parseJSON(json_code);
	        	});
	        }
		});
	});
	$("#year").trigger('change');
@stop

@section('content')
	<div id="ajax">
           <img src="{{ asset('img/ellipsis.svg') }}">
    </div>
	<h1><i class="fa fa-dashboard "></i> Tableau de bord</h1>
	<br />
	<div style="display: none" class="errors"></div>
	<img id="board-img" src="{{ asset('img/backg.jpg') }}" width="40%">
	<p style="margin-left: 30px">Pharma est une application web qui permet la gestion de stock d'une pharmacie.</p>
	<br />
	<h2><i class="fa fa-trophy"></i> Caractéristiques<br /></h2>
	<br />
	<ul style="list-style-type: upper-roman">
		<li><strong>Gestion </strong>de familles, medicaments, notes et commandes ( ajout / modification / suppression )</li>
		<li><strong>Mise à jour Automatique </strong>du stock après une operation d'edition de note ou après la reception d'une commande</li>
		<li><strong>Impression </strong>de notes et de commandes</li>
		<li><strong>Gestion des Caisses </strong> => controller les flux financiers</li>
		<li><strong style="color:red">Responsive View </strong> => gérer votre stock à partir d'un smartphone</li>
	</ul>
	<div ng-controller="HomeController">
		<br />
		<h2><i class="fa fa-pie-chart "></i> Controle de flux financiers</h2>
		<select id="year">
			<option selected>2015</option>
			<option>2016</option>
			<option>2017</option>
			<option>2018</option>
			<option>2019</option>
			<option>2020</option>
		</select>
		<table class="responsive-table" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th style="width: 50%"><a href="" ng-click="reverse=!reverse;orderGains('mois', reverse)">Mois <i class="fa fa-sort"></i></a></th>
					<th style="width: 50%"><a href="" ng-click="reverse=!reverse;orderGains('sommes', reverse)">Gains <i class="fa fa-sort"></i></a></th>
				</tr>
			</thead>
			<tbody>
				<tr class="slide-top" ng-repeat="gain in stat.gains">
					<td data-th="Mois"><div><% gain.mois %></div></td>
					<td data-th="Gains"><div style="text-align: center"><% gain.sommes %></div></td>
				</tr>
			</tbody>
			<thead>
				<tr>
					<th style="width: 50%"><a href="" ng-click="reverse=!reverse;orderDepenses('mois', reverse)">Mois <i class="fa fa-sort"></i></a></th>
					<th style="width: 50%"><a href="" ng-click="reverse=!reverse;orderDepenses('sommes', reverse)">Dépenses <i class="fa fa-sort"></i></a></th>
				</tr>
			</thead>
			<tbody>
				<tr class="slide-top" ng-repeat="depense in stat.depenses">
					<td data-th="Mois"><div><% depense.mois %></div></td>
					<td data-th="Depenses"><div style="text-align: center"><% depense.sommes %></div></td>
				</tr>
			</tbody>
		</table>
	</div>
	
@stop