<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static upsert(array $mergedArticles, string[] $array, string[] $array1)
 * @method orderBy(string $string, string $string1)
 * @method static whereId(\Illuminate\Routing\Route|object|string|null $route)
 */
class Article extends Model
{
  protected $table = 'articles';
  protected $fillable = [
      'source',
      'category',
      'author',
      'published_at',
      'keywords',
      'title',
      'description',
      'url',
  ];
}
