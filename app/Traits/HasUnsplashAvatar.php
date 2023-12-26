<?php

namespace App\Traits;
use App\Services\UnsplashService;
use ReflectionClass;

trait HasUnsplashAvatar
{
    public function setRandomUnsplashAvatar($query_string = '')
    {
        $this->avatar_url = (new UnsplashService)->getRandomImageThumbnail((new ReflectionClass($this))->getShortName());
        $this->save();
    }
}