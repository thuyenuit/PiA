<?php

namespace App\Helpers;

use App\Http\Requests\ClubSaveRequest;
use App\Models\Club;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait ClubsHelper
{
    /**
     * Store image into disk
     *
     * @param ClubSaveRequest $request
     * @param $name
     * @return string
     */
    private function storeImage(ClubSaveRequest $request, $name)
    {
        $fileExtension = $request->file($name)->getClientOriginalExtension();

        $fileName = $name . '_' . time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
        $uploadPath = Str::finish(public_path(config('constants.UPLOAD.CLUB_LOGO')), '/');

        $image = Image::make($request->file($name));
        $image->orientate();
        $image->save($uploadPath . $fileName);

        return $fileName;
    }

    private function deleteImage($id)
    {
        $oldFileName = Club::where('id', $id)->value('club_logo');
        $oldFilePath = public_path(config('constants.UPLOAD.CLUB_LOGO')) . '/' . $oldFileName;
        if (File::exists($oldFilePath)) {
            File::delete($oldFilePath);
        }
    }
}
