<?php

namespace App\Docs\V1\Preferences;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/preferences",
 *     summary="Create a new preference",
 *     tags={"Preferences"},
 *     security={{"bearerAuth": {}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"type", "value"},
 *             @OA\Property(property="type", type="string", example="category", description="The type of the preference."),
 *             @OA\Property(property="value", type="string", example="technology", description="The value of the preference.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Preference created successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Preference created successfully."),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="type", type="string", example="category"),
 *                 @OA\Property(property="value", type="string", example="technology")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="type", type="string", example="The type field is required."),
 *                     @OA\Property(property="value", type="string", example="The value field is required.")
 *                 )
 *             )
 *         )
 *     )
 * )
 */
class StorePreferenceDoc
{
}
