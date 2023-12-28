<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UnsplashService;

class UnsplashController extends Controller
{
    public function assignRandomImageThumbnail(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|numeric'
        ]);

        $validator->sometimes('type', 'required|string', function (Fluent $input) {
            switch ($input->type) {
                case 'automobile':
                    return 'required|exists:automobiles,id';
                case 'driver':
                    return 'required|exists:drivers,id';
                default:
                    return false;
            }
        });

        $validatedData = $validator->validated();

        $model = $validatedData['type']::find($validatedData['id']);
        $model->setRandomUnsplashAvatar();
        $model->save();
    }

    public function getRandomImageThumbnail(Request $request, ?string $type)
    {
        return response()->json([
            'avatar_url' => (new UnsplashService)->getRandomImageThumbnail($type)
        ]);
    }
}
