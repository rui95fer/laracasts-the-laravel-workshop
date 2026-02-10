<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Profile $profile): View
    {
        $profile->loadCount(['followers', 'following']);

        $posts = Post::where('profile_id', $profile->id)
            ->whereNull('parent_id')
            ->with(
                ['repostOf' => fn($q) => $q->withCount(['likes', 'reposts', 'replies'])]
            )
            ->withCount(['likes', 'reposts', 'replies'])
            ->latest()
            ->get();

        return view('profiles.show', compact('profile', 'posts'));
    }
}
