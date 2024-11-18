<?php

namespace App\Repositories\News\V1;

interface ArticleRepositoryInterface
{
    public function getAll(array $requestData);
}
