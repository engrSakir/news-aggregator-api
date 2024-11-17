<?php

namespace App\Docs\V1\News;

/**
 * @OA\Get(
 *     path="/news/{id}",
 *     summary="Retrieve a specific news article",
 *     tags={"News"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the news article to retrieve.",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Specific news article retrieved successfully",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Article retrieved successfully."),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="Breaking News: AI Revolution"),
 *                 @OA\Property(property="category", type="string", example="technology"),
 *                 @OA\Property(property="author", type="string", example="John Doe"),
 *                 @OA\Property(property="published_at", type="string", format="datetime", example="2023-11-17 10:00:00"),
 *                 @OA\Property(property="keywords", type="string", example="AI, Machine Learning"),
 *                 @OA\Property(property="description", type="string", example="An in-depth look at how AI is transforming industries."),
 *                 @OA\Property(property="url", type="string", format="url", example="https://newswebsite.com/articles/1")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Article not found",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="Article not found."),
 *             @OA\Property(property="data", type="array", example={}, @OA\Items())
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
class ShowNewsDoc
{
}
