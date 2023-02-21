<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use App\Repositories\SeriesRepository;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository
{

    public function add(SeriesFormRequest $request): Serie
    { 
        {
            return DB::transaction(function () use ($request) {
                // dd($request->all());
                $serie = Serie::create([
                    'nome' => $request->nome,
                    'cover' =>$request->coverPath
                ]);
                $seasons = [];


                for ($i = 1; $i <= $request->seasonQty; $i++) {
                    $seasons[] = [
                        'series_id' => $serie->id,
                        'number' => $i
                    ];
                }
                Season::insert($seasons);

                $episodes = [];

                foreach ($serie->seasons as $season) {
                    for ($i = 1; $i <= $request->episodesPerSeason; $i++) {
                        $episodes[] = [
                            'season_id' => $season->getattributes()['id'],
                            'number' => $i
                        ];
                    }
                }
                Episode::insert($episodes);
                return $serie;
            });
        }
    }
}
