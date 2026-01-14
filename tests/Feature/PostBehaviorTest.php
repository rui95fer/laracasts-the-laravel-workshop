<?php

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('allows a profile to publish a post', function () {
    $profile = Profile::factory()->create();

    $post = Post::publish($profile, 'Content of the post');

    expect($post->exists)->toBeTrue()
        ->and($post->profile_id)->toEqual($profile->id)
        ->and($post->content)->toEqual('Content of the post')
        ->and($post->parent_id)->toBeNull()
        ->and($post->repost_of_id)->toBeNull();
});

test('can reply to post', function () {
    $original = Post::factory()->create();

    $replier = Profile::factory()->create();
    $reply = Post::reply($replier, $original, 'This is a reply');

    expect($reply->parent->is($original))->toBeTrue()
        ->and($original->replies)->toHaveCount(1);
});

test('can have many replies', function () {
    $original = Post::factory()->create();
    $replies = Post::factory()->count(4)->reply($original)->create();

    expect($replies->first()->parent->is($original))->toBeTrue()
        ->and($original->replies)->toHaveCount(4)
        ->and($original->replies->contains($replies->first()))->toBeTrue();
});
