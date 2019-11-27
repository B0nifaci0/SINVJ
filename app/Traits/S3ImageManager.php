<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait S3ImageManager {

    private function saveImages($base_64, $path, $name)
	{
		// Prepare image
		$base_64 = str_replace('data:image/png;base64,', '', $base_64);
		$base_64 = str_replace('data:image/jpg;base64,', '', $base_64);
		$base_64 = str_replace('data:image/jpeg;base64,', '', $base_64);
		$base_64 = str_replace(' ', '+', $base_64);

		$image = base64_decode($base_64);

		$path = $path . '/' . $name;
		Storage::disk('s3')->put($path, $image);
		return  $path;
    }
    
    private function getS3URL($path) {
		$adapter = Storage::disk('s3')->getDriver()->getAdapter();

        $command = $adapter->getClient()->getCommand('GetObject', [
            'Bucket' => $adapter->getBucket(),
            'Key' => $adapter->getPathPrefix(). $path
        ]);
    
        $result = $adapter->getClient()->createPresignedRequest($command, '+20 minute');
    
        return (string) $result->getUri();
    }

}