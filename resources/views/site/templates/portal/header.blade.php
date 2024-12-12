<div class="header no_show_mobile">
    <a class="butn_nav butn_orders" href="{{ route('portal.user.orders') }}">Текущие заказы
    </a>
    <div class="flex gap-2">
        <a class="butn_nav butn_shopping-cart" href="{{ route('portal.user.cart') }}">
            Корзина
            @if ($cart->count())
                <div class="notice_elem"> {{ $cart->count() }} </div>
            @endif
        </a>
        <a class="butn_nav butn_notice notice_call" href="#!">Уведомления
            @if ($unreaded_count > 0)
                <div class="notice_elem">
                    {{ $unreaded_count }}
                </div>
            @endif

        </a>
    </div>
</div>
