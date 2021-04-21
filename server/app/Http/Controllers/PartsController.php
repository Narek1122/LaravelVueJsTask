<?php

namespace App\Http\Controllers;

use App\Models\part_images;
use App\Models\User;
use App\Models\Parts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddPartReq;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['deleteMyPart', 'changeMyPart', 'getAllParts', 'searchAllParts', 'searchAllData', 'blockUserPart', 'test', 'getPartById', 'changeMyPartImage', 'blockUser']]);
    }

    public function searchmyparts(Request $request)
    {


        $data = User::whereHas('parts')->get();


        return $data;
    }

    public function SelectedPartData(Request $request)
    {
        $p = Parts::where('isblocked', 0)->where('user_id', Auth::user()['id'])->where($request['select'], $request['inp'])->get();
        return $p;
    }

    public function changeMyPartImage(Request $request, $id)
    {
        $old_upload_path = public_path('partImages');
        File::delete($old_upload_path . '/' . Parts::Where('id', $id)->first()['avatar']);

        $upload_path = public_path('partImages');
        $generated_new_name = md5(microtime()) . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($upload_path, $generated_new_name);
        $a = [
            'avatar' => $generated_new_name
        ];
        Parts::Where('id', $id)->update($a);

    }

    public function getPartById($id)
    {
        $p = Parts::Where('id', $id)->first()->user_id;
        $users = User::where('id', $p)->first();
        $parts = Parts::Where('id', $id)->first();
        return response()->json([
            'parts' => $parts,
            'users' => $users
        ]);
    }

    public function test()
    {

        dd(User::whereHas('users'));
    }

    public function searchAllParts(Request $request)
    {

        $u = Parts::Where('name', '=', $request->name)->get();
        dd($u);
    }

    public function deleteMyPart($id)
    {

        Parts::findOrFail($id)->delete();

        return response()->json([
            'status' => 1
        ]);
    }

    public function changeMyPart(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'model' => 'required',
            'year' => 'required',
            'make' => 'required',
            'partnumber' => 'required'
        ]);

        $p = Parts::find($id);

        if ($p) {
            $p->update($validated);
        } else {
            return response()->json([
                'status' => 0
            ]);
        }

        return response()->json([
            'status' => 1
        ]);
    }

    public function addCarPart(AddPartReq $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        Parts::create($validated);

    }

    public function getMyParts()
    {
        $id = Auth::user()->id;
        $getParts = Parts::where('isBlocked', 0)->Where('user_id', '=', $id)->get();
        $getPartImages = part_images::where('user_id',$id)->get();
        return response()->json([
            'part' =>$getParts,
            'partimages'=>$getPartImages
        ]);
    }

    public function getAllParts()
    {
        return response()->json([
            'status' => 1,
            'data' => Parts::where('isBlocked', 0)->get(),
            'partimages'=> part_images::get()
        ]);
    }

    public function searchAllData(Request $requset)
    {

        $data = Parts::Where('isBlocked', 0)
            ->where('isBlocked', 0)
            ->where('name', '%' . $requset['name'] . '%')
            ->orWhere('model', 'like', '%' . $requset['name'] . '%')
            ->orWhere('partnumber', 'like', '%' . $requset['name'] . '%')
            ->orWhere('model', $requset['name'])
            ->orWhere('name', $requset['name'])
            ->orWhere('partnumber', $requset['name'])
            ->get();
        return $data;


    }

    public function blockUserPart(Request $requset)
    {
        $data = ['isBlocked' => $requset->block];
        Parts::Where('id', $requset->id)->update($data);

    }

    public function blockUser(Request $request)
    {
        $u = User::Where('id', $request->id)->first()['isBlocked'];
        $data = ['isBlocked' => !$u];
        User::Where('id', $request->id)->update($data);
        Parts::Where('user_id', $request->id)->update($data);

    }


}
