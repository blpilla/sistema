<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Nome' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($element->name) ? $element->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type_id') ? 'has-error' : ''}}">
    <label for="type_id" class="control-label">{{ 'Tipo' }}</label><br>
    {{ Form::select('type_id', isset($types) ? $types : $element->types(), isset($element->type_id) ? $element->type_id : null) }}
    {!! $errors->first('type_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    @if(isset($element) && $element->type_id === 1)
    <a href="{{ url('/element_condominium/create/' . $element->id) }}" class="btn btn-secondary">Registrar apartamento</a>

    <a href="{{ url('/element_condominium/' . $element->id) }}" class="btn btn-secondary">Apartamentos registrados</a>
    <br>
    <br>
    @endif

    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Salvar' : 'Cadastrar' }}">
</div>
