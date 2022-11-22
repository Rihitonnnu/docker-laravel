<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @param string $name
     * @return \App\Models\Tag
     */
    public function storeTag(string $name)
    {
        $tag = $this->create([
            'name' => $name,
        ]);
        return $tag;
    }

    /**
     * @param string $name
     * @param integer $id
     * @return \App\Models\Tag
     */
    public function updateTag(string $name, int $id)
    {
        $tag = $this::find($id);

        $tag->fill([
            'name' => $name,
        ])->save();
        return $tag;
    }

    /**
     * @param integer $id
     * @return void
     */
    public function destroyTag(int $id)
    {
        $this::find($id)->delete();
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }
}
