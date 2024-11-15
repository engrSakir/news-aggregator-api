<?php

namespace App\Models\V1;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static upsert(array $mergedArticles, string[] $array, string[] $array1)
 * @method static where(string $string, int|string|null $id)
 * @method static findOrFail($id)
 */
class Preference extends Model
{
    const TYPES = ['source', 'author', 'category'];
    protected $table = 'preferences';
    protected $fillable = ['user_id', 'type', 'value',];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
