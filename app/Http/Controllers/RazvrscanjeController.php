<?php

namespace App\Http\Controllers;


use App\Models\Repositories\RazvrscanjeRepository;

class RazvrscanjeController extends Controller
{

    private $razvrscanjeRepo;

    public function __construct(RazvrscanjeRepository $razvrscanjeRepository)
    {
        $this->razvrscanjeRepo = $razvrscanjeRepository;
    }

    public function prikazi()
    {
        return view('razvrscanje.vsi_rezultati')->with('programi', $this->razvrscanjeRepo->programiZRavrstitvami() );
    }
    
    
}