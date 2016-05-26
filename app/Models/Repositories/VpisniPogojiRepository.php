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

    public function VpisniPogojByStudijskiProgramSplosna($id) {

        return VpisniPogoj::where('id_programa', $id)->where('splosna_matura', '1')->get();
    }

    public function VpisniPogojByStudijskiProgramPoklicna($id) {

        return VpisniPogoj::where('id_programa', $id)->where('poklicna_matura', '1')->get();
    }

    public function PoklicById($id) {

        return Poklic::where('id', $id)->first();
    }
}