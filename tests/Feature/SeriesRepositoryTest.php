<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created()
    {
        /**
         * @var SeriesRepository $repository 
         */
       $repository = $this->app->make(SeriesRepository::class);
       $request = new SeriesFormRequest();
       $request->nome = 'aff';
       $request->seasonQty = 2;
       $request->episodesPerSeason = 4;
       
       // Ação
       $repository->add($request);

       // Resultado esperado
       $this->assertDatabaseHas('series',['nome' => 'aff']);
       $this->assertDatabaseHas('seasons',['number' => 2]);
       $this->assertDatabaseHas('episodes',['number' => 4]);
    }
}
