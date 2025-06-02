<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterRequest;
use App\Http\Resources\JsonApi\NewsletterResource;
use App\Services\NewsletterService;
use App\Utility\MessageUtil;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{
    private NewsletterService $newsletterService;

    public function __construct(NewsletterService $newsletterService)
    {
        $this->newsletterService = $newsletterService;
    }

    /**
     * @OA\Post(
     *     path="/newsletters",
     *     summary="Criar nova inscrição na newsletter",
     *     description="Endpoint para criar uma nova inscrição na newsletter do sistema",
     *     operationId="createNewsletter",
     *     tags={"Newsletter"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 maxLength=50,
     *                 example="João Silva"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 maxLength=300,
     *                 example="joao.silva@exemplo.com"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Inscrição criada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="type", type="string", enum={"newsletters"}),
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(
     *                     property="attributes",
     *                     type="object",
     *                     @OA\Property(property="name", type="string", example="João Silva"),
     *                     @OA\Property(property="email", type="string", example="joao.silva@exemplo.com"),
     *                     @OA\Property(property="created_at", type="string", format="date-time")
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(property="message", type="string", example="Inscrição realizada com sucesso!")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Os dados fornecidos são inválidos."
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     type="array",
     *                     @OA\Items(type="string", example="Como podemos te chamar")
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="array",
     *                     @OA\Items(type="string", example="Precisamos do seu e-mail para te manter informado")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(NewsletterRequest $request): JsonResponse
    {
        $newsletter = $this->newsletterService->create([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        return response()->json([
            'data' => new NewsletterResource($newsletter),
            'meta' => [
                'message' => MessageUtil::success('NewsletterSuccess')
            ]
        ], Response::HTTP_CREATED);
    }
}