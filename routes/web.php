<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feed', function () {
    $feedItems = json_decode(
        json_encode([
            [
                'postedDateTime' => '3h',
                'content' => <<<srt
                    <p>
                        I made this! <a href="#">#myartwork</a> <a href="#">#pixl</a>
                    </p>
                    <img src="/images/simon-chilling.png" alt=""/>
                srt,
                'likeCount' => 24,
                'replyCount' => 4,
                'repostCount' => 2,
                'profile' => [
                    'avatar' => '/images/michael.png',
                    'displayName' => 'Michael',
                    'handle' => '@mmich_jj'
                ]
            ]
        ])
    );

    return view('feed', compact('feedItems'));
});

Route::get('/profile', function () {
    $feedItems = json_decode(
        json_encode([
            [
                'postedDateTime' => '3h',
                'content' => <<<srt
                    <p>
                        I made this! <a href="#">#myartwork</a> <a href="#">#pixl</a>
                    </p>
                    <img src="/images/simon-chilling.png" alt=""/>
                srt,
                'likeCount' => 24,
                'replyCount' => 4,
                'repostCount' => 2,
                'profile' => [
                    'avatar' => '/images/michael.png',
                    'displayName' => 'Michael',
                    'handle' => '@mmich_jj'
                ]
            ]
        ])
    );

    return view('profile', compact('feedItems'));
});
