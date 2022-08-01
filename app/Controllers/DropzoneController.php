<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Imageupload;

class DropzoneController extends BaseController
{
	public function dropzone()
    {
        return view('upload-view');
	}
	
	public function dropzoneStore()
    {
        $image = $this->request->getFile('file');

        $imageName = $image->getName();

        $image->move('images', $imageName);

		$imageUpload = new ImageUpload();
		
		$data = [
			"filename" => $imageName
		];

		$imageUpload->insert($data);

        return json_encode(array(
			"status" => 1,
			"filename" => $imageName
		));
    }
}