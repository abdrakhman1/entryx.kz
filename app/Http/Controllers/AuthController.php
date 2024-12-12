<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:32',
            'phone' => 'required|max:11|min:8',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Ошибка валидации', $validator->errors());
        }

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            return $this->sendError('Данный номер уже зарегистрирован', '');
        }
   
        $input = $request->all(); 
        $input['password'] = bcrypt(Str::random(8));
        $input['expiration_date'] = Carbon::now()->addMinutes(10);
        $input['verification_code'] = rand(1112, 9998);
        $input['role_id'] = 2;
        $user = User::create($input);

        Helper::send_sms($request->phone, 'Код подтверждения:  ' . $input['verification_code']);

        $success['name'] =  $user->name;    
   
        return $this->sendResponse($success, 'Пользователь упешно зарегистрирован');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Ошибка валидации', $validator->errors());
        }

        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->sendError('Ошибка входа', ['error'=>'Unauthorised']);
        }

        $success['token'] =  $user->createToken('MyAuthApp', ['test12'])->plainTextToken; 
        $success['name'] =  $user->name;
        $success['user_id'] = $user->id;

        return $this->sendResponse($success, 'Выполнен вход');

    }

    public function send_code(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Ошибка валидации', $validator->errors());
        }

        $user = User::where('phone', '=', $request->phone)->first();
        if (!$user) {
            return $this->sendError('Неправильный номер телефон', ['error'=>'Unauthorised']);
        }
        $user->expiration_date = Carbon::now()->addMinutes(10);
        $user->verification_code = rand(1112, 9998);
        $user->save();

        // SMS send
        Helper::send_sms($request->phone, 'Код подтверждения: ' . $user->verification_code);

        return $this->sendResponse('SMS отправлено', 'SMS отправлено');
    }

    public function auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'code' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Ошибка валидации', $validator->errors());
        }

        $user = User::where('phone', $request->phone)
                ->where('verification_code', $request->code)
                ->first();

        if (!$user) {
            sleep(10);
            return $this->sendError('Ошибка авторизации', ['error'=>'Unauthorised']);
        }

        if ($user->expiration_date < Carbon::now()) {
            return $this->sendError('Ошибка авторизации.', ['error'=>'Code expired']);
        } else {
            $success['token'] = $user->createToken('MyAuthApp', ['test12'])->plainTextToken; 
            $success['name'] = $user->name;
            $success['user_id'] = $user->id;
            $user->verification_code = null;
            $user->save();
   
            return $this->sendResponse($success, 'Выпонен вход');
        };
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Токен анулирован'
        ];
    }
}
