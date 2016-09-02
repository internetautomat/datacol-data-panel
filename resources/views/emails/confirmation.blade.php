Congratulations! You have successfully signed up for <b>{{ $data['registration']->session->event->title }}</b>.
<br><br>
Your registration ID is <b>{{ $data['registration']->id }}</b>. <br>

<address>
    <strong>{{ $contact->name }}</strong><br>
    Phone: {{ $contact->phone }}<br>
    Email: {{ $contact->email }}<br>
</address>

<br>


<table class="table table-striped">
    <thead>
    <tr>
        <th>Qty</th>
        <th>Item</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Event: {{ $data['registration']->session->event->title }}</td>
        <td>{{ $data['registration']->session->event->currency->abbr }}{{ $data['registration']->session->event->price }} </td>
    </tr>
    <tr>
        <td>1</td>
        <td>Session: {{$data['registration']->session->title }}</td>
        <td>{{ $data['registration']->session->event->currency->abbr }}{{ $data['registration']->session->price }} </td>
    </tr>
    </tbody>
</table>


<table class="table">
    <tr>
        <th style="width:50%">Subtotal:</th>
        <td>{{ $data['registration']->session->event->currency->abbr }}
            {{ $data['registration']->session->fullPrice() }} </td>
    </tr>
    <tr>
        <th>Early Bird Discount</th>
        <td> {{ $data['registration']->session->event->currency->abbr }}
            {{ $data['registration']->session->discount() }} </td>
    </tr>
    <tr>
        <th>Coupon discount:</th>
        <td>
            {{ $data['registration']->session->event->currency->abbr }}
            {{ $data['registration']->session->couponDiscount($data['coupon']) }}
        </td>
    </tr>
    <tr>
        <th>Total:</th>
        <td>
            {{ $data['registration']->session->event->currency->abbr }}
            {{ $data['registration']->session->discountedPriceWithCoupon($data['coupon']) }}
        </td>
    </tr>
</table>


<br>
Here is your barcode: <br><br>

<img src="{{ app('barcode')->make($data['registration']->id) }}"/>
