<x-layout title="Temporadas de {{ $series->nome }}">
    <div class="text-center">
        <ul class="list-group">
            @if (!empty($series->cover))
                <div class="div_season_img">
                    <img src="{{ asset('storage/' . $series->cover) }}" style="height: 400px; width:70%; "
                        alt="Capa da série" class="img-fluid rounded">
                </div>
            @else
                <div class="div_season_img">
                    <img src="{{ asset('storage/series_cover/padrao.PNG') }}" style="height: 400px; width:70%;"
                        alt="Capa da série" class="img-fluid rounded">
                </div>
            @endif
    </div>
    <div class="div_season">
        @foreach ($seasons as $season)
            @php
                $count += 1;
            @endphp
            <li
                class="list-group-item d-flex justify-content-between align-items-center {{ $count % 2 == 0 ? 'bg-light' : 'bg-custom-gray' }}">
                <a href="{{ route('episodes.index', $season->id) }}" class="fonte fw-bold text-dark ">
                    Temporada {{ $season->number }}
                </a>

                <span class="badge bg-secondary">
                    {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </div>
    </ul>
</x-layout>


<style scoped>
    .div_season_img {
        margin: 3em 0em 3em 0;
    }

    .div_season {
        margin: 0em 0em 10em 5em;
    }

    .bg-custom-gray {
        background-color: #888888;
    }
    .fonte {
            text-decoration: none
        }
</style>
