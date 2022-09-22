@extends('layouts.app')

@section('content')
    @php
        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY_DEV'));
        $numberItems = Cart::getContent()->count();
        $sessions = [];
        
    @endphp

    <div class="container-sm overflow-hidden">
        <div class="row text-center my-4">
            <div class="col-md-12 px-sm-0 ">
                <div class="alert alert-primary fs-3 fw-bolder mb-0" role="alert">
                    <span>Panier</span>
                </div>
            </div>
        </div>
        @if (Cart::isEmpty())
            <p>Votre panier est vide.</p>
        @else
        @for ($i = 0; $i < $numberItems; ++$i)
                @php
                    $cartItems = [];
                    $cartItem = Cart::getContent()->toArray();
                    foreach ($cartItem as $key => $value) {
                        $cartItems[] = $value;
                    }
                    $cartItem = Cart::get($cartItems[$i]['id']);
                    // dd($cartItems);
                    if (!empty($cartItem)) {
                        $buttonsRadioForOfferName = $cartItem->attributes->buttonsRadioForOffer != null ? ucfirst(substr($cartItem->attributes->buttonsRadioForOffer, 0, strpos($cartItem->attributes->buttonsRadioForOffer, 'Offer'))) : '';
                    }
                    $session = \Stripe\Checkout\Session::create([
                        'line_items' => [
                            [
                                'price_data' => [
                                    'currency' => 'eur',
                                    'product_data' => [
                                        'name' => $cartItem->name,
                                    ],
                                    'unit_amount' => ($cartItem->price + 14) * 100,
                                ],
                                'quantity' => 1,
                            ],
                        ],
                        'mode' => 'payment',
                        'success_url' => 'http://localhost:4242/success.html',
                        'cancel_url' => 'http://localhost:4242/cancel.html',
                    ]);
                    $sessions[] = $session;
                    // dd($session);
                @endphp
                <section class="row">
                    <div class="col-md-12 px-sm-0 mb-4">
                        <p
                            class="h4 py-3 text-center bgSecondaryLight mb-0 borderRadiusTop textSecondaryDarken text-uppercase fw-bolder">
                            {{ $cartItem->name }}</p>
                        <div class="card rounded-0">
                            <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>Récapitulatif de
                                    l'offre</span></div>
                            <div class="card-body">
                                <div class="row justify-content-evenly">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 ps-1 pe-0">
                                            <span class="fst-italic"><i
                                                    class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Formule
                                                choisie :</span>
                                            <span>{{ ucfirst($cartItem->attributes->form_level) }}</span>
                                        </div>
                                        @if ($cartItem->attributes->buttonsRadioForOffer)
                                            <div class="col-12 col-sm-6 ps-1 pe-0">
                                                <span class="fst-italic"><i
                                                        class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Option
                                                    :</span>
                                                <span>{{ $buttonsRadioForOfferName }}</span>
                                            </div>
                                        @endif
                                        @if ($cartItem->attributes->isFreeTrial == true)
                                            <div class="col-12 col-sm-6 ps-1 pe-0">
                                                <span class="fst-italic"><i
                                                        class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Option
                                                    :</span>
                                                <span>Offre d'essai</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col ps-1 pe-0">
                                            <span class="fst-italic"><i
                                                    class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Espace
                                                disque :</span>
                                            <span>{{ $cartItem->attributes->form_diskspace . ' Go' }}</span>
                                        </div>
                                    </div>

                                    @if ($cartItem->attributes->form_level === 'dédié')
                                        <div class="row">
                                            <div class="col ps-1 pe-0 d-flex align-item-center">
                                                <span class="d-flex align-items-center"><i
                                                        class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i></span>
                                                <div>
                                                    <span class="fst-italic">Domaine :</span>
                                                    <span>{{ $cartItem->attributes->domainUrlOrPrefix }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row px-1 mt-2">
                                        <div class="d-flex justify-content-end px-0">
                                            <a href="{{ route('offers', ['id' => $cartItem->id]) }}" class="me-2"><button
                                                    type="button" class="btn btn-primary">Modifier</button></a>
                                            <form action="{{ route('cart.remove', ['id' => $cartItem->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="text-end">
                                                    <button type=submit class="btn btn-danger">Supprimer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0">
                            <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert">
                                <span>{{ $cartItem->attributes->isFreeTrial == true ? "Offre d'essai gratuit" : "Proposition 1 : paiement à l'année" }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row border-bottom justify-content-evenly">
                                    <div class="text-end p-1">
                                        <span class="fw-bolder">Prix : <span>{{ $cartItem->price }} €</span></span>
                                    </div>
                                </div>
                                @if ($cartItem->attributes->isFreeTrial == false)
                                    <div class="row border-bottom">
                                        <div class="text-end p-1"><span class="text-primary fw-bolder">Adhésion obligatoire
                                                à l'association : 14.00 €</span></div>
                                    </div>
                                @endif

                                <div class="row justify-content-end pt-1">
                                    <div class="col text-end p-1"><span class="fw-bolder">Total :
                                            {{ $cartItem->attributes->isFreeTrial == false ? $cartItem->price + 14 : 0 }}
                                            €</span></div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col text-end align-self-center p-1">
                                        <button class="btn btn-primary" type="submit" id="{{ "paymentFormButton" . $i }}"><i
                                                class="fa-solid fa-cart-shopping me-1"></i>{{ $cartItem->attributes->isFreeTrial == true ? "Choisir la formule d'essai" : 'Choisir la formule annuelle' }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($cartItem->attributes->form_diskspace >= 170)
                            <div class="card rounded-0">
                                <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>Proposition
                                        2 : abonnement mensuel</span></div>
                                <div class="card-body">
                                    <div class="row border-bottom justify-content-evenly">
                                        <div class="text-end p-1">
                                            <span class="fw-bolder">Prix : <span>{{ $cartItem->attributes->priceMonthly }}
                                                    €</span></span>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="text-end p-1"><span class="text-primary fw-bolder">Adhésion obligatoire
                                                à l'association : 14.00 €</span></div>
                                    </div>

                                    <div class="row justify-content-end pt-1">
                                        <div class="text-end p-1"><span class="fw-bolder ">Premier mois :
                                                {{ $cartItem->attributes->priceMonthly + 14 }} €</span></div>
                                        <div class="text-end p-1"><span class="fw-bolder ">Abonnement mensuel :
                                                {{ $cartItem->attributes->priceMonthly }} €</span></div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col text-end align-self-center p-1">
                                            <button class="btn btn-primary" type="submit"
                                                id="{{ "paymentFormButton" . $i }}"><i
                                                    class="fa-solid fa-cart-shopping me-1"></i>Choisir la formule
                                                mensuelle</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($cartItem->attributes->coupon == true)
                            <div class="card borderRadiusBottom">
                                <div class="card-body">
                                    <form>
                                        @csrf
                                        <div class="mb-3" style="width: 270px">
                                            <label class="small mb-1" for="inputCoupon">Coupon de réduction</label>
                                            <input class="form-control" type="text" name="inputCoupon" id="inputCoupon">
                                        </div>
                                        <button class="btn btn-secondary" type="submit"><i
                                                class="fa-solid fa-ticket text-white me-1"></i>Appliquer à la
                                            commande</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            @endfor
            <section class="row justify-content-end">
                <div class="px-sm-0 col-auto">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <div class="text-end">
                                    <button type=submit class="btn btn-danger">Vider le panier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
    {{-- {{dd($sessions)}} --}}
@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.onload = function() {
            const stripe = Stripe(
                'pk_test_51LkoMCDcQMHfpUQViyNNZ6t7jsPrU7CZsyO6w5QITfkciGD0rA3qkmeIYZqeOYwzjfUYaLWowXdQZclZhchnoqRc00X0QzRRqd'
            );
            console.log(stripe);
            // const btn = document.getElementById("paymentFormButton")
            // const btns = document.querySelectorAll("#paymentFormButton")
            // console.log(btns);
            let j = 0;
            for (let i = 0; i < {{ $numberItems }}; i++) {
                let btns = document.querySelectorAll(`#paymentFormButton${i}`);
                
                let sessionIndex = `$sessions[${j}]->id`
                
                console.log(sessionIndex);
                
                btns.forEach((btn) => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        stripe.redirectToCheckout({
                            sessionId: `{!! ${sessionIndex} !!}`
                        })
                    })
                    j++;
                })
            }
        }
    </script>
@endpush
