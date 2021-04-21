<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SignUpReq;
use App\Http\Requests\AddPartReq;
use App\Http\Requests\LoginReq;
use App\Models\Parts;

class AuthController extends Controller
{

    public function adminGetAllUsers(Request $request){

      $users = User::WhereHas('parts')->get();
      return $users;

    }

    public function deleteme()
    {
        Auth::user()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }



    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup','adminLogin','searchAllDataAdmin','adminGetAllUsers']]);
    }

    public function userSettingsUpdate(Request $request){
        $validated = $request->validate([
            'name' => 'nullable|min:3|max:16',
            'password' => 'nullable|min:4',
            'address' => 'nullable|min:5',
            'phone'=> 'nullable|min:5',
        ]);

        $validated = array_filter($validated,function($value){
            return !empty($value);
        });

        Auth::user()->update($validated);
    }

    public function searchAllDataAdmin(Request $request){
        $p = User::where('email',$request->email)
            ->where('isBlocked',0)
            ->orWhere('name',$request->email)
            ->orWhere('email', 'like', '%'.$request['email'].'%')
            ->orWhere('name', 'like', '%'.$request['email'].'%')
            ->first();

        $data = User::whereHas('parts')->get();
        if($request->email == ''){
            return Parts::get();
        }

        return Parts::Where('user_id',$p->id)->get();

    }

    public function UpdateLoginUser()
    {
        return Auth::user();
    }

    public function signup(SignUpReq $request)
    {

        $validated = $request->validated();
        User::create($validated);

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(LoginReq $requset)
    {


        if (!$token = auth()->attempt($requset->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => auth()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


}
