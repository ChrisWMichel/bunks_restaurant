@component('mail::message')
<h3>Hello {{$order->user->firstname}},</h3>
<p>Thanks for letting us serve you!</p>

@if($order->pickup)
<h3>This order is for pickup</h3>
@else
<h3>This order is for delivery:</h3>
<p>{{$order->user->address}}<br>
    {{$order->user->city}}</p>
@endif

@if($order->notes)
<p>
<b>Your message to us:</b>
{{$order->notes}}
</p>
@endif

<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th>Qnty</th>
<th>Item</th>
<th>Size</th>
<th>Price</th>
</tr>
</thead>
<tbody>
@foreach($order_history as $item)
    <tr>
        <td>{{$item->quantity}}</td>

        @if(count($item->ordered_toppings))
            <td>{{$item->item->name}}<br>
                - &nbsp;
                @foreach($item->ordered_toppings as $topping)
                    {{$topping->topping}}, &nbsp;
                @endforeach
                {{'($' .($item->toppings_cost). ')'}}
            </td>
        @else
            <td>{{$item->item->name}}</td>
        @endif

        @if($item->size_id == NULL)
            <td>n/a</td>
            <td>${{$item->item->prices[0]->price * $item->quantity}}</td>
        @else
            @foreach($item->item->prices as $price)
                @if($price->size[0]->id == $item->size_id)
                    <td>{{$price->size[0]->size}}</td>
                    <td>${{$price->price * $item->quantity}}</td>
                @endif
            @endforeach
        @endif
    </tr>
@endforeach

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><b>Total w/ tax</b></td>
<td><b>${{$order->total}}</b></td>
</tr>
</tbody>
</table>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
