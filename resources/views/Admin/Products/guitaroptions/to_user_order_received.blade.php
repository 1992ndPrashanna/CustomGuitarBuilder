@component('mail::message')
<h2>Thank you for your order, {{$fullname}}!</h2>
<p>
    You just placed an order for a custom {{$guitarmodel}}!<br>
    A member of <b>Sahana Guitar</b>'s team will reach out to you with the total price of your custom guitar!
    The following are your credentials to view your order:
    <ul style="list-style-type:none;">
        <li><b>Email</b> : {{$email}}</li>
        <li><b>Order ID</b> : {{$uuid}}</li>
    </ul>
</p>

<p>
    The <b>Order ID</b> acts as your password to view your order details, and access the payment system, <b>please keep it secure</b>!
</p>

<p>
    You can direct any further question as a reply to this email or reach out to us in our social media page.
    <ul style="list-style-type:none;">
        <li><b>Facebook </b>: <a href="www.facebook.com/sahanaguitars">Sahana Guitars</a></li>
        <li><b>Instagram </b>: <a href="www.instagram.com/sahanaguitars">@sahanaguitars</a></li>
    </ul>
</p>

<p>
    You can view your order details directly via the link/button below!
</p>

@component('mail::button', ['url' =>'http://127.0.0.1:8000'])
View Order Details!
@endcomponent

    Sincerely,
    Sahana Guitars Team
    Koteshwor, Kathmandu
    Nepal

@endcomponent
