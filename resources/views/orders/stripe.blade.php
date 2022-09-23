@php

\Stripe\Stripe::setApiKey(env('APP_ENV') === 'production' ? env('STRIPE_SECRET_KEY_PROD') : env('STRIPE_SECRET_KEY_DEV'));

$session = \Stripe\Checkout\Session::create([
    'line_items' => [
        [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $item->name,
                ],
                'unit_amount' => $price,
            ],
            'quantity' => 1,
        ],
    ],
    'mode' => 'payment',
    'success_url' => 'http://localhost:4242/success.html',
    'cancel_url' => 'http://localhost:4242/cancel.html',
]);

@endphp

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.onload = function() {
            const stripe = Stripe("{{ env('STRIPE_PUBLIC_KEY') }}");
            const btn = document.getElementById('createCheckoutSession');

            btn.addEventListener('click', function(e) {
                e.preventDefault();
                stripe.redirectToCheckout({
                    sessionId: `{!! $session->id !!}`
                })
            })
        }
    </script>
@endpush
