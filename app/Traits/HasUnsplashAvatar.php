<?php

namespace App\Traits;
use App\Services\UnsplashService;
use ReflectionClass;

trait HasUnsplashAvatar
{
    /**
     * Set a random Unsplash avatar.  This is a generic example demonstrating a trait that can be used by multiple models.
     */
    public function setRandomUnsplashAvatar($query_string = '')
    {
        $this->avatar_url = (new UnsplashService)->getRandomImageThumbnail((new ReflectionClass($this))->getShortName());
        $this->save();
    }
}