<?php

namespace App\Http\Services\Vaccine;

use App\Http\Repositories\VaccineRepository;

class GetAllVaccinesForPetService
{

    private $vaccineRepository;

    public function __construct(VaccineRepository $vaccineRepository)
    {
        $this->vaccineRepository = $vaccineRepository;
    }

    public function handle($id)
    {
        return $this->vaccineRepository->getAllVaccinesForPet($id);
    }
}
