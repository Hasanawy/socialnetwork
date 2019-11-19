<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

use App\User;
use Auth;
class UserController extends Controller
{
    //
  


    public function postSignUp(Request $request)
    {   
        
        $this->validate($request , [
            'email'         => 'required|email|unique:users',
            'first_name'    => 'required|max:120' ,
            'password'      => 'required|min:4',
            'image'        => 'required|unique:users'
        ]);

    	$email 			= 	$request['email'];
    	$first_name 	= 	$request['first_name'];
    	$password 		= 	bcrypt($request['password']);
        

        if($request->hasFile('image'))
            {
                $fileNameExt = 'images/'.$request->file('image')->getClientOriginalName();
                $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
                $fileExt = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
                $pathToStore = $request->file('image')->storeAs('public/images',$fileNameToStore);
            }

           
       


    	$user = new User() ;
    	  $user->email 			= $email ;
    	  $user->first_name 	= $first_name ;
    	  $user->password 		= $password ;
          if($request->hasFile('image')){
                        $user->image = $fileNameToStore;
                    }else{
                        $user->image = "No Image Saved Yet";
                    }
    	  $user->save();
        



        


          

            
            
        Auth::login($user);
    	return redirect()->route('dashboard');

    }

    public function postSignIn(Request $request)
    {
          $this->validate($request , [
            'email'         => 'required',
            'password'      => 'required'
        ]);

        if(Auth::attempt(['email' => $request['email'] , 'password' => $request['password']]))
        {
            return redirect()->route('dashboard');
        }
    	return redirect()->back();
    }
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account' , ['user' =>Auth::user()]);
    }

    public function postSaveAccount(Request $request)
    {   
        if($request->hasFile('image'))
        {
            $this->validate($request , [
                'email'         => 'required|email|unique:users',
                'first_name'    => 'required|max:120' ,
            ]);

            $user = Auth::user();
            $user->first_name = $request['first_name'];
            $user->email = $request['email'];
            $user->update();

            
            $image = $request->file('image');
            $filename = time() . '.'. $image->getClientOriginalExtension();

            $path = public_path('images');
            $imagepath = $request->image->move($path, $filename);
            $post->image = $imagepath;

            if($file)
            {
                Storage::disk('local')->put($filename , File::get($request->file('image')));
            }
            return redirect()->route('account');
        }else{
            echo"eroore";
        }
    }

    public function getUserImage($filename)
    {
          $path = storage_path('storage/app/public/images' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
    }

}
