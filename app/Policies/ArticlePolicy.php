<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * @return boolean
     */
    public function viewAny()
    {
        return true;
    }

    /**
     * @param User $user
     * @param Article $article
     * @return boolean
     */
    public function view(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    /**
     * @return boolean
     */
    public function create()
    {
        return true;
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
