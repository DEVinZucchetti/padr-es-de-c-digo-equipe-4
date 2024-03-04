<?php

namespace App\Http\Repositories;

use App\Interfaces\SpecieRepositoryInterface;
use App\Models\Specie;

class SpecieRepository implements SpecieRepositoryInterface {

    public function getAll() {
        return Specie::all();
    }
}
