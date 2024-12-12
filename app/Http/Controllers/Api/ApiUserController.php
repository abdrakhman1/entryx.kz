<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NewOrderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Amo;
use App\Models\Curl;
use App\Models\Notify;
use App\Models\Order;
use App\Models\Push;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Services\EmailService;

class ApiUserController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function createUser(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                    'repassword' => 'required|same:password',
                ]
            );

            $user = User::where('email', $request->email)->first();
            if ($user != null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Пользователь с таким email уже зарегистрирован'
                ],);
            }

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Ошибка валидации',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Вы успешно зарегистрировались',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function loginUser(Request $request)
    {

        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return $this->sendError($validateUser->errors());
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return $this->sendError('Неверный email или пароль.');
            }

            $user = User::where('email', $request->email)->first();
            $success['token'] = $user->createToken("API TOKEN")->plainTextToken;
            $success['user'] = $user;

            return $this->sendResponse($success, 'Выполнен вход');
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse(null, 'Вы вышли из системы');
    }

    public function user(Request $request)
    {
        return $this->sendResponse($request->user());
    }

    public function user_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError(['Не заполнены обязательные поля', $validator->errors()]);
        }

        $user = auth()->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return $this->sendResponse($user);
    }

    public function notify_index()
    {
        $notifies = Notify::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
        return $this->sendResponse($notifies);
    }

    public function change_pass(Request $request, User $user)
    {
        $request->validate([
            'newpass' => 'required|min:3',
            'renewpass' => 'required|same:newpass',
        ]);

        $user = auth()->user();

        $user->password = Hash::make($request->newpass);
        $user->save();
        return $this->sendResponse('Пароль был изменён');
    }

    public function notify_read(Notify $notify)
    {
        if (Auth::user()->id != $notify->user_id) {
            return abort(404);
        }
        $notify->read_at = now();
        $notify->save();
        return $this->sendResponse([
            'notify' => $notify,
            'unreaded_count' => Notify::unreaded_count()
        ]);
    }

    public function send_push($user_id)
    {
        $user = User::findOrFail($user_id);
        dump($user);
        $push = Push::send('Test id:' . $user->id, 'test2', $user->id);
        dump($user);
    }

    public function email_test(Request $request)
    {
        $order = Order::find(5);

        $result = $this->emailService->sendOrderConfirmation($order);

        return [
            'data' => $result
        ];
    }


}
