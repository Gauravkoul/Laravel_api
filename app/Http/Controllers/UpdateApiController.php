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
use Illuminate\Support\Facades\Crypt;
use UserApiController;
error_reporting(0);

class UpdateApiController extends Controller
{

    public function update(Request $request){
    
        $token = Session::get('token');
        $user_id = Session::get('user');
        
        $user = UserModel::where('user_id',$user_id)->get('id');
       
        $id1 = $user[0]->id;
        $user1 = TokenModel::where('user_id',$user_id)->get('tokens');


        $token_key = $user1[0]->tokens;
        $current = Carbon::now();
        $currentDate= $current->toDateString();
        $updated= TokenModel::where('tokens',$token)->get('updated_at');
    
        if(count($updated) == 0){
            return view('update',['error_message' =>'Please provide valid token']);
        }
        else{
            $updatedDate = $updated[0]->updated_at->toDateString();
            if($currentDate == $updatedDate){
                
                    
                    $valid_id = UserModel::find($id1);
                    $valid_id->name = is_null($request->name) ? $valid_id ->name : $request->name;
                    $check_email =  $request->email;
                    if(!$check_email==NULL){
                        if( (is_numeric($check_email) &&  strlen((string)$check_email) == 10) || filter_var($check_email, FILTER_VALIDATE_EMAIL)){
                            $id = UserModel::where('email',$check_email)->get('id');
                            if(count($id)>0 ){
                                return view('update',['error_message' =>"Email/phone number already exists"]);
                            }
                            else{
                                $valid_id->email =  $check_email;
                                $password = $request->password;
                                $c_password = is_null($request->c_password) ? $valid_id ->c_password : $request->c_password;
                                if($password == $c_password){
                                    $valid_id->password = Crypt::encryptString($password);
                                    $valid_id->save();
                                    return view('update',['success_message' =>'Details updated successfully']);
                                }

                                elseif($password==NULL && $c_password==NULL){
                                    $valid_id->save();
                                    return view('update',['success_message' =>'Details updated successfully']);
                                }
                                else{
                                    return view('update',['error_message' =>"Password doesn't match"]);
                                }
                            }
                        }
                        else{
                            return view('update',['error_message' => "Enter Valid Email/phone number "]);
                        }
                        
                    }
                    else{
                            $password = $request->password;
                            $c_password = is_null($request->c_password) ? $valid_id ->c_password : $request->c_password;
                            if($password == $c_password){
                                $valid_id->password = Crypt::encryptString($password);
                                $valid_id->save();
                                return view('update',['success_message' =>'Details updated successfully']);
                            }

                            elseif($password==NULL && $c_password==NULL){
                                $valid_id->save();
                                return view('update',['success_message' =>'Details updated successfully']);
                            }
                            else{
                                return view('update',['error_message' =>"Password doesn't match"]);
                            }
                        
                    }
            }
            else{
                return view('update',['message' =>'Session Expired! Please login again']);
            }
        }
    }
}    