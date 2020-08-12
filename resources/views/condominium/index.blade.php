@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Apartamentos</div>
                    <div class="card-body">
                        <a href="{{ url('/condominium/create') }}" class="btn btn-success btn-sm" title="Add New Condominium">
                            <i class="fa fa-plus" aria-hidden="true"></i> Cadastrar
                        </a>

                        <form method="GET" action="{{ url('/condominium') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                            @if (session('info'))
                            <div class="alert">
                                {{ session('info') }}
                            </div>
                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Torre</th><th>Ap</th><th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($condominium as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tower }}</td><td>{{ $item->ap }}</td>
                                        <td>
                                            <a href="{{ url('/condominium/' . $item->id) }}" title="View Condominium"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Ver</button></a>
                                            <a href="{{ url('/condominium/' . $item->id . '/edit') }}" title="Edit Condominium"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>

                                            <form method="POST" action="{{ url('/condominium' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Condominium" onclick="return confirma(&quot;Confirm deletar?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $condominium->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
