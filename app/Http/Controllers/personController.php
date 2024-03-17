<?php

namespace App\Http\Controllers;

use App\Models\person;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class personController extends Controller
{
    public function RegisterNewUser(Request $request)
    {
        try {
            $person = new person();
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
            if (empty($person->name) || empty($person->lastName) || empty($person->email || empty($person->phone) ||
                empty($person->address) || empty($person->enterprise) || empty($person->user) || empty($person->password))) {
                $json['code'] = 1;
                $json['message'] = 'Please enter all data';
                $json['data'] = null;
            } else {
                $registro = person::where('email', $person->email)->first();
                if ($registro) {
                    $json['code'] = 1;
                    $json['message'] = 'Email in use';
                    $json['data'] = null;
                } else {
                    if (ctype_digit($person->phone)) {
                        try {
                            $person->password = base64_encode($person->password);
                            $person->saveOrFail();
                            $json['code'] = 2;
                            $json['message'] = 'Successfully registered user';
                            $json['data'] = null;
                        } catch (ModelNotFoundException $e) {
                            $json['code'] = 1;
                            $json['message'] = $e->getMessage();
                            $json['data'] = null;
                        }
                    } else {
                        $json['code'] = 1;
                        $json['message'] = 'Please enter a valid phone number';
                        $json['data'] = null;
                    }
                }
            }
        } catch (Exception $exception) {
            $json['code'] = 1;
            $json['message'] = 'Transaction error';
            $json['data'] = null;
        } finally {
            return $json;
        }
    }

    public function logIn(Request $request)
    {
        $json = [];
        try {
            $user = $request->get("user");
            $password = $request->get("password");
            $registro = DB::table('persons')->where('email', $user)->orWhere('user', $user)->first();
            if ($registro) {
                if (base64_decode($registro->password) == $password) {
                    $json['code'] = 2;
                    $json['message'] = 'User Correct';
                    $json['data'] = $registro;
                } else {
                    $json['code'] = 1;
                    $json['message'] = 'Password Incorrect';
                    $json['data'] = null;
                }
            } else {
                $json['code'] = 1;
                $json['message'] = 'User incorrect';
                $json['data'] = null;
            }
        } catch (Exception $exception) {
            $json['code'] = 1;
            $json['message'] = 'Transact error';
            $json['data'] = null;
        } finally {
            return $json;
        }
    }

    public function ModifyUser(Request $request)
    {
        try {
            $person = person::where('id', $request->get('id'));
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
            if (empty($person->name) || empty($person->lastName) || empty($person->email || empty($person->phone) ||
                empty($person->address) || empty($person->enterprise) || empty($person->user) || empty($person->password))) {
                $json['code'] = 1;
                $json['message'] = 'Please enter all data';
                $json['data'] = null;
            } else {
                if (ctype_digit($person->phone)) {
                    try {
                        $person->password = base64_encode($person->password);
                        $person->saveOrFail();
                        $json['code'] = 2;
                        $json['message'] = 'Cambio de informacion correcta';
                        $json['data'] = null;
                    } catch (ModelNotFoundException $e) {
                        $json['code'] = 1;
                        $json['message'] = $e->getMessage();
                        $json['data'] = null;
                    }
                } else {
                    $json['code'] = 1;
                    $json['message'] = 'Please enter a valid phone number';
                    $json['data'] = null;
                }
            }
        } catch (Exception $exception) {
            $json['code'] = 1;
            $json['message'] = 'Transaction error';
            $json['data'] = null;
        } finally {
            return $json;
        }
    }

    public function logInWeb(Request $request)
    {
        try {
            $user = $request->get("user");
            $password = $request->get("password");
            $registro = DB::table('persons')->where('email', $user)->orWhere('user', $user)->first();
            if ($registro) {
                if (base64_decode($registro->password) == $password) {
                    return view('Home');
                } else {
                    return redirect()->back()->withErrors(['error' => 'El usuario y la contraseña no son validos']);
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Su usuario no existe']);
            }
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'Ocurrio un error durante la ejecucion']);
        }
    }

    public function RegisterNewUserWeb(Request $request)
    {
        try {
            $person = new person();
            $person->name = $request->get('name');
            $person->lastName = $request->get('lastName');
            $person->email = $request->get('email');
            $person->phone = $request->get('phone');
            $person->address = $request->get('address');
            $person->enterprise = $request->get('enterprise');
            $person->user = $request->get('user');
            $person->password = $request->get('password');
            $person->type_user_id = 1;
            $registro = person::where('email', $person->email)->first();
            if ($registro) {
                return redirect()->back()->withErrors(['error' => 'El correo ya esta en uso']);
            } else {
                if (ctype_digit($person->phone)) {
                    try {
                        $person->password = base64_encode($person->password);
                        $person->saveOrFail();
                        return view('Welcome');
                    } catch (ModelNotFoundException $e) {
                        return redirect()->back()->withErrors(['error' => 'Ocurrio un problema, intentelo mas tarde']);
                    }
                } else {
                    return redirect()->back()->withErrors(['error' => 'Ingrese un numero de telefono valido']);
                }
            }
        } catch (Exception $exception) {
            return redirect()->back()->withErrors(['error' => 'Ocurrio un problema, intentelo mas tarde']);
        }
    }
}
