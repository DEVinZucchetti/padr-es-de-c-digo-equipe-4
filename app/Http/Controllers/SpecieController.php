<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Specie;
use App\Http\Requests\StoreSpecieRequest;
use App\Http\Services\Specie\CreateSpecieService;
use App\Http\Services\Specie\GetAllSpeciesService;
use App\Http\Services\Specie\GetOneSpecieService;
use App\Traits\HttpResponses;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecieController extends Controller
{
    use HttpResponses;

    public function index(GetAllSpeciesService $getAllSpeciesService) {
        $species = $getAllSpeciesService->handle();
        return $species;
    }

    public function store(StoreSpecieRequest $request, CreateSpecieService $createSpecieService)
    {
        try {
            $body = $request->all();
            $race = $createSpecieService->handle($body);
            return $race;

        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id, GetOneSpecieService $getOneSpecieService) {

        $specie = $getOneSpecieService->handle($id);

        $amountPetsUsingSpecieId = Pet::query()->where('specie_id', $id)->count();

        if($amountPetsUsingSpecieId !== 0) {
            return $this->error('Existem pets usando essa espécie', Response::HTTP_CONFLICT);
        }

        if(!$specie) {
            return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);
        }

        $specie->delete();

        return $this->response('', Response::HTTP_NO_CONTENT);
    }
}
