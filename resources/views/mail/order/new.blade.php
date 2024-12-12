<style>
    table {
        border: 1px solid #999;
    }

    td,
    th {
        /* table cells */
        border: 1px solid #bbb;
        padding: 10px;
    }
</style>

<h1>Новый заказ № {{ $order->id }} </h1>
<div>
    ФИО: {{ $order->user->name }}
</div>
<div>
    Общая сумма: <b>{{ $order->total_amount }} ₸</b>
</div>
<div>
    Способ оплаты: {{ $order->paymentMethod->title }}
</div>
<br>
<a href="{{ url('admin/orders/' . $order->id) }}">Посмотреть заказ в панели управления</a>

<h2>Позиции</h2>
<table>
    <tr>
        <td><b>Название</b></td>
        <td><b>Количество</b></td>
        <td><b>Цена</b></td>
        <td><b>Сумма</b></td>
    </tr>
    @foreach ($order->items as $item)
        <tr>
            <td>
                {{ $item->product->title }}
                {{ $item->variant->title ?? '' }}
            </td>
            <td>
                {{ $item->quantity }}
            </td>
            <td>
                @if ($item->variant)
                    {{ $item->variant->price }}
                @else
                    {{ $item->product->price }}
                @endif
            </td>
            <td>
                @if ($item->variant)
                    {{ $item->variant->price * $item->quantity }}
                @else
                    {{ $item->product->price * $item->quantity }}
                @endif
            </td>
        </tr>
    @endforeach
</table>
