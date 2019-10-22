<?php

namespace App\Http\Controllers\MyAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Users;
use App\UserTypes;

class RegisterController extends Controller
{
    // use IssueTokenTrait;
    private $client;
    
    public function __construct(){
        $this->client = Client::find(2);
    }

    public function register(Request $request){

        $this->validate($request,[
            'full_name'=>'required',
            'password'=>'required|min:6|confirmed',
            'phone' => 'required|min:9||unique:users'
        ]);

        $user_id = Str::random(20);
        $user = Users::find($user_id);
        while($user != null){
            $user_id = Str::random(20);
            $user = Users::find($user_id);
        }

        $user = Users::create([
            'id' => $user_id,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'password' => \bcrypt($request->password),
            'user_type_id' => DB::table('user_types')->where('name', 'Member')->first()->id
        ]);

        $params = [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->phone,
            'password' => $request->password,
            'scope' => '*'
        ];

        $request->request->add($params);

        $proxy = Request::create('oauth/token','POST');

        return Route::dispatch($proxy);
    }

    public function edit(Request $request){
        $user_id = $request->id;
        $user_instance = Users::find($user_id);
        $img_location = "/storage/profile_imgs/";

        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            if($user_instance->img_loc != "default_user.png"){
                $img_loc = 'public/profile_imgs/' . $user_instance->img_loc;
                if(Storage::disk('local')->exists($img_loc))
                    Storage::disk('local')->delete($img_loc);
            }
            $fileNameWithExt = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $file->storeAs('public/profile_imgs', $fileNameToStore);
            
            // save image path 
            $user_instance->img_loc = $fileNameToStore;
        }

        if($user_instance != null){
            $user_instance->fname = $request->fname;
            $user_instance->lname = $request->lname;
            $user_instance->phone = $request->phone;
            $user_instance->save();
            return response()->json(["status"=>"success"]);
        }
        return \response()->json(["status"=>"falid"]);
    }
}