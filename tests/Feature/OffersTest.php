<?php

namespace Tests\Feature;

use App\Offer;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OffersTest extends TestCase
{

    use RefreshDatabase;

    /**
     *@group todo
     *
     * @test
     */

    public function testShowAllOffers()
    {

        $offers = factory(Offer::class, 50)->create();

        $response = $this->get('/offers');
        $response->assertStatus(200);
        $response->assertSuccessful();
        $response->assertViewIs('list_offer');
       

        //TODO Contar que hi ha 50 el resultat

        foreach ($offers as $offer) {

            $response->assertSeeText($offer ->name);
            $response->assertSeeText($offer ->description);


        }
    }



    public function testShowAnOffer()
    {
        // Preparo
        $offer = factory(Offer::class)->create();
        // Executo
        $response = $this->get('/offers/' . $offer->id);
        //ccomprovo
        $response->assertStatus(200);

        $response->assertSuccessful();
        $response->assertViewIs('show_offer');
        $response->assertViewHas('offer');

        $response->assertSeeText($offer ->name);
        $response->assertSeeText($offer ->description);
        $response->assertSeeText('Offer');
    }

    public function testNotShowAnOffer()
    {
        // Preparo
        $ofer = factory(Offer::class)->create();
        // Executo
        $response = $this->get('/offers/999999');
        //ccomprovo
        $response->assertStatus(404);
    }
}
