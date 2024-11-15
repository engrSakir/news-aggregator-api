<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static upsert(array $mergedArticles, string[] $array, string[] $array1)
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
