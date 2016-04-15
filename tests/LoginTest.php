<?php


use App\Models\Uporabnik;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    public function test_prijava_z_napacnimi_podatki()
    {
        Uporabnik::create([
            'username' => 'testniUporabnik',
            'password' => Hash::make('geslo'),
            'zeton' => ''
        ]);

        $response = $this->call('POST', 'prijava', ['username' => 'testniUporabnik', 'password' => 'napacnogeslo']);
        $this->assertEquals($this->baseUrl . '/prijava', $response->headers->get('location'));

        $response = $this->call('POST', 'prijava', ['username' => 'neobstojeciUporabnik', 'password' => 'geslo']);
        $this->assertEquals($this->baseUrl . '/prijava', $response->headers->get('location'));
    }

    public function test_prijava_s_pravilnimi_podatki()
    {
        Uporabnik::create([
            'username' => 'testniUporabnik',
            'password' => Hash::make('geslo'),
            'zeton' => ''
        ]);

        $response = $this->call('POST', 'prijava', ['username' => 'testniUporabnik', 'password' => 'geslo']);
        $this->assertEquals($this->baseUrl, $response->headers->get('location'));
    }

    /*public function test_prijava_nepotrjenega_uporabnika()
    {
        Uporabnik::create([
            'username' => 'nepotrjeni',
            'password' => Hash::make('geslo'),
            'zeton' => 'd321DSda2ddsj230dd0ed23dsdwe'
        ]);
        $response = $this->call('POST', 'prijava', ['username' => 'nepotrjeni', 'password' => 'geslo']);
        $this->assertEquals($this->baseUrl . '/prijava', $response->headers->get('location'));
    }*/

    public function test_zaklepanje_prijave()
    {
        $this->call('POST', 'prijava', ['username' => 'neobstojeci', 'password' => 'geslo']);
        $this->call('POST', 'prijava', ['username' => 'neobstojeci', 'password' => 'geslo']);
        $this->call('POST', 'prijava', ['username' => 'neobstojeci', 'password' => 'geslo']);
        $response = $this->call('POST', 'prijava', ['username' => 'nepotrjeni', 'password' => 'geslo']);
        $this->assertEquals(429, $response->getStatusCode());
    }
}