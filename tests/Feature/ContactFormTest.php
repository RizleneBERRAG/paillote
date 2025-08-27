<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use WithFaker;

    /** @var string */
    protected $contactUrl = '/contact';

    protected function setUp(): void
    {
        parent::setUp();

        // Désactive uniquement la vérif CSRF pour ces tests
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        // URL de la route (nommée ou fallback /contact)
        $this->contactUrl = app('router')->has('contact.send') ? route('contact.send') : '/contact';

        // Recrée une table de test éphémère (pas de migration ajoutée au projet)
        if (Schema::hasTable('contact_messages')) {
            Schema::drop('contact_messages');
        }
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('email', 190);
            $table->string('phone', 40)->nullable();
            $table->string('subject', 190)->nullable();
            $table->text('message');
            $table->boolean('consent')->default(false);
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('status', 32)->default('new');
            $table->timestamps();
        });
    }

    protected function tearDown(): void
    {
        if (Schema::hasTable('contact_messages')) {
            Schema::drop('contact_messages');
        }
        parent::tearDown();
    }

    /** @test */
    public function it_sends_contact_when_payload_is_valid()
    {
        $payload = [
            'name'    => 'John Doe',
            'email'   => 'john.doe@gmail.com',
            'phone'   => '+33612345678',
            'subject' => 'reservation',
            'message' => 'Bonjour, je souhaite réserver pour 4 personnes vendredi.',
            'consent' => 'on', // accepted
        ];

        $resp = $this
            ->withHeaders(['User-Agent' => 'PHPUnit UA'])
            ->withServerVariables(['REMOTE_ADDR' => '203.0.113.10'])
            ->from('/contact')
            ->post($this->contactUrl, $payload);

        $resp->assertRedirect('/contact');
        $resp->assertSessionHas('status', 'Merci, votre message a bien été envoyé !');

        $this->assertDatabaseHas('contact_messages', [
            'email'  => 'john.doe@gmail.com',
            'name'   => 'John Doe',
            'status' => 'new',
        ]);

        $row = \DB::table('contact_messages')->where('email', 'john.doe@gmail.com')->first();
        $this->assertNotNull($row);
        $this->assertSame('203.0.113.10', $row->ip);
        $this->assertSame('PHPUnit UA', $row->user_agent);
    }

    /** @test */
    public function it_requires_mandatory_fields_and_consent()
    {
        $resp = $this->from('/contact')->post($this->contactUrl, [
            'name'    => '',
            'email'   => '',
            'message' => '',   // < 5 chars
            'consent' => null, // non coché
        ]);

        $resp->assertRedirect('/contact');
        $resp->assertSessionHasErrors(['name','email','message','consent']);
        $this->assertDatabaseCount('contact_messages', 0);
    }

    /** @test */
    public function it_rejects_invalid_email()
    {
        $resp = $this->from('/contact')->post($this->contactUrl, [
            'name'    => 'Jane',
            'email'   => 'not-an-email',
            'message' => 'Ceci est un message valide',
            'consent' => 'on',
        ]);

        $resp->assertRedirect('/contact');
        $resp->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('contact_messages', 0);
    }

    /** @test */
    public function it_requires_minimum_message_length()
    {
        $resp = $this->from('/contact')->post($this->contactUrl, [
            'name'    => 'Jane',
            'email'   => 'jane@example.com',
            'message' => 'Hey', // 3 chars < min:5
            'consent' => 'on',
        ]);

        $resp->assertRedirect('/contact');
        $resp->assertSessionHasErrors(['message']);
        $this->assertDatabaseCount('contact_messages', 0);
    }

    /** @test */
    public function it_accepts_field_aliases_from_front_variations()
    {
        // Alias : nom/mail/telephone/sujet (gérés dans ton contrôleur)
        $resp = $this->from('/contact')->post($this->contactUrl, [
            'nom'        => 'Bilal',
            'mail'       => 'bilal@example.com',
            'telephone'  => '04 00 00 00 00',
            'sujet'      => 'evenement',
            'message'    => 'On organise un anniversaire (20 pers).',
            'consent'    => '1',
        ]);

        $resp->assertRedirect('/contact');
        $resp->assertSessionHas('status', 'Merci, votre message a bien été envoyé !');

        $this->assertDatabaseHas('contact_messages', [
            'name'    => 'Bilal',
            'email'   => 'bilal@example.com',
            'phone'   => '04 00 00 00 00',
            'subject' => 'evenement',
            'status'  => 'new',
        ]);
    }
}
