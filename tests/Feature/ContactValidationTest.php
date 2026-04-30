<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactValidationTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin()
    {
        $user = User::factory()->create();

        return $this->actingAs($user);
    }

    // Testes de STORE
    public function test_store_requires_name(): void
    {
        $this->actingAsAdmin()
            ->post(route('contacts.store'), [
                'name' => 'N',
                'contact' => '123456789',
                'email' => 'teste@teste.com',
            ])
            ->assertSessionHasErrors('name');
    }

    public function test_store_name_must_be_greather_than_5(): void
    {
        $this->actingAsAdmin()
            ->post(route('contacts.store'), [
                'name' => 'Nome', // Deve falhar
                'contact' => '123456789',
                'email' => 'teste@teste.com',
            ])
            ->assertSessionHasErrors('name');
    }

    public function test_store_contact_must_be_9_digits(): void
    {
        $this->actingAsAdmin()
            ->post(route('contacts.store'), [
                'name' => 'Nome Válido',
                'contact' => '1234', // Deve falhar pois a quantidade deve ser 9
                'email' => 'teste@teste.com',
            ])
            ->assertSessionHasErrors('contact');
        
        $this->actingAsAdmin()
            ->post(route('contacts.store'), [
                'name' => 'Nome Válido',
                'contact' => 'abcdefghi', // Deve falhar pois deve ser 9 dígitos
                'email' => 'teste@teste.com',
            ])
            ->assertSessionHasErrors('contact');
    }
    
    public function test_store_contact_must_be_unique(): void
    {
        Contact::factory()->create([
            'contact' => '123456789',
        ]);

        $this->actingAsAdmin()
            ->post(route('contacts.store'), [
                'name' => 'Outro Nome',
                'contact' => '123456789', // Deve falhar pois já existe
                'email' => 'teste@teste.com',
            ])
            ->assertSessionHasErrors('contact');
    }

    public function test_store_email_must_be_valid(): void
    {
        $this->actingAsAdmin()
            ->post(route('contacts.store'), [
                'name' => 'Nome Válido',
                'contact' => '123456789',
                'email' => 'emailinvalido', // Deve falhar pois é inválido
            ])
            ->assertSessionHasErrors('email');
    }

    public function test_store_email_must_be_unique(): void
    {
        Contact::factory()->create([
            'email' => 'duplicated@duplicated.com',
        ]);

        $this->actingAsAdmin()
            ->post(route('contacts.store'), [
                'name' => 'Outro Nome',
                'contact' => '987654321',
                'email' => 'duplicated@duplicated.com', // Deve falhar pois já existe
            ])
            ->assertSessionHasErrors('email');
    }

    // Testes de UPDATE
    public function test_update_requires_name(): void
    {        
        $contact = Contact::factory()->create([
            'name' => 'Nome Válido',
            'contact' => '123456789',
            'email' => 'teste@teste.com'
        ]);

        $this->actingAsAdmin()
            ->put(route('contacts.update', $contact), [
                // Deve falhar pois requer name
                'contact' => '987654321',
                'email' => 'testex@testex.com'
            ])
            ->assertSessionHasErrors('name');
    }

    public function test_update_name_must_be_greather_than_5(): void
    {        
        $contact = Contact::factory()->create([
            'name' => 'Nome Válido',
            'contact' => '123456789',
            'email' => 'teste@teste.com'
        ]);

        $this->actingAsAdmin()
            ->put(route('contacts.update', $contact), [
                'name' => 'Nome', // Deve falhar pois é menor que 5 caracteres             
                'contact' => '123456789', // Igual
                'email' => 'teste@teste.com' // Igual
            ])
            ->assertSessionHasErrors('name');
    }

    public function test_update_contact_must_be_9_digits(): void
    {
        $contact = Contact::factory()->create([
            'name' => 'Nome Válido',
            'contact' => '123456789',
            'email' => 'teste@teste.com'
        ]);

        $this->actingAsAdmin()
            ->put(route('contacts.update', $contact), [
                'name' => 'Nome Válido',              
                'contact' => '1234', // Deve falhar pois é menor que 9 caracteres
                'email' => 'teste@teste.com'
            ])
            ->assertSessionHasErrors('contact');
        
        $this->actingAsAdmin()
            ->put(route('contacts.update', $contact), [
                'name' => 'Nome Válido',              
                'contact' => 'abcdefghi', // Deve falhar pois deve ser 9 dígitos
                'email' => 'teste@teste.com'
            ])
            ->assertSessionHasErrors('contact');
    }

    public function test_update_contact_must_be_valid(): void
    {    
        $contact = Contact::factory()->create();

        $this->actingAsAdmin()
            ->put(route('contacts.update', $contact), [
                'name' => 'Outro Nome',
                'contact' => 'abcdefghi', // Deve falhar pois o contato deve ser válido
                'email' => 'teste@teste.com',
            ])
            ->assertSessionHasErrors('contact');
    }

    public function test_update_contact_must_be_unique(): void
    {    
        Contact::factory()->create([
            'contact' => '123456789',
        ]);

        $contact = Contact::factory()->create([
            'contact' => '987654321',
        ]);

        $this->actingAsAdmin()
            ->put(route('contacts.update', $contact), [
                'name' => 'Outro Nome',
                'contact' => '123456789', // Deve falhar pois o contato já existe
                'email' => 'teste@teste.com',
            ])
            ->assertSessionHasErrors('contact');
    }

    public function test_update_email_must_be_valid(): void
    {    
        $contact = Contact::factory()->create();

        $this->actingAsAdmin()
            ->put(route('contacts.update', $contact), [
                'name' => 'Outro Nome',
                'contact' => '123456789',
                'email' => 'emailinvalido', // Deve falhar pois o email deve ser válido
            ])
            ->assertSessionHasErrors('email');
    }

    public function test_update_email_must_be_unique(): void
    {    
        Contact::factory()->create([
            'email' => 'teste1@teste.com',
        ]);

        $contact = Contact::factory()->create([
            'email' => 'teste2@teste.com',
        ]);

        $this->actingAsAdmin()
            ->put(route('contacts.update', $contact), [
                'name' => 'Outro Nome',
                'contact' => '123456789',
                'email' => 'teste1@teste.com', // Deve falhar pois o email já existe
            ])
            ->assertSessionHasErrors('email');
    }
}
