<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\Carbon\PhpBug72338Test;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        
        $serie = Serie::create($request->all());
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
        return view('series.edit')->with('series', $series);
       
    }

    public function update(Serie $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')->with('mensagem.sucesso', "Série \"{$series->nome}\" atualizada com sucesso" );
        

    }
}
