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
