<?php

namespace App\Docs\V1\News;


/**
 * @OA\Get(
 *     path="/news",
 *     summary="Retrieve a list of news articles",
 *     tags={"News"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="preference",
 *         in="query",
 *         required=false,
 *         description="User preferences to filter articles (0/1).",
 *         @OA\Schema(type="integer", example="0")
 *     ),
 *     @OA\Parameter(
 *         name="keyword",
 *         in="query",
 *         required=false,
 *         description="Keyword to search within article keywords.",
 *         @OA\Schema(type="string", example="Jarosz")
 *     ),
 *     @OA\Parameter(
 *         name="date",
 *         in="query",
 *         required=false,
 *         description="Date to filter articles by their publication date.",
 *         @OA\Schema(type="string", format="date", example="2024-01-24")
 *     ),
 *     @OA\Parameter(
 *         name="category",
 *         in="query",
 *         required=false,
 *         description="Category to filter articles.",
 *         @OA\Schema(type="string", example="Business")
 *     ),
 *     @OA\Parameter(
 *         name="source",
 *         in="query",
 *         required=false,
 *         description="Source to filter articles (News API, The New York Times, The Guardian).",
 *         @OA\Schema(type="string", example="News API")
 *     ),
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         required=false,
 *         description="Number of articles per page. (Maximum 50)",
 *         @OA\Schema(type="integer", example=10)
 *     ),
 *     @OA\Parameter(
 *          name="page",
 *          in="query",
 *          required=false,
 *          description="Number of page.",
 *          @OA\Schema(type="integer", example=1)
 *      ),
 *     @OA\Response(
 *         response=200,
 *         description="List of news articles",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="message", type="string", example="Articles retrieved successfully."),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="title", type="string", example="Breaking News: AI Revolution"),
 *                     @OA\Property(property="category", type="string", example="technology"),
 *                     @OA\Property(property="author", type="string", example="John Doe"),
 *                     @OA\Property(property="published_at", type="string", format="datetime", example="2023-11-17 10:00:00"),
 *                     @OA\Property(property="keywords", type="string", example="AI, Machine Learning"),
 *                     @OA\Property(property="description", type="string", example="An in-depth look at how AI is transforming industries."),
 *                     @OA\Property(property="url", type="string", format="url", example="https://newswebsite.com/articles/1")
 *                 )
 *             ),
 *             @OA\Property(property="pagination", type="object",
 *                 @OA\Property(property="total", type="integer", example=50),
 *                 @OA\Property(property="per_page", type="integer", example=10),
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="last_page", type="integer", example=5),
 *                 @OA\Property(property="next_page_url", type="string", format="url", example="https://api.newsaggregator.com/news?page=2")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid request",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="failed"),
 *             @OA\Property(property="message", type="string", example="Invalid request parameters."),
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
class GetNewsDoc
{
}
