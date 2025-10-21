<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonApi\JsonApiPaginatedResponse;
use App\Http\Resources\PropertyResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Jeffpereira\RealEstate\Models\Property\Property;

/**
 * @OA\Get(
 *     path="/properties/launchs",
 *     summary="Listar propriedades em lançamento",
 *     description="Endpoint para listar propriedades cuja situação seja 'LANÇAMENTO'",
 *     operationId="getLaunchProperties",
 *     tags={"Propriedades"},
 *     @OA\Parameter(
 *         name="size",
 *         in="query",
 *         description="Quantidade de itens por página",
 *         required=false,
 *         @OA\Schema(type="integer", minimum=1, maximum=100)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Lista de propriedades em lançamento",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="type", type="string", enum={"properties"}),
 *                     @OA\Property(property="id", type="string", format="uuid"),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(property="code", type="integer"),
 *                         @OA\Property(property="slug", type="string"),
 *                         @OA\Property(property="min_description", type="string"),
 *                         @OA\Property(property="content", type="string"),
 *                         @OA\Property(property="items", type="string"),
 *                         @OA\Property(property="building_area", type="number"),
 *                         @OA\Property(property="total_area", type="number"),
 *                         @OA\Property(property="useful_area", type="number"),
 *                         @OA\Property(property="ground_area", type="number"),
 *                         @OA\Property(property="min_dormitory", type="integer"),
 *                         @OA\Property(property="max_dormitory", type="integer"),
 *                         @OA\Property(property="min_bathroom", type="integer"),
 *                         @OA\Property(property="max_bathroom", type="integer"),
 *                         @OA\Property(property="min_suite", type="integer"),
 *                         @OA\Property(property="max_suite", type="integer"),
 *                         @OA\Property(property="min_garage", type="integer"),
 *                         @OA\Property(property="max_garage", type="integer"),
 *                         @OA\Property(property="min_restroom", type="integer"),
 *                         @OA\Property(property="max_restroom", type="integer"),
 *                         @OA\Property(property="embed", type="string"),
 *                         @OA\Property(property="has_plate", type="boolean"),
 *                         @OA\Property(property="active", type="boolean"),
 *                         @OA\Property(property="created_at", type="string", format="date-time"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time")
 *                     ),
 *                     @OA\Property(
 *                         property="relationships",
 *                         type="object",
 *                         @OA\Property(
 *                             property="businesses",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="array",
 *                                 @OA\Items(
 *                                     type="object",
 *                                     @OA\Property(property="type", type="string", enum={"businesses"}),
 *                                     @OA\Property(property="id", type="string", format="uuid")
 *                                 )
 *                             )
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="object",
 *                                 @OA\Property(property="type", type="string", enum={"types"}),
 *                                 @OA\Property(property="id", type="string", format="uuid")
 *                             )
 *                         ),
 *                         @OA\Property(
 *                             property="sub_type",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="object",
 *                                 @OA\Property(property="type", type="string", enum={"sub_types"}),
 *                                 @OA\Property(property="id", type="string", format="uuid")
 *                             )
 *                         ),
 *                         @OA\Property(
 *                             property="address",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="object",
 *                                 @OA\Property(property="type", type="string", enum={"addresses"}),
 *                                 @OA\Property(property="id", type="string", format="uuid")
 *                             )
 *                         ),
 *                         @OA\Property(
 *                             property="neighborhood",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="object",
 *                                 @OA\Property(property="type", type="string", enum={"neighborhoods"}),
 *                                 @OA\Property(property="id", type="string", format="uuid")
 *                             )
 *                         ),
 *                         @OA\Property(
 *                             property="city",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="object",
 *                                 @OA\Property(property="type", type="string", enum={"cities"}),
 *                                 @OA\Property(property="id", type="string", format="uuid")
 *                             )
 *                         ),
 *                         @OA\Property(
 *                             property="state",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="object",
 *                                 @OA\Property(property="type", type="string", enum={"states"}),
 *                                 @OA\Property(property="id", type="string", format="uuid")
 *                             )
 *                         ),
 *                         @OA\Property(
 *                             property="images",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="array",
 *                                 @OA\Items(
 *                                     type="object",
 *                                     @OA\Property(property="type", type="string", enum={"images"}),
 *                                     @OA\Property(property="id", type="string", format="uuid")
 *                                 )
 *                             )
 *                         )
 *                     )
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="included",
 *                 type="array",
 *                 @OA\Items(
 *                     oneOf={
 *                         @OA\Schema(
 *                             type="object",
 *                             @OA\Property(property="type", type="string", enum={"businesses"}),
 *                             @OA\Property(property="id", type="string", format="uuid"),
 *                             @OA\Property(
 *                                 property="attributes",
 *                                 type="object",
 *                                 @OA\Property(property="name", type="string"),
 *                                 @OA\Property(property="name_completed", type="string"),
 *                                 @OA\Property(property="value", type="number"),
 *                                 @OA\Property(property="old_value", type="number"),
 *                                 @OA\Property(property="status", type="boolean"),
 *                                 @OA\Property(property="status_situation", type="integer")
 *                             )
 *                         ),
 *                         @OA\Schema(
 *                             type="object",
 *                             @OA\Property(property="type", type="string", enum={"types"}),
 *                             @OA\Property(property="id", type="string", format="uuid"),
 *                             @OA\Property(
 *                                 property="attributes",
 *                                 type="object",
 *                                 @OA\Property(property="name", type="string"),
 *                                 @OA\Property(property="slug", type="string")
 *                             )
 *                         ),
 *                         @OA\Schema(
 *                             type="object",
 *                             @OA\Property(property="type", type="string", enum={"sub_types"}),
 *                             @OA\Property(property="id", type="string", format="uuid"),
 *                             @OA\Property(
 *                                 property="attributes",
 *                                 type="object",
 *                                 @OA\Property(property="name", type="string"),
 *                                 @OA\Property(property="slug", type="string")
 *                             )
 *                         ),
 *                         @OA\Schema(
 *                             type="object",
 *                             @OA\Property(property="type", type="string", enum={"addresses"}),
 *                             @OA\Property(property="id", type="string", format="uuid"),
 *                             @OA\Property(
 *                                 property="attributes",
 *                                 type="object",
 *                                 @OA\Property(property="address", type="string"),
 *                                 @OA\Property(property="number", type="integer"),
 *                                 @OA\Property(property="not_number", type="boolean"),
 *                                 @OA\Property(property="complement", type="string"),
 *                                 @OA\Property(property="cep", type="string"),
 *                                 @OA\Property(property="longitude", type="integer"),
 *                                 @OA\Property(property="latitude", type="integer")
 *                             )
 *                         ),
 *                         @OA\Schema(
 *                             type="object",
 *                             @OA\Property(property="type", type="string", enum={"neighborhoods"}),
 *                             @OA\Property(property="id", type="string", format="uuid"),
 *                             @OA\Property(
 *                                 property="attributes",
 *                                 type="object",
 *                                 @OA\Property(property="name", type="string"),
 *                                 @OA\Property(property="slug", type="string")
 *                             )
 *                         ),
 *                         @OA\Schema(
 *                             type="object",
 *                             @OA\Property(property="type", type="string", enum={"cities"}),
 *                             @OA\Property(property="id", type="string", format="uuid"),
 *                             @OA\Property(
 *                                 property="attributes",
 *                                 type="object",
 *                                 @OA\Property(property="name", type="string"),
 *                                 @OA\Property(property="slug", type="string")
 *                             )
 *                         ),
 *                         @OA\Schema(
 *                             type="object",
 *                             @OA\Property(property="type", type="string", enum={"states"}),
 *                             @OA\Property(property="id", type="string", format="uuid"),
 *                             @OA\Property(
 *                                 property="attributes",
 *                                 type="object",
 *                                 @OA\Property(property="name", type="string"),
 *                                 @OA\Property(property="slug", type="string"),
 *                                 @OA\Property(property="initials", type="string")
 *                             )
 *                         ),
 *                         @OA\Schema(
 *                             type="object",
 *                             @OA\Property(property="type", type="string", enum={"images"}),
 *                             @OA\Property(property="id", type="string", format="uuid"),
 *                             @OA\Property(
 *                                 property="attributes",
 *                                 type="object",
 *                                 @OA\Property(property="url", type="string"),
 *                                 @OA\Property(property="thumbnail", type="string"),
 *                                 @OA\Property(property="alt", type="string"),
 *                                 @OA\Property(property="order", type="integer")
 *                             )
 *                         )
 *                     }
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="meta",
 *                 type="object",
 *                 @OA\Property(property="total", type="integer"),
 *                 @OA\Property(property="current_page", type="integer"),
 *                 @OA\Property(property="per_page", type="integer"),
 *                 @OA\Property(property="last_page", type="integer")
 *             ),
 *             @OA\Property(
 *                 property="links",
 *                 type="object",
 *                 @OA\Property(property="first", type="string"),
 *                 @OA\Property(property="last", type="string"),
 *                 @OA\Property(property="prev", type="string", nullable=true),
 *                 @OA\Property(property="next", type="string", nullable=true)
 *             )
 *         )
 *     )
 * )
 */
class PropertyLaunchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'size' => 'nullable|integer|min:1|max:100',
        ]);

        $perPage = $request->input('size', 15);

        $properties = Property::select('properties.*')
            ->join('situations', 'properties.situation_id', 'situations.id')
            ->where('situations.name', 'LANÇAMENTO')
            ->whereActive(true)
            ->orderBy('properties.created_at', 'desc')
            ->with([
                'images',
                'address.neighborhood.city.state',
                'sub_type.type',
                'businesses',
            ])
            ->paginate($perPage);

        return response()->json(new JsonApiPaginatedResponse($properties, PropertyResource::class));
    }
}
