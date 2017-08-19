@extends('layout')
@section('content')
	@if ( is_numeric($list['id']) )
		<h2>Modifier la Commande {{ $list['id'] }}</h2>
	@else
		<h2>Ajouter une Commande</h2>
	@endif
	<br>
	<div class="form-container">
		@if($errors->any())
			<div class="errors">
				<p><em>Oops... the following errors were encountered:</em></p>
				<br>
				<ul>
					@foreach ($errors->all() as $message)
						<li>{{ $message }}</li>
					@endforeach
				</ul>
				<br>
				<p>Data has <strong>not</strong> been saved.</p>
			</div>
			<br />
		@endif
		{{ Form::open(array('url'=>'editer/commande')) }}
		<p class="legend">
			<strong>Note: </strong>Required fields are marked with an asterisk (<em>*</em>)
		</p>
		<br />
		<fieldset>
			<legend>Details de la commande</legend>
			<div>
				{{ Form::label('liste', 'Medicaments ?') }}
				<select id="liste" name="liste" style="width:20%">
					@foreach ($medicaments as $medicament)
						<option value="{{ $medicament->id }}">{{ $medicament->code }}</option>
					@endforeach
				</select>
				{{ Form::button('Ajouter', array('onclick' => 'ajouterListe()')) }}
			</div>
			<div>
				{{ Form::label('codes', 'Codes sélectionnés') }}
				{{ Form::text('codes', $list['codes'], array('style' => 'width: 60%', 'id' => 'codes')) }}
			</div>
			<div>
				{{ Form::label('quantites', 'Quantités') }}
				{{ Form::text('quantites', $list['quantites'], array('style' => 'width: 60%')) }}
			</div>
			<div>
				{{ Form::label('fournisseur', 'Fournisseur') }}
				{{ Form::text('fournisseur', $list['fournisseur'], array('style' => 'width: 60%')) }}
			</div>
			<div>
				{{ Form::label('recu', 'Commande reçue ?') }}
				{{ Form::radio('recu', 'non', !$list['reception']) }} <span style="font-size: 12px">Non</span>
				{{ Form::radio('recu', 'oui', $list['reception']) }} <span style="font-size: 12px">Oui</span>
			</div>
			<div>
				{{ Form::label('prix', 'Prix Total') }}
				{{ Form::text('prix', $list['prix'], array('style' => 'width: 10%')) }}
				<span style="font-size: 12px">le prix total de la commande ne sera pris en compte que si celle-ci est dèja reçue.</span>
			</div>
		</fieldset>
		{{ Form::hidden('id', $list['id']) }}
		<div class="buttonrow">
			{{ Form::submit('Enregistrer', array('class'=>'button')) }}
			<input class="button" type="reset">
		</div>
		{{ Form::close() }}
	</div>
@stop