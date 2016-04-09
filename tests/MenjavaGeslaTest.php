<?php
use App\Models\Uporabnik;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class MenjavaGeslaTest extends TestCase
{
    use DatabaseTransactions;

    public function test_pravilna_menjava_gesla()
    {
        $skrbnik = Uporabnik::where('username', 'skrbnik')->first();
        

    }
}