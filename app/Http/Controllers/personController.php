<?php

namespace App\Http\Controllers;

use App\Models\person;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class personController extends Controller
{
    public function RegisterNewUser(Request $request){
        $person= new person();
        $json = [];
        $person->name = $request->get('name');
        $person->lastName = $request->get('lastName');
        $person->email = $request->get('email');
        $person->phone = $request->get('phone');
        $person->address = $request->get('address');
        $person->enterprise = $request->get('enterprise');
        $person->user = $request->get('user');
        $person->password = $request->get('password');
        $person->type_user_id = 1;
        if(empty($person->name)||empty($person->lastName)||empty($person->email||empty($person->phone)||
        empty($person->address)||empty($person->enterprise)||empty($person->user)||empty($person->password))){
            $json['code'] = 1;
            $json['message']= 'Please enter all data';
            $json['data']= null;
        }else{
            $registro = person::where('email', $person->email)->first();
            if($registro){
                $json['code'] = 1;
                $json['message']= 'Email in use';
                $json['data']= null;
            }
            else{
                if(ctype_digit($person->phone)){
                    try{
                        $person->password=base64_encode($person->password);
                        $person->saveOrFail();
                        $json['code'] = 2;
                        $json['message']= 'Successfully registered user';
                        $json['data']= null;
                    }catch(ModelNotFoundException $e){
                        $json['code'] = 1;
                        $json['message']= $e->getMessage();
                        $json['data']= null;
                    }
                }else{
                    $json['code'] = 1;
                    $json['message']= 'Please enter a valid phone number';
                    $json['data']= null;
                }
            }
        }
        return $json;
    }
}
