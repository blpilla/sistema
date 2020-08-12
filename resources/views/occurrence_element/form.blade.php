<div class="form-group {{ $errors->has('element_id') ? 'has-error' : ''}}">
    <label for="element_id" class="control-label">{{ 'Pessoa' }}</label><br>
    @if(isset($elements) && count($elements) || isset($occurrence_element) && count($occurrence_element->elements()))
        {{ Form::select('element_id', isset($elements) ? $elements : $occurrence_element->elements(), isset($occurrence_element->element_id) ? $occurrence_element->element_id : null) }}
        {!! $errors->first('element_id', '<p class="help-block">:message</p>') !!}
    @else
        <a href="/element/create" class="btn btn-success btn-sm"><i aria-hidden="true" class="fa fa-plus"></i> Cadastrar pessoa
        </a>
    @endif

</div>
<div class="form-group {{ $errors->has('occurrence_id') ? 'has-error' : ''}}">
    <input class="form-control" name="occurrence_id" type="hidden" id="occurrence_id" value="{{ isset($occurrence_id) ? $occurrence_id : (isset($occurrence_element->occurrence_id) ? $occurrence_element->occurrence_id : '')}}" >
    {!! $errors->first('occurrence_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Salvar' : 'Vincular' }}">
</div>
