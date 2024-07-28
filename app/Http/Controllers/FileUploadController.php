<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileUpload;

class FileUploadController extends Controller
{
    // Upload pics
    public function upload_pic($req, $type, $id)
    {
        $request = $req;
        if($request->hasFile('file')){

            $checker = FileUpload::where('UID', $id)->where('Type', $type)->delete();

            // Get file name with extension
            $fileNameWithExt = $request->file('file')->getClientOriginalName();

            $full_path = 'storage/pics/';

            // Upload file
            $path = $request->file('file')->storeAs($full_path, $fileNameWithExt);

            $file_upload = new FileUpload;
            $file_upload->Name = $fileNameWithExt;
            $file_upload->Location = $full_path;
            $file_upload->Type = $type;
            $file_upload->UID = $id;
            $file_upload->save();

        }
    }
}
