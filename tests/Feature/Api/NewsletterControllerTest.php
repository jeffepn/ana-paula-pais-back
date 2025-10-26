<?php

namespace Tests\Feature\Api;

use App\Models\Site\Newsletter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class NewsletterControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_create_a_newsletter_subscription()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'terms_accept' => true,
            'recaptchaToken' => 'valid-token',
        ];

        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'score' => 0.8,
            ], 200),
        ]);

        $response = $this->postJson('/api/newsletters', $data);

        $newsletter = Newsletter::first();
        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'name',
                        'email',
                        'created_at',
                    ],
                ],
                'meta' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => [
                    'type' => 'newsletters',
                    'attributes' => [
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'created_at' => $newsletter->created_at->toIsoString(),
                    ],
                ],
                'meta' => [
                    'message' => 'Você agora receberá  nossos boletos informativos.',
                ],
            ]);

        $this->assertDatabaseHas('newsletters', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->postJson('/api/newsletters', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'name' => ['Como podemos te chamar'],
                    'email' => ['Precisamos do seu e-mail para te manter informado'],
                    'terms_accept' => ['É necessário aceitar os termos de uso e política de privacidade.'],
                    'recaptchaToken' => ['Token de verificação é obrigatório.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_terms_accept()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'terms_accept' => false,
            'recaptchaToken' => 'valid-token',
        ];

        $response = $this->postJson('/api/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'terms_accept' => ['É necessário aceitar os termos de uso e política de privacidade.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_recaptcha_score()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'terms_accept' => true,
            'recaptchaToken' => 'invalid-token',
        ];

        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'score' => 0.3,
            ], 200),
        ]);

        $response = $this->postJson('/api/newsletters', $data);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'message' => 'Falha ao verificar o recaptcha.',
                'errors' => [],
            ]);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => 'invalid-email',
        ];

        $response = $this->postJson('/api/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.email.0', 'Formato de e-mail inválido.')
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'email' => ['Formato de e-mail inválido.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_unique_email()
    {
        $email = $this->faker->email;
        Newsletter::create([
            'name' => $this->faker->name,
            'email' => $email,
        ]);

        $data = [
            'name' => $this->faker->name,
            'email' => $email,
        ];

        $response = $this->postJson('/api/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.email.0', 'Você já está cadastrado em nossa Newsletter.')
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'email' => ['Você já está cadastrado em nossa Newsletter.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_name_length()
    {
        $data = [
            'name' => str_repeat('a', 51),
            'email' => $this->faker->email,
        ];

        $response = $this->postJson('/api/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.name.0', 'Que nome grande hein... Limite ele a 50 caracteres.')
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'name' => ['Que nome grande hein... Limite ele a 50 caracteres.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_email_length()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => str_repeat('a', 301) . '@example.com',
        ];

        $response = $this->postJson('/api/newsletters', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonPath('errors.email.0', 'Limite o campo a 300 caracteres.')
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'email' => ['Limite o campo a 300 caracteres.'],
                ],
            ]);
    }
}
