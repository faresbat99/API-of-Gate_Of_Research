<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{
    public function forgot(Request $request){
        $emailExit=DB::table('users')//get data from database ... get password reset from token
        ->where('email',$request->input('email'))->first();//this will get the first record from password reset table

        // if we got the value ...if user isn't set that's mean the user doesnt exist
        if (!$user=User::where('email',$emailExit->email)->first()){
            throw new NotFoundHttpException('User not found');
        }
//        if ($request != DB::table('users')->where('email') {
//            return response(
//                [
//                    'message' => 'invalid email'
//                ]
//            );
//        }
//    }
        $email=$request->input('email');
        $token=Str::random('12'); //create 12 char random string to store it to database

// insert value directly without having a model

        DB::table('password_resets')->insert([
            'email'=>$email,
            'token'=>$token,
//            'created_at'=>now()

        ]);
        //mail takes 3 parameter => view , data and will be token ,function
        //this is anonymous function that use this variable ($email)
        Mail::send('reset',['token'=>$token],function(Message $message) use($email){
            $message->subject('Reset your password !');
            $message->to($email);
        });
            return response([
                'massage'=>'Check your email'
            ]);


    }
    public function reset(ResetRequest $request){
        $passwordReset=DB::table('password_resets')//get data from database ... get password reset from token
            ->where('token',$request->input('token'))->first();//this will get the first record from password reset table

        // if we got the value ...if user isn't set that's mean the user doesnt exist
        if (!$user=User::where('email',$passwordReset->email)->first()){
            throw new NotFoundHttpException('User not found');
        }
        //the user is found
        $user->password =Hash::make($request->input('password'));
        $user->save();

        return response(
            [
                'message'=>'success'
            ]
        );
    }

}

