@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1 class="admin_title title-p">Sync</h1>

        <a class="btn btn_add mb-3" href="/admin/sync/sync_products" target="_blank">
            Синхронизировать товары
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-2 h-2" style="height: 31px;">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9.75v6.75m0 0-3-3m3 3 3-3m-8.25 6a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
            </svg>
        </a>

        <a class="btn btn_add mb-3" href="/admin/sync/sync_users" target="_blank">
            Синхронизировать пользователей дилеров
            <svg fill="#ffffff" width="31px" height="31px" viewBox="0 0 32 32" version="1.1"
                xmlns="http://www.w3.org/2000/svg">
                <title>users</title>
                <path
                    d="M16 21.416c-5.035 0.022-9.243 3.537-10.326 8.247l-0.014 0.072c-0.018 0.080-0.029 0.172-0.029 0.266 0 0.69 0.56 1.25 1.25 1.25 0.596 0 1.095-0.418 1.22-0.976l0.002-0.008c0.825-3.658 4.047-6.35 7.897-6.35s7.073 2.692 7.887 6.297l0.010 0.054c0.127 0.566 0.625 0.982 1.221 0.982 0.69 0 1.25-0.559 1.25-1.25 0-0.095-0.011-0.187-0.031-0.276l0.002 0.008c-1.098-4.78-5.305-8.295-10.337-8.316h-0.002zM9.164 11.102c0 0 0 0 0 0 2.858 0 5.176-2.317 5.176-5.176s-2.317-5.176-5.176-5.176c-2.858 0-5.176 2.317-5.176 5.176v0c0.004 2.857 2.319 5.172 5.175 5.176h0zM9.164 3.25c0 0 0 0 0 0 1.478 0 2.676 1.198 2.676 2.676s-1.198 2.676-2.676 2.676c-1.478 0-2.676-1.198-2.676-2.676v0c0.002-1.477 1.199-2.674 2.676-2.676h0zM22.926 11.102c2.858 0 5.176-2.317 5.176-5.176s-2.317-5.176-5.176-5.176c-2.858 0-5.176 2.317-5.176 5.176v0c0.004 2.857 2.319 5.172 5.175 5.176h0zM22.926 3.25c1.478 0 2.676 1.198 2.676 2.676s-1.198 2.676-2.676 2.676c-1.478 0-2.676-1.198-2.676-2.676v0c0.002-1.477 1.199-2.674 2.676-2.676h0zM31.311 19.734c-0.864-4.111-4.46-7.154-8.767-7.154-0.395 0-0.784 0.026-1.165 0.075l0.045-0.005c-0.93-2.116-3.007-3.568-5.424-3.568-2.414 0-4.49 1.448-5.407 3.524l-0.015 0.038c-0.266-0.034-0.58-0.057-0.898-0.063l-0.009-0c-4.33 0.019-7.948 3.041-8.881 7.090l-0.012 0.062c-0.018 0.080-0.029 0.173-0.029 0.268 0 0.691 0.56 1.251 1.251 1.251 0.596 0 1.094-0.417 1.22-0.975l0.002-0.008c0.684-2.981 3.309-5.174 6.448-5.186h0.001c0.144 0 0.282 0.020 0.423 0.029 0.056 3.218 2.679 5.805 5.905 5.805 3.224 0 5.845-2.584 5.905-5.794l0-0.006c0.171-0.013 0.339-0.035 0.514-0.035 3.14 0.012 5.765 2.204 6.442 5.14l0.009 0.045c0.126 0.567 0.625 0.984 1.221 0.984 0.69 0 1.249-0.559 1.249-1.249 0-0.094-0.010-0.186-0.030-0.274l0.002 0.008zM16 18.416c-0 0-0 0-0.001 0-1.887 0-3.417-1.53-3.417-3.417s1.53-3.417 3.417-3.417c1.887 0 3.417 1.53 3.417 3.417 0 0 0 0 0 0.001v-0c-0.003 1.886-1.53 3.413-3.416 3.416h-0z">
                </path>
            </svg>
        </a>

        <ul>
            <li>
                <a href="/admin/sync/test" target="_blank">test</a>
            </li>
            <li>
                <a href="/admin/sync/ip" target="_blank">ip</a>
            </li>
            <li>
                ----
            </li>
            <li>
                <a href="/admin/sync/products" target="_blank">products</a>
            </li>
            <li>
                <a href="/admin/sync/sync_products" target="_blank">sync_products</a>
            </li>
            <li>
                ----
            </li>
            <li>
                <a href="/admin/sync/new_user" target="_blank">new_user</a>
            </li>
            <li>
                <a href="/admin/sync/user_update" target="_blank">user_update</a>
            </li>
            <li>
                <a href="/admin/sync/get_user/123456789012" target="_blank">get_user/123456789012</a>
            </li>
            <li>
                ----
            </li>
            <li>
                <a href="/admin/sync/get_order" target="_blank">get_order</a>
            </li>
            <li>
                <a href="/admin/sync/new_order" target="_blank">new_order</a>
            </li>
            <li>
                <a href="/admin/sync/get_order/a907d127-41ec-11ee-a06b-b42e9919ece8" target="_blank">get_order /
                    a907d127-41ec-11ee-a06b-b42e9919ece8</a>
            </li>
            <li>
                <a href="/admin/sync/get_orders_by_user_bin/123456789012" target="_blank">get_orders_by_user_bin /
                    123456789012</a>
            </li>
            <li>
                <a href="/admin/sync/order_upload" target="_blank">order_upload (set_status done)</a>
            </li>
            <li>
                <a href="/admin/sync/order_cancel" target="_blank">order_cancel</a>
            </li>
            <li>
                <a href="/admin/sync/order_upload_online" target="_blank">order_upload_online</a>
            </li>

            <li>
                <a href="/admin/sync/user_test" target="_blank">User test</a>
            </li>

            <li>
                <a href="/admin/sync/remains_test" target="_blank">Remains test</a>
            </li>
            <li>
                <a href="/admin/sync/sync_users" target="_blank">sync_users</a>
            </li>



        </ul>





        <form action="{{ route('admin.sync.get') }}" method="post">
            @csrf
            {{ env('1C_SERVER') }}<input type="text" name="url" id="">
            <input type="submit" value="send">
        </form>
    </div>
@endsection
