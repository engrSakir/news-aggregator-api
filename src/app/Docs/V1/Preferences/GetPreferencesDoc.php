<?php

namespace App\Docs\V1\Preferences;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/preferences",
 *     summary="Retrieve a list of preferences",
 *     tags={"Preferences"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of preferences retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Preferences retrieved successfully."),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="type", type="string", example="category"),
 *                     @OA\Property(property="value", type="string", example="technology")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - Missing or invalid Bearer token",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="Unauthorized access."),
 *             @OA\Property(property="data", type="array", example={}, @OA\Items())
 *         )
 *     )
 * )
 */
class GetPreferencesDoc
{
}
