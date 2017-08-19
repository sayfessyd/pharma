@extends('layout')
@section('content')
	@if ( is_numeric($list['id']) )
		<h2>Modifier la Note {{ $list['id'] }}</h2>
	@else
		<h2>Ajouter une Note</h2>
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
		{{ Form::open(array('url'=>'editer/note')) }}
		<p class="legend">
			<strong>Note: </strong>Required fields are marked with an asterisk (<em>*</em>)
		</p>
		<br />
		<fieldset>
			<legend>Details de la note</legend>
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
		</fieldset>
		{{ Form::hidden('id', $list['id']) }}
		<div class="buttonrow">
			{{ Form::submit('Enregistrer', array('class'=>'button')) }}
			<input class="button" type="reset">
		</div>
		{{ Form::close() }}
	</div>
@stop