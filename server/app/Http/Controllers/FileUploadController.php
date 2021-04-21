<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\part_images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class FileUploadController extends Controller
{
    public function addPartImages($id,$number,Request $request){
        $path = public_path('partImages') .'/' . $id ;
        $numberPath = public_path('partImages') .'/' . $id . '/' . $number;
        File::makeDirectory($path, $mode = 0777, true, true);
        File::makeDirectory($numberPath , $mode = 0777, true, true);
        $generated_new_name = md5(microtime()) . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($numberPath, $generated_new_name);
        $n = [
            'part_id' => $id,
            'avatar' => $number . '/' . $generated_new_name,
            'user_id' => Auth::user()->id
        ];


        part_images::create($n);
    }

    public function userUpdateImage(Request $request){

         $old_upload_path = public_path('profileImages');
         File::delete($old_upload_path . '/' . Auth::user()['avatar']);

        $img = $this->fileUpload($request,'partImages');

        $a = [
            'avatar' => $img->name
        ];
        Auth::user()->update($a);

    }

    public function fileStore(Request $request)
    {
        $img = $this->fileUpload($request,'partImages');



        return response()->json([
            'success' => 'You have successfully uploaded ' ,
            'name' => $img->name

        ]);
    }

    public function getProfileImage($image){

        return redirect('profileImages/' . $image);
    }

    public function fileStoreParts(Request $request)
    {
        $img = $this->fileUpload($request,'partImages');



        return response()->json([
            'success' => 'You have successfully uploaded "' ,
            'name' => $img->name

        ]);
    }

    public function getProductImage($image){
        return redirect('partImages/' . $image);
    }


    private function fileUpload($request,$path){
        $upload_path = public_path('profileImages');
        $generated_new_name = md5(microtime()) . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($upload_path, $generated_new_name);

        $file = new \stdClass();
        $file->name = $generated_new_name;

        return $file;
    }
}

