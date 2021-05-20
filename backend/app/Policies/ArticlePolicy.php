<?php

namespace App\Policies;

use App\Article;
use App\Infrastructure\DataAccess\Eloquent\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any articles.
     *
     * @param  \App\Infrastructure\DataAccess\Eloquent\Auth  $user
     * @return mixed
     */
    public function viewAny(Auth $user)
    {
        //
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param  \App\Infrastructure\DataAccess\Eloquent\Auth  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function view(Auth $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\Infrastructure\DataAccess\Eloquent\Auth  $user
     * @return mixed
     */
    public function create(Auth $user)
    {
        //
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\Infrastructure\DataAccess\Eloquent\Auth  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function update(Auth $user, Article $article)
    {
        return $user->id === $article->id;
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\Infrastructure\DataAccess\Eloquent\Auth  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function delete(Auth $user, Article $article)
    {
        return $user->id === $article->id;
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  \App\Infrastructure\DataAccess\Eloquent\Auth  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function restore(Auth $user, Article $article)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  \App\Infrastructure\DataAccess\Eloquent\Auth  $user
     * @param  \App\Article  $article
     * @return mixed
     */
    public function forceDelete(Auth $user, Article $article)
    {
        //
    }
}
