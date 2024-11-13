<?php

namespace App\DTOs\News\V1;
class ArticleDTO
{
    public function __construct(
        public string $title,
        public ?string $description,
        public string $url,
        public string $source,
        public \DateTime $published_at
    ) {}
}
