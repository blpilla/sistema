<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Ocorrências
        </div>

        <div class="card-body">
        <ul class="nav" role="tablist">
            <li role="presentation">
                <a href="{{ url('/occurrence/create') }}">
                    <b>Registrar Ocorrência</b>
                </a>
            </li>
        </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/occurrence') }}">
                        <b>Listar Ocorrências</b>
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/element') }}">
                        <b>Cadastro de Pessoas</b>
                    </a>
                </li>
            </ul>

            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/condominium') }}">
                        <b>Cadastro de Apartamentos</b>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
