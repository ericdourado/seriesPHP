<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\Carbon\PhpBug72338Test;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::with(['seasons'])->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        
        // dd($request->all());
        $serie = Serie::create($request->all());
        $seasons = [];
        

        for ($i = 1; $i <= $request->seasonQty; $i++) 
        {
            $seasons[] = [
                'series_id' => $serie->id,
                'number' => $i
            ];
        }
        Season::insert($seasons);
     

        $episodes = [];

        foreach ($serie->seasons as $season)
        {
            for ($i = 1; $i <= $request->episodesPerSeason; $i++) 
            {
                $episodes[] = [
                    'season_id' => $season->getattributes()['id'],
                    'number' => $i
                ];
            }
        }
        Episode::insert($episodes);

 
        
        return to_route('series.index')->with('mensagem.sucesso', "A série \"$serie->nome\" adicionada com sucesso");
    }

    public function destroy(Request $request, Serie $series)
    {
        $series->delete();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie \"$series->nome\" removida com sucesso");
        
       
    }

    public function edit(Request $request, Serie $series )
    {
        // dd($series->temporadas);
        return view('series.edit')->with('series', $series);
       
    }

    public function update(Serie $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')->with('mensagem.sucesso', "Série \"{$series->nome}\" atualizada com sucesso" );
        

    }
}
