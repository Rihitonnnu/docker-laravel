<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function show(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    /**
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function edit(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    /**
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function update(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    /**
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function delete(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }
}
