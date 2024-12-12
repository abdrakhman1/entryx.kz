<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function feedback_submit(Request $request)
    {
        // Получаем текущее время
        $currentTime = Carbon::now();

        // Проверяем, есть ли информация о времени последней отправки формы в сессии
        $lastSubmitTime = $request->session()->get('last_submit_time');

        // Если информации нет или прошла минута с момента последней отправки формы
        if (!$lastSubmitTime || $currentTime->diffInMinutes($lastSubmitTime) >= 1) {
            // Отправляем форму
            // $request->validate([
            //     'name' => 'required',
            //     'phone' => 'required',
            //     'company_name' => 'required',
            //     'bin' => 'required',
            //     'user_requisites' => 'required',
            //     'user_certificate' => 'required',
            // ]);

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'company_name' => 'required',
                'bin' => 'required',
                'user_requisites' => 'required',
                'user_certificate' => 'required',
            ]);
        
            if ($validator->fails()) {
                return redirect()
                    ->to(url()->previous() . '#feedback_form')
                    ->withErrors($validator)
                    ->withInput();
            }
    
            Feedback::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'message' => 'Название компании: ' .$request->company_name . '. БИН: ' . $request->bin,
            ]);

            // Сохраняем текущее время как время последней отправки формы
            $request->session()->put('last_submit_time', $currentTime);
            
            // return redirect()->back()->with('success', 'Форма была успешно отправлена. Менеджер свяжется с вами в ближайшее время.');
            return redirect('/feedback_submited')->with('success', 'Форма была успешно отправлена. Менеджер свяжется с вами в ближайшее время.');
        } else {
            // Если прошла меньше минуты с момента последней отправки формы
            // Показываем пользователю сообщение о том, что можно отправить форму только раз в минуту
            return redirect()->back()->with('error', 'You can submit the form only once per minute.');
        }
    }

    public function index()
    {
        $feedbacks = Feedback::orderBy('id', 'desc')->get();
        return view('admin.feedbacks.index', compact('feedbacks'));
    }

    public function show(Feedback $feedback)
    {
        $feedback->read_at = now();
        $feedback->save();
        return view('admin.feedbacks.show', compact('feedback'));
    }

    public function feedback_submited(){
        return view('site.templates.pages.feedback_submited');
    }
}
