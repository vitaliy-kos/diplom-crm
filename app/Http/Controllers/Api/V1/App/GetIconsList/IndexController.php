<?php

namespace App\Http\Controllers\Api\V1\App\GetIconsList;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class IndexController extends Controller
{
    public function __invoke()
    {
        $mediaPath = public_path('storage/icons/');
        $filesInFolder = File::allFiles($mediaPath);
        $allMedia = [];

        foreach ($filesInFolder as $path) {
            $files = pathinfo($path);
            $allMedia[] = 'storage/icons/' . $files['basename'];
        }

        return json_encode($allMedia);
    }
}
