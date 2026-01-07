<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// web.php
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
                ],
                'replies' => [
                    [
                        'content' => '<p>Heh — this looks just like me!</p>',
                        'postedDateTime' => '2h',
                        'likeCount' => 50,
                        'replyCount' => 10,
                        'repostCount' => 10,
                        'profile' => [
                            'avatar' => '/images/simon-chilling.png',
                            'displayName' => 'Simon',
                            'handle' => '@simonswiss'
                        ],
                    ]
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
                ],
                'replies' => [
                    [
                        'content' => '<p>Heh — this looks just like me!</p>',
                        'postedDateTime' => '2h',
                        'likeCount' => 50,
                        'replyCount' => 10,
                        'repostCount' => 10,
                        'profile' => [
                            'avatar' => '/images/simon-chilling.png',
                            'displayName' => 'Simon',
                            'handle' => '@simonswiss'
                        ],
                    ]
                ]
            ]
        ])
    );

    return view('profile', compact('feedItems'));
});
