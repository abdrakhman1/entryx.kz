@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/portal/post-policy.css') }}" />

    <script src="https://widget.cloudpayments.ru/bundles/paymentblocks.js"></script>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
            <li class="breadcrumb-item"><a href="{{ route('portal.index') }}">Главная</a></li>
            <li class="breadcrumb-item"><a href="{{ route('portal.user.orders') }}">Заказы</a></li>
            <li class="breadcrumb-item" aria-current="page">
                <a href="/portal/orders/{{ $order->id }}">Заказ №{{ $order->id }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Онлайн оплата
            </li>
        </ol>
    </nav>
    <div class="title_page">Онлайн оплата</div>

    <div>
        <div class="pay_element_wrapper">
            <div id="pay_element"></div>
        </div>
    </div>

    <script>
        var json_data = {
            'cloudPayments': {
                'orderData': {
                    'id': "{{ $order->id }}",
                    'user_id': "{{ $order->user->id }}",
                }
            }
        };

        var blocksApp = new cp.PaymentBlocks({
            publicId: "{{ config('app.cloudpayments_public_id') }}",
            description: "Оплата заказа № {{ $order->id }}",
            amount: {{ $order->total_amount }},
            currency: "KZT",
            invoiceId: "{{ $order->id }}",
            accountId: "{{ $order->user->email }}",
            email: "{{ $order->user->email }}",
            requireEmail: false,
            language: "ru-RU",
            applePaySupport: false,
            googlePaySupport: false,
            yandexPaySupport: false,
            sbpSupport: false,
            data: json_data
        }, {
            appearance: {
                colors: {
                    primaryButtonColor: "#2E71FC",
                    primaryButtonTextColor: "#FFFFFF",
                    primaryHoverButtonColor: "#2E71FC",
                    primaryButtonHoverTextColor: "#FFFFFF",
                    activeInputColor: "#0B1E46",
                    inputBackground: "#FFFFFF",
                    inputColor: "#8C949F",
                    inputBorderColor: "#E2E8EF",
                    errorColor: "#EB5757"
                },
                borders: {
                    radius: "8px"
                }
            },
            components: {
                paymentButton: {
                    text: "Оплатить",
                    fontSize: "16px"
                },
                paymentForm: {
                    labelFontSize: "16px",
                    activeLabelFontSize: "12px",
                    fontSize: "16px"
                }
            }
        });


        blocksApp.mount(document.getElementById("pay_element"));

        blocksApp.on("destroy", () => {
            console.log("destroy");
        });
        blocksApp.on("success", (result) => {
            console.log("success", result);
        });
        blocksApp.on("fail", (result) => {
            console.log("fail", result);
        });
    </script>
@endsection
