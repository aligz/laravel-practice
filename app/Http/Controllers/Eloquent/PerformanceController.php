<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class PerformanceController extends Controller
{
    /**
     * Chunking Using Lazy Collections
     *
     * @return void
     */
    public function lazy()
    {
        Flight::where('departed', true)
            ->lazyById(20, column: 'id')
            ->each->update(['departed' => false]);
    }

    /**
     * Lazy Eager Loading
     *
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function load()
    {
        $posts = Post::all();

        $condition = request()->get('condition');

        if ($condition) {
            $posts->load('comments', 'image');
        }
    }

    public function caching()
    {
        $post = Post::with('comments')->find(1);

        cache()->remember("post_comments_" . $post->id, now()->addHour(), function () use ($post) {
            return $post->comments;
        });
    }

    public function whereHas()
    {
        $users = User::with('posts')
            ->whereHas('posts', function ($query) {
                $query->where('status', 'published');
            })->get();
    }

    /**
     * Conditional Clauses
     *
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function when()
    {
        $condition = request()->get('condition');

        $users = User::query()
            ->when($condition, function (Builder $query, string $role) {
                $query->where('role_id', $role);
            })
            ->get();
    }
}
