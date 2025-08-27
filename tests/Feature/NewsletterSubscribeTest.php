<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NewsletterSubscribeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * On crée la table nécessaire uniquement pour la suite de tests,
     * sans migration applicative.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('newsletter_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('status')->default('active');
            $table->timestamps(); // created_at / updated_at
        });
    }

    /** @test */
    public function it_subscribes_with_valid_email()
    {
        // Utiliser un domaine qui passe la validation DNS
        $response = $this->post(route('newsletter.subscribe'), [
            'email' => 'testuser@gmail.com',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('status', 'Merci ! Votre inscription à la newsletter est prise en compte.');

        $this->assertDatabaseHas('newsletter_subscribers', [
            'email'  => 'testuser@gmail.com',
            'status' => 'active',
        ]);
    }

    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->from('/')->post(route('newsletter.subscribe'), [
            'email' => '',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');

        $this->assertDatabaseCount('newsletter_subscribers', 0);
    }

    /** @test */
    public function it_rejects_invalid_email()
    {
        $response = $this->from('/')->post(route('newsletter.subscribe'), [
            'email' => 'not-an-email',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');

        $this->assertDatabaseCount('newsletter_subscribers', 0);
    }

    /** @test */
    public function it_rejects_duplicate_email()
    {
        // Seed initial
        DB::table('newsletter_subscribers')->insert([
            'email'      => 'duplicate@gmail.com',
            'status'     => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tentative d’abonnement avec le même email
        $response = $this->from('/')->post(route('newsletter.subscribe'), [
            'email' => 'duplicate@gmail.com',
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHasErrors('email');

        $this->assertDatabaseCount('newsletter_subscribers', 1);
    }

    /** @test */
    public function it_normalizes_email_before_saving()
    {
        $messy = '   ProPre@GMAIL.com  ';

        $response = $this->post(route('newsletter.subscribe'), [
            'email' => $messy,
        ]);

        $response->assertRedirect();

        // Vérifie que l’email est normalisé en base
        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'propre@gmail.com',
        ]);
    }
}
