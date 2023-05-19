<x-layout title="Episódios" :mensagem-sucesso="$mensagemSucesso">
    <form method="post" class="form-check form-switch">
        @csrf
        <div class="div_episodes">
            <ul class="list-group">
                @foreach ($episodes as $episode)
                    @php
                        $count += 1;
                    @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center {{ $count % 2 == 0 ? 'bg-light' : 'bg-custom-gray' }}">
                        Episódio {{ $episode->number }}

                        <input class="form-check-input bg-secondary" type="checkbox" name="episodes[]" value="{{ $episode->id }}"
                            @if ($episode->watched) checked @endif>
                    </li>
                @endforeach
            </ul>
        </div>
        <button class="btn btn-dark fw-bold">Salvar</button>
    </form>
</x-layout>

<style scoped>
    .div_episodes {
        margin: 2em 0 3em 0;
    }
    .bg-custom-gray{
        background-color: #888888;
    }
</style>
