<?php

namespace App\Docs\V1;

/**
 * @OA\Info(
 *     title="News Aggregator API - V1",
 *     version="1.0.0",
 *     description="API documentation for version 1 of the News Aggregator system.",
 *     @OA\Contact(
 *         email="support@newsaggregator.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8101/api/v1",
 *     description="Version 1 - Local development server"
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      description="Use the Bearer token provided by Sanctum to authenticate requests."
 *  )
 *
 * @OA\Tag(
 *     name="Authentication",
 *     description="Endpoints related to user authentication"
 * )
 *
 * @OA\Tag(
 *     name="News",
 *     description="Endpoints related to news articles"
 * )
 *
 */
class OpenApiInfo
{
}
