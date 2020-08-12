<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Data' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($occurrence->date) ? \Carbon\Carbon::parse($occurrence->date)->format('Y-m-d') : ''}}" >
    {!! $errors->first('date', '<p class="help-block">Data inválida</p>') !!}
</div>
<div class="form-group {{ $errors->has('occurred') ? 'has-error' : ''}}">
    <label for="occurred" class="control-label">{{ 'Ocorrido' }}</label>
    <textarea class="form-control" name="occurred" type="text" id="occurred">{{ isset($occurrence->occurred) ? $occurrence->occurred : ''}}</textarea>
</div>

<div class="form-group">
    @if($formMode === 'edit')
        <a href="{{ url('/occurrence_element/create/' . $occurrence->id) }}" class="btn btn-secondary">Vincular pessoa</a>

        <a href="{{ url('/occurrence_element/' . $occurrence->id) }}" class="btn btn-secondary">Pessoas vinculadas</a>
        <br>
        <br>

        <a href="{{ url('/note/create/' . $occurrence->id) }}" class="btn btn-secondary">Adicionar informações</a>

        <a href="{{ url('/note/' . $occurrence->id) }}" class="btn btn-secondary">Informações adicionadas</a>
        <br>
        <br>
    @endif

    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Salvar' : 'Registrar' }}">
</div>

<script>
    $(function() {
        $('#occurred').focus();
    });
</script>
