@component('mail::message')
<h3>Hello {{$order->user->firstname}},</h3>
<p>Thanks for letting us serve you!</p>

@if($order->pickup)
    <h3>This order is for pickup</h3>
@else
    <h3>This order is for delivery:</h3>
    <p>{{$order->user->address}}</p>
    <p>{{$order->user->city}}</p>
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
    @foreach($order->order_histories as $item)
    <tr>
        <td>{{$item->quantity}}</td>
        <td>{{$item->item->name}}</td>
        @if($item->size_id == NULL)
            <td>n/a</td>
            <td>${{$item->item->prices[0]->price}}</td>
        @else
            @foreach($item->item->prices as $price)
                @if($price->size[0]->id == $order->size_id)
                    <td>{{$price->size[0]->size}}</td>
                    <td>${{$price->price * $item->quantity}}</td>
                @endif
            @endforeach
        @endif



        <td v-if="item.toppings.length > 0"
        >{{item.item_name}}<br> <span v-for="topping in item.toppings">{{topping.name}}, &nbsp;</span> </td>

        <td v-if="item.toppings.length == 0">{{item.item_name}}</td>

        <td>{{item.total_item_cost | currency}}</td>

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
