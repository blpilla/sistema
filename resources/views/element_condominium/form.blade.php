<div class="form-group {{ $errors->has('element_id') ? 'has-error' : ''}}">
    <input class="form-control" name="element_id" type="hidden" id="element_id" value="{{ isset($element_id) ? $element_id : (isset($element_condominium->element_id) ? $element_condominium->element_id : '')}}" >
    {!! $errors->first('element_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('condominium_id') ? 'has-error' : ''}}">
    <label for="condominium_id" class="control-label">{{ 'Unidade' }}</label><br>
    @if(isset($condominium_list) && count($condominium_list))
            {{ Form::select('condominium_id', isset($condominium_list) ? $condominium_list : null) }}
            {!! $errors->first('condominium_id', '<p class="help-block">:message</p>') !!}
    @else
        <a href="/condominium/create" class="btn btn-success btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Cadastrar apartamento
        </a>
    @endif

</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Salvar' : 'Registrar' }}">
</div>
