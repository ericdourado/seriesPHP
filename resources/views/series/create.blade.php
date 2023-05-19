<x-layout title="Nova serie" >
    <form action="{{route('series.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input 
                    type="text" 
                    id="nome" 
                    name="nome"
                    class="form-control" 
                    value="{{old('nome')}}" >
            </div>

            <div class="col-2">
                <label for="seasonQty" class="form-label">N° de temporadas:</label>
                <input 
                    type="text" 
                    id="seasonQty" 
                    name="seasonQty"
                    class="form-control" 
                    value="{{old('seasonQty')}}" >
            </div>
            
            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Episodios/temporada:</label>
                <input 
                    type="text" 
                    id="episodesPerSeason" 
                    name="episodesPerSeason"
                    class="form-control" 
                    value="{{old('episodesPerSeason')}}" >
            </div>
        </div>
        <div class="row mb-3">
            <div class="col12">
                <label for="cover" class="form-label">Capa</label>
                <input type="file" 
                        id="cover" 
                        name="cover" 
                        class="form-control" 
                        accept="image/gif, image/jpeg, image/png">
            </div>
        </div>
    
        <button type="submit" class="btn btn-primary btn btn-dark fw-bold">
                Adicionar
        </button>
    </form>
</x-layout>