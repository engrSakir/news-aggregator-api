<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ForgotPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static upsert(array $mergedArticles, string[] $array, string[] $array1)
 */
class Article extends Model
{
  protected $table = 'articles';
  protected $fillable = [
      'title',
      'description',
      'url',
      'source',
      'published_at',
  ];
}
