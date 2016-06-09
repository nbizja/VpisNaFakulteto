<?php

namespace App\Http\Controllers;


use App\Models\Logic\Razvrscanje;
use App\Models\Repositories\RazvrscanjeRepository;
use Illuminate\Support\Facades\Auth;

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
            $this->razvrscanjeRepo->vrniProgrameSPrijavami()->get(), false
        );
        $this->razvrscanje->razvrsti(
            $this->razvrscanjeRepo->vrniProgrameSPrijavami()->get(), true
        );


        return redirect('rezultati_razvrscanja');
    }

    public function izvoziSklepe()
    {
        if (Auth::user()->vloga == 'skrbnik') {
            $kandidati = $this->razvrscanjeRepo->kandidati()->get();
            $pdf = \App::make('dompdf.wrapper');
            ini_set('max_execution_time', 300);
            $pdf->loadHTML(\View::make('pdf/sklepi', ['kandidati' => $kandidati]));
            return $pdf->download('sklepi.pdf');

        }

        return redirect('prijava');
    }
}