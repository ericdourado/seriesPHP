<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Season;
use App\Models\Serie;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }
    public function index(Request $request)
    {
        $query = Serie::query();
        if ($request->has('nome')) 
        {
            $query->where('nome', $request->nome); 
        }
        return $query->paginate(5);
        
    }

    public function show(int $serie)
    {
        $serie = Serie::with('seasons.episodes')->find($serie);
        if ($serie == null) {
            return response()->json(['message' => 'Serie nao encontrada'], 404);
        }
        return $serie;
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = Serie::create($request->all());
        return response()
            ->json($this->seriesRepository->add($request), 201);
    }

    public function update(int $id, SeriesFormRequest $request)
    {

        $serie = Serie::whereId($id)->first();
        $serie = $serie->fill($request->all());
        $serie->save();

        return $serie;
    }

    public function destroy(int $id)
    {
        Serie::destroy($id);
        return response()->noContent();
    }
}
