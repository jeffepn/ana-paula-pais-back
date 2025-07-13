<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\JsonApi\ContactResource;
use App\Services\ContactService;
use App\Utility\MessageUtil;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    private ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @OA\Post(
     *     path="/contacts",
     *     summary="Enviar mensagem de contato",
     *     description="Endpoint para enviar uma mensagem de contato através do sistema",
     *     operationId="sendContact",
     *     tags={"Contato"},
     * @OA\RequestBody(
     *         required=true,
     * @OA\JsonContent(
     *             required={"name", "email", "message"},
     * @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 maxLength=50,
     *                 example="João Silva"
     *             ),
     * @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 maxLength=300,
     *                 example="joao.silva@exemplo.com"
     *             ),
     * @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 maxLength=20,
     *                 example="(11) 99999-9999"
     *             ),
     * @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 maxLength=300,
     *                 example="Gostaria de mais informações sobre o imóvel"
     *             ),
     * @OA\Property(
     *                 property="terms_accept",
     *                 type="boolean",
     *                 example=true,
     *                 description="Confirmação de aceite dos termos de uso e política de privacidade"
     *             ),
     * @OA\Property(
     *                 property="recaptchaToken",
     *                 type="string",
     *                 example="03AFcWeA5X...",
     *                 description="Token do Google reCAPTCHA v3 para validação de segurança"
     *             )
     *         )
     *     ),
     * @OA\Response(
     *         response=202,
     *         description="Mensagem enviada com sucesso",
     * @OA\JsonContent(
     * @OA\Property(
     *                 property="data",
     *                 type="object",
     * @OA\Property(property="type",    type="string", enum={"contacts"}),
     * @OA\Property(
     *                     property="attributes",
     *                     type="object",
     * @OA\Property(property="name",    type="string", example="João Silva"),
     * @OA\Property(property="email",   type="string", example="joao.silva@exemplo.com"),
     * @OA\Property(property="phone",   type="string", example="(11) 99999-9999"),
     * @OA\Property(property="message", type="string", example="Gostaria de mais informações sobre o imóvel")
     *                 )
     *             ),
     * @OA\Property(
     *                 property="meta",
     *                 type="object",
     * @OA\Property(property="message", type="string", example="Em breve retornaremos seu contato.")
     *             )
     *         )
     *     ),
     * @OA\Response(
     *         response=400,
     *         description="Erro na validação do reCAPTCHA",
     * @OA\JsonContent(
     * @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Falha ao verificar o recaptcha."
     *             ),
     * @OA\Property(
     *                 property="errors",
     *                 type="object"
     *             )
     *         )
     *     ),
     * @OA\Response(
     *         response=422,
     *         description="Erro de validação",
     * @OA\JsonContent(
     * @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Os dados fornecidos são inválidos."
     *             ),
     * @OA\Property(
     *                 property="errors",
     *                 type="object",
     * @OA\Property(
     *                     property="name",
     *                     type="array",
     * @OA\Items(type="string",         example="Como podemos te chamar")
     *                 ),
     * @OA\Property(
     *                     property="email",
     *                     type="array",
     * @OA\Items(type="string",         example="Precisamos saber seu e-mail, para que possamos entrar em contato.")
     *                 ),
     * @OA\Property(
     *                     property="message",
     *                     type="array",
     * @OA\Items(type="string",         example="Descreva em poucas palavras: sua dúvida, mensagem ou sugestão.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $recaptchaToken = $request->input('recaptchaToken');

        $recaptchaResponse = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $recaptchaToken,
            ]
        );

        if (!$recaptchaResponse->successful() || $recaptchaResponse->json('score') < config('services.recaptcha.score_threshold')) {
            return response()->json(
                [
                    'message' => 'Falha ao verificar o recaptcha.',
                    'errors' => [],
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ];

        $this->contactService->send($data);

        return response()->json(
            [
                'data' => new ContactResource($data),
                'meta' => [
                    'message' => MessageUtil::success('ContactSuccess'),
                ],
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
