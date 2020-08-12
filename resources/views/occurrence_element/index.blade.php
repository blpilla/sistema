@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Pessoas vinculadas à ocorrência {{ is_numeric($occurrence_id) ? '#'.$occurrence_id : '' }}</div>
                    <div class="card-body">
                        <a href="javascript:history.back()" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</button></a>

                        <form method="GET" action="{{ url('/occurrence_element') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Pessoa</th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($occurrence_element as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->element_name() }}</td>
                                        <td>
                                            <a href="{{ url('/occurrence_element/' . $item->id) }}" title="View Occurrence_element">
                                            <form method="POST" action="{{ url('/occurrence_element' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Occurrence_element" onclick="return confirm(&quot;Confirma deletar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Desvincular</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $occurrence_element->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
