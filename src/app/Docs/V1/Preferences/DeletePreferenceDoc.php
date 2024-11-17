<?php

namespace App\Docs\V1\Preferences;

use OpenApi\Annotations as OA;

/**
 * @OA\Delete(
 *     path="/preferences/{id}",
 *     summary="Delete a specific preference",
 *     tags={"Preferences"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the preference to delete.",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Preference deleted successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Preference deleted successfully."),
 *             @OA\Property(property="data", type="array", example={}, @OA\Items())
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
class DeletePreferenceDoc
{
}
