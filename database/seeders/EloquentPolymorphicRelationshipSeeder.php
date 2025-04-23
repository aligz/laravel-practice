<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use App\Models\Taggable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EloquentPolymorphicRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // One to one
        $post = Post::factory()->create(['id' => 1]);
        $post->image()->save(Image::factory()->make());

        $user = User::factory()->create(['id' => 1]);
        $user->image()->save(Image::factory()->make());

        // One to many
        $post->comments()->saveMany(Comment::factory()->count(2)->make());
        $video = Video::factory()->create(['id' => 1]);
        $video->comments()->saveMany(Comment::factory()->count(2)->make());

        // Many to many
        $tag1 = Tag::factory()->create(['id' => 1]);
        $tag2 = Tag::factory()->create(['id' => 2]);
        $post->tags()->attach([$tag1, $tag2]);
        $video->tags()->attach([$tag2]);

    }
}
