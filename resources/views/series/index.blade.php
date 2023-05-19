<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
        <a href="{{ route('series.create') }}" class="btn btn-dark fw-bold">Adicionar</a>
    @endauth

    <ul class="list-group card body_ul ">
        @foreach ($series as $serie)
            @php
                $count += 1;
            @endphp
            <li
                class="list-group-item d-flex justify-content-between align-items-center {{ $count % 2 == 0 ? 'bg-light' : 'bg-custom-gray' }}">
                <div class="d-flex align-items-center">


                    @if (!empty($serie->cover))
                        <img class="me-3 rounded" src="{{ asset('storage/' . $serie->cover) }}" width="150"
                            height="90" alt="">
                    @else
                        <img class="me-3 rounded" src="{{ asset('storage/series_cover/padrao.PNG') }}" width="150"
                            height="90" alt="">
                    @endif

                    @auth <a href="{{ route('seasons.index', $serie->id) }}" class="text-dark fonte fw-bold"> @endauth
                        {{ $serie->nome }}
                        @auth </a> @endauth
                </div>
                @auth
                    <span class="d-flex">
                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-dark btn fw-bold">Editar</a>
                        <form action="{{ route('series.destroy', $serie->id) }}" method="POST" class="ms-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-secondary btn fw-bold">
                                Excluir
                            </button>
                        </form>
                    </span>
                @endauth
            </li>
        @endforeach
    </ul>

    <div class="pagination-container">
        <ul class="pagination pagination-sm justify-content-center">
            {{ $series->links() }}
        </ul>
    </div>

    <style scoped>
        .fonte {
            text-decoration: none
        }

        .bg-custom-gray {
            background-color: #888888;
        }

        .body_ul {
            margin: 2em 0 5em 0;
        }

        .pagination-container .pagination.pagination-sm .page-link {
            color: white;
            background-color: black;
            border-color: black;
        }

        .pagination-container .pagination.pagination-sm .page-link:hover {
            background-color: #333;
            border-color: #333;
        }
    </style>
</x-layout>
