<?php

namespace Tests\Feature\Api;

use App\Models\Site\Newsletter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class NewsletterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_can_create_a_newsletter_subscription()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email
        ];

        $response = $this->postJson('/api/v1/newsletters', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'name',
                        'email',
                        'created_at'
                    ]
                ],
                'meta' => [
                    'message'
                ]
            ]);

        $this->assertDatabaseHas('newsletters', [
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->postJson('/api/v1/newsletters', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => ['name', 'email']
            ])
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'name' => ['Como podemos te chamar'],
                    'email' => ['Precisamos do seu e-mail para te manter informado'],
                ]
            ]);
        ;
    }

    /** @test */
    public function it_validates_email_format()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => 'invalid-email'
        ];

        $response = $this->postJson('/api/v1/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.email.0', 'Formato de e-mail inválido.')
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'email' => ['Formato de e-mail inválido.']
                ]
            ]);
    }

    /** @test */
    public function it_validates_unique_email()
    {
        $email = $this->faker->email;
        Newsletter::create([
            'name' => $this->faker->name,
            'email' => $email
        ]);

        $data = [
            'name' => $this->faker->name,
            'email' => $email
        ];

        $response = $this->postJson('/api/v1/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.email.0', 'Você já está cadastrado em nossa Newsletter.')
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'email' => ['Você já está cadastrado em nossa Newsletter.']
                ]
            ]);
    }

    /** @test */
    public function it_validates_name_length()
    {
        $data = [
            'name' => str_repeat('a', 51),
            'email' => $this->faker->email
        ];

        $response = $this->postJson('/api/v1/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.name.0', 'Que nome grande hein... Limite ele a 50 caracteres.')
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'name' => ['Que nome grande hein... Limite ele a 50 caracteres.']
                ]
            ]);
    }

    /** @test */
    public function it_validates_email_length()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => str_repeat('a', 301) . '@example.com'
        ];

        $response = $this->postJson('/api/v1/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.email.0', 'Limite o campo a 300 caracteres.')
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'email' => ['Limite o campo a 300 caracteres.']
                ]
            ]);
    }
}