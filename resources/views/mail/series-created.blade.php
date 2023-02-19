@component('mail::message')

# {{ $nomeSerie }} Criada

A serie {{ $nomeSerie }} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episódios foi criada

Acesse Aqui:
@component('mail::button', ['url' => route('seasons.index', '42')])
    Ver Série
@endcomponent

@endcomponent
