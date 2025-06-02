<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API de Imóveis",
 *     description="API para gerenciamento de imóveis e contatos",
 *     @OA\Contact(
 *         email="suporte@exemplo.com",
 *         name="Suporte"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="/api/v1",
 *     description="Servidor de Produção"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
