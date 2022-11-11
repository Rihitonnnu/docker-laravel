<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
