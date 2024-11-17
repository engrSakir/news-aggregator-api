<?php

namespace App\Docs\V1\Auth;

/**
 * @OA\Post(
 *     path="/register",
 *     summary="Register a new user",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password", "password_confirmation"},
 *             @OA\Property(property="name", type="string", maxLength=255, example="John Doe", description="Full name of the user."),
 *             @OA\Property(property="email", type="string", format="email", maxLength=255, example="user@example.com", description="User's email address. Must be unique."),
 *             @OA\Property(property="password", type="string", format="password", minLength=8, example="password123", description="User's password (minimum 8 characters)."),
 *             @OA\Property(property="password_confirmation", type="string", format="password", example="password123", description="Confirmation of the password.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="User registered successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="User registered successfully."),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1, description="User ID."),
 *                 @OA\Property(property="name", type="string", example="John Doe", description="Full name of the user."),
 *                 @OA\Property(property="email", type="string", format="email", example="user@example.com", description="User's email address.")
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
 *                     @OA\Property(property="name", type="string", example="The name field is required."),
 *                     @OA\Property(property="email", type="string", example="The email field is required."),
 *                     @OA\Property(property="password", type="string", example="The password field must be at least 8 characters."),
 *                     @OA\Property(property="password_confirmation", type="string", example="The password confirmation does not match.")
 *                 ),
 *                 example={
 *                     {"name": "The name field is required."},
 *                     {"email": "The email field must be unique."},
 *                     {"password": "The password field must be at least 8 characters."},
 *                     {"password_confirmation": "The password confirmation does not match."}
 *                 }
 *             )
 *         )
 *     )
 * )
 */
class RegisterDoc
{
}
