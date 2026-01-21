<?php

use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('profile can like post', function () {
    $profile = Profile::factory()->create();
    $post = Post::factory()->create();

    $like = Like::createLike($profile, $post);

    expect($profile->likes)->toHaveCount(1)
        ->and($profile->likes->contains($like))->toBeTrue()
        ->and($post->likes)->toHaveCount(1)
        ->and($post->likes->contains($like))->toBeTrue()
        ->and($like->post->is($post))->toBeTrue()
        ->and($like->profile->is($profile))->toBeTrue();
});

test('cannot create duplicate likes', function () {
    $profile = Profile::factory()->create();
    $post = Post::factory()->create();

    $like1 = Like::createLike($profile, $post);
    $like2 = Like::createLike($profile, $post);

    expect($like1->id)->toEqual($like2->id)
        ->and($profile->likes)->toHaveCount(1)
        ->and($post->likes)->toHaveCount(1);
});

test('can remove a like', function () {
    $profile = Profile::factory()->create();
    $post = Post::factory()->create();

    Like::createLike($profile, $post);

    $deletedCount = Like::removeLike($profile, $post);

    expect($deletedCount)->toEqual(1)
        ->and($profile->likes)->toHaveCount(0)
        ->and($post->likes)->toHaveCount(0);
});
