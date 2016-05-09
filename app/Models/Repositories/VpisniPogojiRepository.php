<?php

namespace App\Models\Repositories;

use App\Models\Element;
use App\Models\VpisniPogoj;


class VpisniPogojiRepository
{
    public function ElementiAll() {

        return Element::orderBy('ime', 'asc')->get();
    }

    public function VpisniPogojByID($id) {

        return VpisniPogoj::where('id', $id)->first();
    }
}