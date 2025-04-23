<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Faker\Factory;
use Illuminate\Http\Request;

class PolymorphicRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function oneToOne()
    {
        return response()->json(
            [
                'user' => User::with('image')->find(1),
                'post' => Post::with('image')->find(1),
                'images' => Image::all(),
                'user_morphOne_image' => User::find(1)->image,
                'post_morphOne_image' => Post::find(1)->image,
            ]);
    }

    public function oneToMany()
    {
        return response()->json(
            [
                'post' => Post::with('comments')->find(1),
                'video' => Video::with('comments')->find(1),
                'comments' => Comment::all(),
                'post_morphMany_comment' => Post::find(1)->comments,
                'video_morphMany_comment' => Video::find(1)->comments,
            ]);
    }

    public function manyToMany()
    {
        return response()->json(
            [
                'post' => Post::with('comments')->find(1),
                'video' => Video::with('comments')->find(1),
                'tags' => Tag::all(),
                'post_morphToMany_tag' => Post::find(1)->tags,
                'video_morphToMany_tag' => Video::find(1)->tags,
            ]);
    }
}
