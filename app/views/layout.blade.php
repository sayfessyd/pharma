<!doctype html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Pharma</title>
	<!-- css  -->
	<link rel="shortcut icon" href="{{ asset('img/X32.png') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/responsive-table.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/img.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/lib/font-awesome.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/lib/modules/ng-animation.css') }}" />
	@yield('css')
	<!-- javaScript -->
	<script src="{{ asset('js/lib/jquery.min.js') }}"></script>
	<script src="{{ asset('js/lib/angular.js') }}"></script>
	<script src="{{ asset('js/lib/modules/angular-animate.js') }}"></script>
	<script>
		var app = angular.module("Pharma", ['ngAnimate'], function($interpolateProvider) {
			$interpolateProvider.startSymbol('<%');
			$interpolateProvider.endSymbol('%>');
		});
		var controllerScope;
		$(function() {
			controllerScope = angular.element($("div[ng-controller]")).scope();
			@yield('js')
		});
	</script>
	<script src="{{ asset('js/script.js') }}" charset="utf-8"></script>
	<script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
	@yield('homeJS')
</head>
<body ng-app="Pharma">
	<header>
		<div id="nav">
			<div id="logo">
				<img src="{{ asset('img/X64.png') }}">
				<h1></h1>
			</div>
			<a href="{{ url('/') }}"><i class="fa fa-home fa-3x"></i></a>
			<a href="{{ url('ajouter/famille') }}">Nouvelle Famille</a>
			<a href="{{ url('ajouter/medicament') }}">Nouveau Medicament</a>
			<a href="{{ url('ajouter/note') }}">Nouvelle Note</a>
			<a href="{{ url('ajouter/commande') }}">Nouvelle Commande</a>
		</div>
	</header>
	<aside>
		<div id="tab">
			<a data-content="Home" href="{{ url('/') }}"><div class="home"></div></a>
			<a data-content="Familles" href="{{ url('familles') }}"><div class="balls"></div></a>
			<a data-content="Medicaments" href="{{ url('medicaments') }}"><div class="medicala"></div></a>
			<a data-content="Notes" href="{{ url('notes') }}"><div class="medicalb"></div></a>
			<a data-content="Commandes" href="{{ url('commandes') }}"><div class="business"></div></a>
		</div>
	</aside>
	<div id="main">
		<div class="wrapper">
			@yield('content')
		</div>
	</div>
</body>
</html>