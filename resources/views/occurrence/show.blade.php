@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Ocorrência {{ $occurrence->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/occurrence') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('/occurrence/' . $occurrence->id . '/edit') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('occurrence' . '/' . $occurrence->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Occurrence" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr><th> Data </th><td> {{ \Carbon\Carbon::parse($occurrence->date)->format('d/m/Y')}} </td></tr><tr><th> Ocorrido</th><td> {{ $occurrence->occurred }} </td></tr>
                                </tbody>
                            </table>

                            <a href="{{ url('/occurrence_element/create/' . $occurrence->id) }}" class="btn btn-secondary">Vincular pessoa</a>

                            <a href="{{ url('/occurrence_element/' . $occurrence->id) }}" class="btn btn-secondary">Pessoas vinculadas</a>
                            <br>
                            <br>
                            <a href="{{ url('/note/create/' . $occurrence->id) }}" class="btn btn-secondary">Adicionar informações</a>

                            <a href="{{ url('/note/' . $occurrence->id) }}" class="btn btn-secondary">Informações adicionadas</a>
                            <br>
                            <br>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
