@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Pessoa {{ $element->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/element') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>
                        <a href="{{ url('/element/' . $element->id . '/edit') }}" title="Edit Element"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                        <form method="POST" action="{{ url('element' . '/' . $element->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Element" onclick="return confirm(&quot;Confirma deletar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr><th> Nome </th><td> {{ $element->name }} </td></tr><tr><th> Tipo </th><td> {{ $element->type() }} </td></tr>
                                </tbody>
                            </table>

                            @if($element->type_id === 1)
                            <a href="{{ url('/element_condominium/create/' . $element->id) }}" class="btn btn-secondary">Registrar apartamento</a>

                            <a href="{{ url('/element_condominium/' . $element->id) }}" class="btn btn-secondary">Apartamentos registrados</a>
                            <br>
                            <br>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
