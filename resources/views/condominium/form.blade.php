<div class="form-group {{ $errors->has('tower') ? 'has-error' : ''}}">
    <label for="tower" class="control-label">{{ 'Torre' }}</label>
    {{ Form::select('tower', isset($towers) ? $towers : $condominium->towers(), isset($condominium->tower) ? $condominium->tower : null) }}
    {!! $errors->first('tower', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('ap') ? 'has-error' : ''}}">
    <label for="ap" class="control-label">{{ 'Apartamento' }}</label>
    <input class="form-control" name="ap" type="number" id="ap" value="{{ isset($condominium->ap) ? $condominium->ap : ''}}" >
    {!! $errors->first('ap', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Salvar' : 'Cadastrar' }}">
</div>
