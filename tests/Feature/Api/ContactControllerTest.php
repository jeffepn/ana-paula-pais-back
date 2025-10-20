<?php

namespace Tests\Feature\Api;

use App\Jobs\Contact\ContactJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_send_a_contact_message()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->paragraph,
            'terms_accept' => true,
            'recaptchaToken' => 'valid-token',
        ];

        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'score' => 0.8,
            ], 200),
        ]);

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(status: Response::HTTP_ACCEPTED)
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'attributes' => [
                        'name',
                        'email',
                        'phone',
                        'message',
                    ],
                ],
                'meta' => [
                    'message',
                ],
            ])
            ->assertJson([
                'data' => [
                    'attributes' => [
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'message' => $data['message'],
                    ],
                ],
                'meta' => [
                    'message' => 'Em breve retornaremos seu contato.',
                ],
            ]);

        Queue::assertPushed(ContactJob::class, function ($job) use ($data) {
            return $job->content['name'] === $data['name'] &&
                $job->content['email'] === $data['email'] &&
                $job->content['phone'] === $data['phone'] &&
                $job->content['message'] === $data['message'];
        });
    }

    /** @test */
    public function it_validates_required_fields()
    {
        $response = $this->postJson('/api/contacts', []);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'name' => ['Como podemos te chamar'],
                    'email' => ['Precisamos saber seu e-mail, para que possamos entrar em contato.'],
                    'message' => ['Descreva em poucas palavras: sua dúvida, mensagem ou sugestão.'],
                    'terms_accept' => ['É necessário aceitar os termos de uso e política de privacidade.'],
                    'recaptchaToken' => ['Token de verificação é obrigatório.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_email_format()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => 'invalid-email',
            'message' => $this->faker->paragraph,
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'email' => ['Formato de e-mail inválido.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_name_length()
    {
        $data = [
            'name' => str_repeat('a', 51),
            'email' => $this->faker->email,
            'message' => $this->faker->paragraph,
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
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
            'message' => $this->faker->paragraph,
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'email' => ['Limite o campo a 300 caracteres.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_message_length()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => str_repeat('a', 301),
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'message' => ['Limite o campo a 300 caracteres.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_phone_length()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => str_repeat('1', 21),
            'message' => $this->faker->paragraph,
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'phone' => ['Limite o campo a 20 caracteres.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_terms_accept()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->paragraph,
            'terms_accept' => false,
            'recaptchaToken' => 'valid-token',
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'terms_accept' => ['É necessário aceitar os termos de uso e política de privacidade.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_recaptcha_token()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->paragraph,
            'terms_accept' => true,
            'recaptchaToken' => '',
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'Os dados fornecidos são inválidos.',
                'errors' => [
                    'recaptchaToken' => ['Token de verificação é obrigatório.'],
                ],
            ]);
    }

    /** @test */
    public function it_validates_recaptcha_score()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'message' => $this->faker->paragraph,
            'terms_accept' => true,
            'recaptchaToken' => 'invalid-token',
        ];

        Http::fake([
            'https://www.google.com/recaptcha/api/siteverify' => Http::response([
                'success' => true,
                'score' => 0.3,
            ], 200),
        ]);

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'message' => 'Falha ao verificar o recaptcha.',
                'errors' => [],
            ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Queue::fake();
    }
}
