<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Repositories\SeriesRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
    }

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
        $serie = $this->repository->add($request);

        return to_route('series.index')->with('mensagem.sucesso', "A série \"$serie->nome\" adicionada com sucesso");
    }

    public function destroy(Request $request, Serie $series)
    {
        $series->delete();
        return to_route('series.index')
            ->with('mensagem.sucesso', "Serie \"$series->nome\" removida com sucesso");
    }

    public function edit(Request $request, Serie $series)
    {
        // dd($series->temporadas);
        return view('series.edit')->with('series', $series);
    }

    public function update(Serie $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')->with('mensagem.sucesso', "Série \"{$series->nome}\" atualizada com sucesso");
    }
}
