<?php

namespace App\Docs\V1\Auth;

/**
 * @OA\Post(
 *     path="/logout",
 *     summary="Log out the authenticated user",
 *     tags={"Authentication"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful logout",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Logged out successfully."),
 *             @OA\Property(property="data", type="null", example=null)
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - Invalid or missing Bearer Token",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="User is not authenticated."),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 example={},
 *                 @OA\Items()
 *             )
 *         )
 *     )
 * )
 */
class LogoutDoc
{
}
