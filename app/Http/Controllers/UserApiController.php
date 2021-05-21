<?php

namespace App\Http\Controllers;
use Session;
use App\UserModel;
use App\TokenModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Dirape\Token\Token;
use Auth;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Redirector;
use UpdateApiController;
use Illuminate\Support\Facades\Crypt;
error_reporting(0);

class UserApiController extends Controller
{
     /* --------------------------------------- Backend ------------------------------------------- */ 
    public function back_signup(Request $request)
    {   
        $uniqid = uniqid();
        $user = new UserModel();
        $user->user_id = $uniqid;
        $user->name = $request->get('name');
        $check_name = $user->name;
        $check_email= $request->get('email/phone');
        if( (is_numeric($check_email) &&  strlen((string)$check_email) == 10) || filter_var($check_email, FILTER_VALIDATE_EMAIL)){
            $user->email =  $check_email;
        }
        else{
            return "Enter Valid Email/phone number ";
        }
        $user->password = Crypt::encryptString($request->get('password'));
        $check_password = $user->password; 
        $id = UserModel::where('email',$check_email)->get('id');
        if(count($id)>0 ){
            return "Email/phone number already exists";
        }
        else{
             if(is_null($check_name)){
                 return "Please provide your name";
             }

             elseif(is_null($check_password)){
                 return "Please provide password";
             }


            $user->save();
            $result = [
                'User_id' =>  $user->user_id,
                'code' => 200,
                'message' => 'User Successfully Created!',
            ];
            
            $tokens = new TokenModel();
            $tokens->user_id = $uniqid;
            $tokens->save();

            return response()->json($result);
        }
    }


    public function back_login(Request $request){

        $email= $request->get('email/phone');
        $password = $request->get('password');

        $pass = UserModel::where('email',$email)->get('password');
      
        if(count($pass)==0){
            return "Email/Phone number does not exist";
        }else{

            $pass = $pass[0]->password;
            $pass=Crypt::decryptString($pass);
    
            if($pass == $password){

                $user = UserModel::where('email',$email)->get('user_id');
                $user_id = $user[0]->user_id;
                
                $token = TokenModel::where('user_id',$user_id)->get('id');
                $id = $token[0]->id;
                
                $token = TokenModel::find($id);
                $token->tokens = (new Token())->Unique('tokens', 'tokens', 200);
                $token->save();
            
                $result = [
                    'User_id' => $user_id,
                    'Token_key' => $token->tokens,
                    'code' => 200,
                    'message' => 'User Login Successfully!',
                ];
                
                return response()->json($result);
            }
            else{
                return "Enter valid information";
            }
        }
       
    }

    
    public function back_update(Request $request,$user_id){
        $user = UserModel::where('user_id',$user_id)->get('id');
        if(count($user)==0){
            return "User_ID does not exist";
        }
        else{
            $id1 = $user[0]->id;
            $token= $request->get('token');
            if(!$token){
                return "Please provide token";
            }
            else{
            $user1 = TokenModel::where('user_id',$user_id)->get('tokens');
            
                    $token_key = $user1[0]->tokens;
                    $current = Carbon::now();
                    $currentDate= $current->toDateString();
                    $updated= TokenModel::where('tokens',$token)->get('updated_at');

                    if(count($updated) == 0){
                            return "Please provide valid token";
                        }
                    else{
                        $updatedDate = $updated[0]->updated_at->toDateString();
                        if($currentDate == $updatedDate){
                            if ($token_key == $token) {
                                
                                $valid_id = UserModel::find($id1);
                                $valid_id->name = is_null($request->name) ? $valid_id ->name : $request->name;
                                $check_email =  $request->get('email/phone');
                                if(!$check_email==NULL){
                                    if( (is_numeric($check_email) &&  strlen((string)$check_email) == 10) || filter_var($check_email, FILTER_VALIDATE_EMAIL)){
                                        $id = UserModel::where('email',$check_email)->get('id');
                                        if(count($id)>0 ){
                                            return "Email/phone number already exists";
                                        }
                                        else{
                                            $valid_id->email =  $check_email;
                                            $password = $request->password;
                                            $c_password = is_null($request->c_password) ? $valid_id ->c_password : $request->c_password;
                                            if($password == $c_password){
                                                $valid_id->password = Crypt::encryptString($password);
                                                $valid_id->save();
                                                return 'Details updated successfully';
                                            }
            
                                            elseif($password==NULL && $c_password==NULL){
                                                $valid_id->save();
                                                return 'Details updated successfully';
                                            }
                                            else{
                                                return "Password doesn't match";
                                            }
                                        }
                                    }
                                    else{
                                        return  "Enter Valid Email/phone number ";
                                    }
                                    
                                }
                                else{
                                        $password = $request->password;
                                        $c_password = is_null($request->c_password) ? $valid_id ->c_password : $request->c_password;
                                        if($password == $c_password){
                                            $valid_id->password = Crypt::encryptString($password);
                                            $valid_id->save();
                                            return 'Details updated successfully';
                                        }
            
                                        elseif($password==NULL && $c_password==NULL){
                                            $valid_id->save();
                                            return 'Details updated successfully';
                                        }
                                        else{
                                            return "Password doesn't match";
                                        }
                                    
                                } 
                            }  
                            else{
                                return "User not found";
                            }
                        }
                            else{
                            return "Session Expired! Please login again";
                        
                    }
                }
            }
        }
            
    

}
/* End backend */




/* ------------------------------------------frontend ---------------------------------------*/

public function store(Request $request)
{
    $uniqid = uniqid();
    $user = new UserModel();
    $user->user_id = $uniqid;
    $user->name = $request->get('name');
    $check_email= $request->get('email');
    if( (is_numeric($check_email) &&  strlen((string)$check_email) == 10) || filter_var($check_email, FILTER_VALIDATE_EMAIL)){
        $user->email =  $check_email;
    }
    else{
        return back()->with('error_message',"Enter Valid Email/phone number ");
    }       
    $password =  $request->get('password');
    $c_password = $request->get('c_password');

    $id = UserModel::where('email',$check_email)->get('id');
  
    if(count($id)>0 ){
        return back()->with('error_message',"Email/phone number already exists");
    }
    else{
        if($password == $c_password){
            $user->password = Crypt::encryptString($request->get('password'));
            $user->save();
            $tokens = new TokenModel();
            $tokens->user_id = $uniqid;
            $tokens->save();
        
            return back()->with('success_message','User Successfully Created!');
        }
        else{
            return back()->with('error_message',"Password doesn't match");
        }
    }
}


public function login(Request $request){

    $email= $request->get('email');
    $password =  $request->get('password');

    $pass = UserModel::where('email',$email)->get('password');
  
    if(count($pass)==0){
        return back()->with('error_message','Email/phone number does not exist');
    }
    else{

        $pass = $pass[0]->password;
        $pass=Crypt::decryptString($pass);
        if($pass == $password){
       
            $user = UserModel::where('email',$email)->get('user_id');
        
            $user_id = $user[0]->user_id;
        
            $username = UserModel::where('email',$email)->get('name');
        
            $name = $username[0]->name;
        
            $token = TokenModel::where('user_id',$user_id)->get('id');
            $id = $token[0]->id;
            
            $token = TokenModel::find($id);
            $token->tokens = (new Token())->Unique('tokens', 'tokens', 200);
            $token->save();
            
            $token= $token->tokens;
            Session::put('token', $token);
            Session::put('user', $user_id);

            return view('update',['success_message' => 'User Login Successfully!']);
    
        }
        else{
            return back()->with('error_message','Enter valid information');
        
        }
    }
}




/* End frontend */
}
?>