<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArtistsToFollow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $artists = [
            ['img' => '/images/alessia.png', 'name' => 'alessia_draws'],
            ['img' => '/images/anne.png', 'name' => 'just_anne'],
            ['img' => '/images/mr-anderson.png', 'name' => 'Mr. Anderson'],
            ['img' => '/images/michael.png', 'name' => 'Michael'],
        ];

        return view('components.artists-to-follow', [
            'artists' => $artists,
        ]);
    }
}
