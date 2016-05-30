<?php

namespace App\Http\Controllers;


use App\Models\Logic\Razvrscanje;
use App\Models\Repositories\RazvrscanjeRepository;

class RazvrscanjeController extends Controller
{

    private $razvrscanjeRepo;
    private $razvrscanje;

    public function __construct(RazvrscanjeRepository $razvrscanjeRepository, Razvrscanje $razvrscanje)
    {
        $this->razvrscanjeRepo = $razvrscanjeRepository;
        $this->razvrscanje = $razvrscanje;
    }

    public function prikazi()
    {
        return view('razvrscanje.vsi_rezultati')->with('programi', $this->razvrscanjeRepo->programiZRavrstitvami() );
    }
    
    public function razvrsti()
    {
        $this->razvrscanje->razvrsti();

        return redirect('rezultati_razvrscanja');
    }
}