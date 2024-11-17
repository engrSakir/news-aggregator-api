<?php

namespace App\Docs\V1\Auth;

/**
 * @OA\Post(
 *     path="/login",
 *     summary="Log in a user",
 *     tags={"Authentication"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *             @OA\Property(property="email", type="string", format="email", example="user1@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="secret")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful login",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Logged in successfully."),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="access_token", type="string", example="5|aD4EQmKGlyJIHQ0IZWGWzPuLNPdvJcAOVQFgCjd06401925f"),
 *                 @OA\Property(property="token_type", type="string", example="Bearer")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Invalid credentials",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="The provided credentials are incorrect."),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(type="string", nullable=true, example=null),
 *                 example={}
 *             )
 *         )
 *     )
 * )
 */
class LoginDoc
{
}
