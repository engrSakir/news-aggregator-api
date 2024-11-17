<?php

namespace App\Docs\V1\Auth;

/**
 * @OA\Post(
 *     path="/password/email",
 *     summary="Send password reset email",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email"},
 *             @OA\Property(property="email", type="string", format="email", example="user1@example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Password reset email sent successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Password reset link sent"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 example={},
 *                 @OA\Items()
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="User not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="We couldn't find a user with that email address."),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 example={},
 *                 @OA\Items()
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
 *                     @OA\Property(property="email", type="string", example="The email field is required.")
 *                 ),
 *                 example={
 *                     {"email": "The email field is required."}
 *                 }
 *             )
 *         )
 *     )
 * )
 */
class PasswordResetEmailDoc
{
}
