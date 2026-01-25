<?php

use App\Models\Follow;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('profile cannot follow itself', function () {
    $profile = Profile::factory()->create();

    expect(fn() => Follow::createFollow($profile, $profile))
        ->toThrow(InvalidArgumentException::class, 'A profile cannot follow itself.');
});

test('profile can follow another profile', function () {
    $follower = Profile::factory()->create();
    $following = Profile::factory()->create();

    $follow = Follow::createFollow($follower, $following);

    expect($follow)->toBeInstanceOf(Follow::class)
        ->and($follow->follower_profile_id)->toBe($follower->id)
        ->and($follow->following_profile_id)->toBe($following->id);
});

test('profile can unfollow another profile', function () {
    $follower = Profile::factory()->create();
    $following = Profile::factory()->create();

    $follow = Follow::createFollow($follower, $following);

    $result = Follow::removeFollow($follower, $following);

    expect($result)->toBeTrue()
        ->and(Follow::where('follower_profile_id', $follower->id)
            ->where('following_profile_id', $following->id)
            ->exists())->toBeFalse();
});
