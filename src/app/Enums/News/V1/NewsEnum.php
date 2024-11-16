<?php
namespace App\Enums\News\V1;

final class NewsEnum
{
    public const NEWS_CACHE_PREFIX = 'news:';
    public const NEWS_PREFERENCE_CACHE_PREFIX = 'news:preference:';
    public const NEWS_PREFERENCE_CACHE_DURATION = 60 * 60 * 24;
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';

    public const URL = 'url';
    public const SOURCE = 'source';
    public const PUBLISHED_AT = 'published_at';
    const SOURCES = ['source', 'author', 'category'];
}
