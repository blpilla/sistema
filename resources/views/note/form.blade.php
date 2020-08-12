<div class="form-group {{ $errors->has('occurrence_id') ? 'has-error' : ''}}">
    <input class="form-control" name="occurrence_id" type="hidden" id="occurrence_id" value="{{ isset($occurrence_id) ? $occurrence_id : (isset($occurrence_element->occurrence_id) ? $occurrence_element->occurrence_id : '')}}" >
    {!! $errors->first('occurrence_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Data' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($note->date) ? \Carbon\Carbon::parse($note->date)->format('Y-m-d') : ''}}" >
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="note" class="control-label">{{ 'Informações' }}</label>
    <input class="form-control" name="note" type="text" id="note" value="{{ isset($note->note) ? $note->note : ''}}" >
    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Salvar' : 'Adicionar' }}">
</div>
