@extends('layout')
@section('content')
	@if ( is_object($famille) )
		<h2>Modifier la Famille {{ $famille->code }}</h2>
	@else
		<h2>Ajouter une Famille</h2>
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
		<br>
		@endif
		{{ Form::open(array('url'=>'editer/famille')) }}
		<p class="legend">
			<strong>Note: </strong>Required fields are marked with an asterisk (<em>*</em>)
		</p>
		<br>
		<fieldset>
			<legend>Details de la Famille</legend>
			<div>
				@if ($errors->has('code'))
					<label for="code" class="error">
						Code <em>*</em>
					</label>
					{{ Form::text('code', '', array('class'=>'error')) }}
				@else
					<label for="code">
						Code <em>*</em>
					</label>
					{{ Form::text('code', $famille['code']) }}
				@endif
				<p class="note">Un code est associé à une seule famille. </p>
			</div>
			<div>
				@if ($errors->has('nom'))
				{{ Form::label('nom', 'Nom', array('class'=>'error')) }}
				{{ Form::text('nom', '', array('class'=>'error')) }}
				@else
				{{ Form::label('nom', 'Nom') }}
				{{ Form::text('nom', $famille['nom'])}}
				@endif
			</div>
			<div>
				@if ($errors->has('description'))
				{{ Form::label('description', 'Description', array('class'=>'error')) }}
				{{ Form::textarea('description', '', array('cols'=>'50', 'rows'=>'10', 'class'=>'error')) }}
				@else
				{{ Form::label('description', 'Description') }}
				{{ Form::textarea('description', $famille['description'], array('cols'=>'50', 'rows'=>'10')) }}
				@endif
			</div>
		</fieldset>
		{{ Form::hidden('id', $famille['id']) }}
		<div class="buttonrow">
			{{ Form::submit('Enregistrer', array('class'=>'button')) }}
			<input class="button" type="reset">
		</div>
		{{ Form::close() }}
	</div>
@stop