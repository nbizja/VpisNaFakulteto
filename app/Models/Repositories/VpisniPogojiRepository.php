<?php

namespace App\Models\Repositories;

use App\Models\Element;
use App\Models\VpisniPogoj;
use App\Models\Poklic;

class VpisniPogojiRepository
{
    public function ElementiAll() {

        return Element::orderBy('ime', 'asc')->get();
    }

    public function PokliciAll() {

        return Poklic::orderBy('ime', 'asc')->get();
    }

    public function VpisniPogojByID($id) {

        return VpisniPogoj::where('id', $id)->first();
    }

    public function PoklicById($id) {

        return Poklic::where('id', $id)->first();
    }
}