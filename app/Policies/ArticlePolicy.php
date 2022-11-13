<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Article;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function show(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    public function edit(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    public function update(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }

    public function delete(User $user, Article $article)
    {
        return $user->id == $article->user_id;
    }
}
