@component('mail::message')

Hello, {{$fullname}}!
<p>
    Your order for a custom <b>{{$guitarmodel}}</b> has been reviewed by us.
    The total cost of your guitar has come to USD. <b>{{$totalPrice}}</b>.
</p>
<p>
    If you wish to proceed further with the guitar building process, you can pay 50% of the price and we will start production.
    The build time can be up to 12 weeks, depending on the specifications.
    You can view the payment options below.
</p>

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
See Invoice
@endcomponent

Sincerely,
Sahana Guitars Team
Koteshwor, Kathmandu
Nepal

@endcomponent
