<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $title
 * @property int $order
 * @property int $parent_id
 * @property bool $is_active
 *
 * @property Category $parent
 * @property Collection<Category> $children
 */
class Category extends Model
{
    protected $fillable = [
        'title',
        'order',
        'parent_id',
        'is_active'
    ];

    protected $casts = [
        'order' => 'int',
        'parent_id' => 'int',
        'is_active' => 'bool'
    ];

    protected $attributes = [
        'is_active' => false,
        'order' => 0
    ];

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
