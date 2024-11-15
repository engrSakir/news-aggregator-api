<?php
namespace App\Enums\News\V1;

final class NewsEnum
{
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';

    public const URL = 'url';
    public const SOURCE = 'source';
    public const PUBLISHED_AT = 'published_at';
    const SOURCES = ['source', 'author', 'category'];
}
