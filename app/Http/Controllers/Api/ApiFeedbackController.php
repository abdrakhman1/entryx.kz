<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ApiFeedbackController extends Controller
{
    public function feedback_simple_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError(['Не заполнены обязательные поля']);
        }


        Feedback::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'message' => $request->comment,
            'read_at' => null,
        ]);

        return $this->sendResponse('', 'Форма была успешно отправлена. Менеджер свяжется с вами в ближайшее время');
    }

    public function dealer(Request $request) //форма "хотите стать дилером?"
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:32',
            'phone' => 'required|max:11|min:8',
            'company_name' => 'required',
            'bin' => 'required|digits:12',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Ошибка валидации', $validator->errors());
        }
        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            return $this->sendError('Данный номер уже зарегистрирован', '');
        }

        Feedback::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'message' => 'Заявка на регистрацию дилера от компании: ' . $request->company_name . '. БИН: ' . $request->bin,
            'read_at' => null,
        ]);

        $success['name'] =  $request->name;

        return $this->sendResponse($success, 'Заявка на регистрацию отправлена');
    }
}
