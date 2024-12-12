<?php

namespace App\Http\Controllers;

use App\Models\Amo;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
                'user_requisites' => 'nullable|file|max:4086',
                'user_certificate' => 'nullable|file|max:4086',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->to(url()->previous() . '#feedback_form')
                    ->withErrors($validator)
                    ->withInput();
            }

            $path1 = '';
            if ($request->file('user_requisites')){
                $path1 = $request->file('user_requisites')->store('files');
            }

            $path2 = '';
            if ($request->file('user_certificate')){
                $path2 = $request->file('user_certificate')->store('files');
            }

            Feedback::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'message' => 'Название компании: ' . $request->company_name . '. БИН: ' . $request->bin,
                'filepath1' => $path1,
                'filepath2' => $path2,
                'read_at' => null,
            ]);

            // Сохраняем текущее время как время последней отправки формы
            $request->session()->put('last_submit_time', $currentTime);

            //AMO
            $payload = [
                [
                    "name" => "Запрос на дилера с сайта",
                    "created_by" => 0,
                    "price" => 0,
                    '_embedded' => [
                        'contacts' => [
                            [
                                'name' => $request->name,
                                "custom_fields_values" => [
                                    [
                                        "field_code" => "PHONE",
                                        "values" => [
                                            [
                                                "enum_code" => "WORK",
                                                "value" => $request->phone
                                            ]
                                        ]
                                    ],
                                ]
                            ],
                        ],
                        "companies" => [
                            [
                                "name" => $request->company_name,
                                "custom_fields_values" => [
                                    [
                                        "field_name" => "БИН",
                                        "field_id" => 396143,
                                        "values" => [
                                            [
                                                'value' => $request->bin
                                            ]
                                        ]
                                    ]
                               ]
                            ]
                        ]
                    ]
                ],
            ];

            $amo = new Amo();
            $result_amo[1] = $amo->post('leads/complex', $payload);
            Log::info('result_amo leads/complex:', $result_amo);


            // return redirect()->back()->with('success', 'Форма была успешно отправлена. Менеджер свяжется с вами в ближайшее время.');
            return redirect('/feedback_submited')->with('success', 'Форма была успешно отправлена. Менеджер свяжется с вами в ближайшее время.');
        } else {
            // Если прошла меньше минуты с момента последней отправки формы
            // Показываем пользователю сообщение о том, что можно отправить форму только раз в минуту
            return redirect()->back()->with('error', 'You can submit the form only once per minute.');
        }
    }

    public function feedback_simple_submit(Request $request)
    {
        $currentTime = Carbon::now();
        $lastSubmitTime = $request->session()->get('last_submit_time');

        if (!$lastSubmitTime || $currentTime->diffInMinutes($lastSubmitTime) >= 1) {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->to(url()->previous() . '#feedback_simple_form')
                    ->withErrors($validator)
                    ->withInput();
            }


            Feedback::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'message' => $request->comment,
                'read_at' => null,
            ]);

            $request->session()->put('last_submit_time', $currentTime);

            $payload = [
                [
                    "name" => "Вопрос с сайта",
                    "created_by" => 0,
                    "price" => 0,
                    "custom_fields_values" => [
                        [
                            "field_id" => 376557,
                            "values" => [
                                [
                                    "value" => "Вопрос с сайта: " . $request->comment
                                ]
                            ]
                        ]
                    ],
                    '_embedded' => [
                        'contacts' => [
                            [
                                'name' => $request->name,
                                "custom_fields_values" => [
                                    [
                                        "field_code" => "PHONE",
                                        "values" => [
                                            [
                                                "enum_code" => "WORK",
                                                "value" => $request->phone
                                            ]
                                        ]
                                    ],
                                ]
                            ],
                        ]
                    ]
                ],
            ];

            $amo = new Amo();
            $result_amo[1] = $amo->post('leads/complex', $payload);

            Log::info('result_amo leads/complex:', $result_amo);

            return redirect('/feedback_submited')->with('success', 'Форма была успешно отправлена. Менеджер свяжется с вами в ближайшее время.');
        } else {
            return redirect()->back()->with('error', 'You can submit the form only once per minute.');
        }
    }

    public function index()
    {
        $feedbacks = Feedback::orderBy('id', 'desc')->paginate(20);
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

    public function download_file(Feedback $feedback, $filenumber)
    {
        // dd($feedback);
        $path = match ($filenumber) {
            "1" => $feedback->filepath1,
            "2" => $feedback->filepath2,
        };
        // $path = $feedback->filepath1 . $filenumber;
        // dd($path);
        return Storage::download($path);
    }
}
