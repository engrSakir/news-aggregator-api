<?php

namespace App\Docs\V1\Auth;

/**
 * @OA\Post(
 *     path="/password/reset",
 *     summary="Reset the user's password",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "token", "password", "password_confirmation"},
 *             @OA\Property(property="email", type="string", format="email", example="user@example.com", description="User's email address."),
 *             @OA\Property(property="token", type="string", example="reset_token_example", description="The password reset token."),
 *             @OA\Property(property="password", type="string", format="password", example="newpassword123", description="New password (minimum 8 characters)."),
 *             @OA\Property(property="password_confirmation", type="string", format="password", example="newpassword123", description="Confirm the new password.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Password reset successful",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Password has been reset successfully."),
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
 *         description="User not found or token invalid",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="The reset token is invalid or user not found."),
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
 *                     @OA\Property(property="email", type="string", example="The email field is required."),
 *                     @OA\Property(property="token", type="string", example="The token field is required."),
 *                     @OA\Property(property="password", type="string", example="The password field is required."),
 *                     @OA\Property(property="password_confirmation", type="string", example="The password confirmation does not match.")
 *                 ),
 *                 example={
 *                     {"email": "The email field is required."},
 *                     {"token": "The token field is required."},
 *                     {"password": "The password field must be at least 8 characters."},
 *                     {"password_confirmation": "The password confirmation does not match."}
 *                 }
 *             )
 *         )
 *     )
 * )
 */
class PasswordResetDoc
{
}
