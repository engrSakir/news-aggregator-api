<?php

namespace App\DTOs\News\V1;
class ArticleDTO
{
    public function __construct(
        public string $source,
        public string $category,
        public string $author,
        public string $published_at,
        public string $keywords,
        public string $title,
        public ?string $description,
        public string $url,
    ) {}

    /**
     * @return array
     */
    public function arrayData(): array
    {
        return [
            'source' => $this->source,
            'category' => $this->category,
            'author' => $this->author,
            'published_at' => $this->published_at,
            'keywords' => $this->keywords,
            'title' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
        ];
    }
}
