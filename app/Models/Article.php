<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 *
 * @method \Illuminate\Database\Eloquent\Builder search($column, $operator = null, $value = null, $boolean = 'and')
 */
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return \App\Models\Article
     * @param int $userId
     * @param string $title
     * @param string $content
     * @param array $tags
     */
    public function storeArticle(int $userId, string $title, string $content, array $tags)
    {
        $article = $this->create([
            'user_id' => $userId,
            'title' => $title,
            'content' => $content,
        ]);
        $article->tags()->sync($tags);
        return $article;
    }

    /**
     * @param string $title
     * @param string $content
     * @param integer $id
     * @return \App\Models\Article
     */
    public function updateArticle(string $title, string $content, int $id, array $tags)
    {
        $article = $this::find($id);
        $article->fill([
            'title' => $title,
            'content' => $content,
        ])->save();
        $article->tags()->sync($tags);
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
}
