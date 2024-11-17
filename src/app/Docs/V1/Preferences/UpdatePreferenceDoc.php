<?php

namespace App\Docs\V1\Preferences;

use OpenApi\Annotations as OA;

/**
 * @OA\Put(
 *     path="/preferences/{id}",
 *     summary="Update a specific preference",
 *     tags={"Preferences"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the preference to update.",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"type", "value"},
 *             @OA\Property(property="type", type="string", example="category", description="The updated type of the preference."),
 *             @OA\Property(property="value", type="string", example="science", description="The updated value of the preference.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Preference updated successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Preference updated successfully."),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="type", type="string", example="category"),
 *                 @OA\Property(property="value", type="string", example="science")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Preference not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="Preference not found."),
 *             @OA\Property(property="data", type="array", example={}, @OA\Items())
 *         )
 *     )
 * )
 */
class UpdatePreferenceDoc
{
}
