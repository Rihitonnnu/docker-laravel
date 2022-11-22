<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    /**
     * @return \App\Models\Article
     * @param int $userId
     * @param string $title
     * @param string $content
     */
    public function storeArticle(int $userId, string $title, string $content)
    {
        $article = $this->create([
            'user_id' => $userId,
            'title' => $title,
            'content' => $content,
        ]);
        return $article;
    }

    /**
     * @param string $title
     * @param string $content
     * @param integer $id
     * @return \App\Models\Article
     */
    public function updateArticle(string $title, string $content, int $id)
    {
        $article = $this::find($id);
        $article->fill([
            'title' => $title,
            'content' => $content,
        ])->save();
        return $article;
    }

    /**
     * @param \App\Models\Article $article
     * @return void
     */
    public function destroyArticle(Article $article)
    {
        $article->delete();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
