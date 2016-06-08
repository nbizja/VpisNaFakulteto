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
        $programi = $this->razvrscanjeRepo->programiZRavrstitvami()->get();
        $programi->each(function(&$program) {

           $program->prijave = $program->prijave
               ->filter(function($prijava) {
                   return $prijava->sprejet;
               })
               ->sortByDesc('tocke');
        });
        return view('razvrscanje.vsi_rezultati')->with(['programi' => $programi]);
    }
    
    public function razvrsti()
    {

        $this->razvrscanje->razvrsti(
            $this->razvrscanjeRepo->vrniProgrameSPrijavamiSlovencev()->get()
        );

        return redirect('rezultati_razvrscanja');
    }

    public function izvoziSklepe()
    {
        return "sklepi";
    }
}