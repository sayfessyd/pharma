@extends('layout')
@section('content')
	@if ( is_object($medicament) )
		<h2>Modifier le Medicament {{ $medicament->code }}</h2>
	@else
		<h2>Ajouter un Medicament</h2>
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
		{{ Form::open(array('url'=>'editer/medicament')) }}
		<p class="legend">
			<strong>Note: </strong>Required fields are marked with an asterisk (<em>*</em>)
		</p>
		<br>
		<fieldset>
			<legend>Famille?</legend>
			<div>
				{{ Form::label('famille', 'Famille (Code Nom)') }}
				<select id="famille" name="famille">
					@foreach ($familles as $famille)
						@if ( is_object($medicament) )
							@if ($famille->code != $medicament->famille->code)
								<option value="{{ $famille->id }}">{{ $famille->code }} {{ $famille->nom }}</option>
							@else
								<option value="{{ $famille->id }}" selected="selected">{{ $famille->code }} {{ $famille->nom }}</option>
							@endif
						@else
							<option value="{{ $famille->id }}">{{ $famille->code }} {{ $famille->nom }}</option>
						@endif
					@endforeach
				</select>
			</div>
		</fieldset>
		<fieldset>
			<legend>Details du Medicament</legend>
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
					{{ Form::text('code', $medicament['code']) }}
				@endif
				<p class="note">Un code est associé à un seul medicament. </p>
			</div>
			<div>
				@if ($errors->has('nom'))
				{{ Form::label('nom', 'Nom', array('class'=>'error')) }}
				{{ Form::text('nom', '', array('class'=>'error')) }}
				@else
				{{ Form::label('nom', 'Nom') }}
				{{ Form::text('nom', $medicament['nom']) }}
				@endif
			</div>
			<div>
				@if ($errors->has('q_stock'))
				{{ Form::label('q_stock', 'Quantité en stock', array('class'=>'error')) }}
				{{ Form::text('q_stock', '', array('class'=>'error','maxlength'=>'5','size'=>'5')) }}
				@else
				{{ Form::label('q_stock', 'Quantité en stock') }}
				{{ Form::text('q_stock', $medicament['q_stock'], array('maxlength'=>'5','size'=>'5')) }}
				@endif
			</div>
			<div>
				@if ($errors->has('q_minimum'))
				{{ Form::label('q_minimum', 'Quantité minimum', array('class'=>'error')) }}
				{{ Form::text('q_minimum', '', array('class'=>'error','maxlength'=>'5','size'=>'5')) }}
				@else
				{{ Form::label('q_minimum', 'Quantité minimum') }}
				{{ Form::text('q_minimum', $medicament['q_minimum'], array('maxlength'=>'5','size'=>'5')) }}
				@endif
			</div>
			<div>
				@if ($errors->has('ht'))
				{{ Form::label('ht', 'HT', array('class'=>'error')) }}
				{{ Form::text('ht', '', array('class'=>'error','maxlength'=>'8','size'=>'8')) }}
				@else
				{{ Form::label('ht', 'HT') }}
				{{ Form::text('ht', $medicament['ht'], array('maxlength'=>'8','size'=>'8')) }}
				@endif
			</div>
			<div>
				@if ($errors->has('tt'))
				{{ Form::label('tt', 'TT', array('class'=>'error')) }}
				{{ Form::text('tt', '', array('class'=>'error','maxlength'=>'5','size'=>'5')) }}
				@else
				{{ Form::label('tt', 'TT') }}
				{{ Form::text('tt', $medicament['tt'], array('maxlength'=>'5','size'=>'5')) }}
				@endif
			</div>
			<div>
				@if ($errors->has('autorise'))
					{{ Form::label('autorise', 'Vente libre?', array('class'=>'error')) }}
					{{ Form::radio('autorise', '1', true) }} <span style="font-size: 12px">Oui</span>
					{{ Form::radio('autorise', '0') }} <span style="font-size: 12px">Non</span>
				@else
					{{ Form::label('autorise', 'Vente libre?') }}
					@if ($medicament['autorise'] == 1)
					{{ Form::radio('autorise', '1', true) }} <span style="font-size: 12px">Oui</span>
					{{ Form::radio('autorise', '0', false) }} <span style="font-size: 12px">Non</span>
					@else
					{{ Form::radio('autorise', '1', false) }} <span style="font-size: 12px">Oui</span>
					{{ Form::radio('autorise', '0', true) }} <span style="font-size: 12px">Non</span>
					@endif
				@endif
			</div>
			<div>
				@if ($errors->has('description'))
				{{ Form::label('description', 'Description', array('class'=>'error')) }}
				{{ Form::textarea('description', '', array('cols'=>'50', 'rows'=>'10', 'class'=>'error')) }}
				@else
				{{ Form::label('description', 'Description') }}
				{{ Form::textarea('description', $medicament['description'], array('cols'=>'50', 'rows'=>'10')) }}
				@endif
			</div>
		</fieldset>
		{{ Form::hidden('id', $medicament['id']) }}
		<div class="buttonrow">
			{{ Form::submit('Enregistrer', array('class'=>'button')) }}
			<input class="button" type="reset">
		</div>
		{{ Form::close() }}
	</div>
@stop