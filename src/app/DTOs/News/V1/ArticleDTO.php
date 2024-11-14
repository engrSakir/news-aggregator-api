<?php

namespace App\DTOs\News\V1;
class ArticleDTO
{
    public function __construct(
        public string $title,
        public ?string $description,
        public string $url,
        public string $source,
        public string $published_at
    ) {}

    public function arrayData(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'source' => $this->source,
            'published_at' => $this->published_at,
        ];
    }
}
