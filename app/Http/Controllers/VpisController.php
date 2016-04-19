<?php

namespace App\Http\Controllers;


use App\Models\Repositories\VpisRepository;

class VpisController extends Controller
{
    private $vpisRepository;

    public function __construct(VpisRepository $vpisRepository)
    {
        $this->vpisRepository = $vpisRepository;
    }

    public function prikazi()
    {
        return view('vpis.vpis')->with($this->vpisRepository->podatkiPrviKorak());
    }

    
}