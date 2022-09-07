@extends('layouts.app')

@section('content')
    @php
        $itemId = '';
        foreach (Cart::getContent() as $item) {
            $itemId = $item->id;
        }
        $cartItem = Cart::get($itemId);
    @endphp

    <div class="container-sm overflow-hidden">
        <div class="row text-center">
            <div class="alert alert-primary fs-3 fw-bolder" role="alert">
                <span>Panier</span>
            </div>
        </div>
        @if (Cart::isEmpty())
            <p>Votre panier est vide.</p>
        @else
            <div class="row">
                <div class="col-md-12 px-sm-0 ">
                    <div class="card mb-2">
                        <div class="alert alert-secondary fw-bolder mb-1" role="alert"><span>Proposition 1 : paiement à l'année</span></div>
                        <div class="card-body">
                            <div class="row border-bottom">
                                <div class="col-7 p-1"><span class="text-primary fw-bolder">Adhésion obligatoire à l'association</span></div>
                                <div class="col text-end p-1"><span>14,00 €</span></div>
                            </div>
                            <div class="row border-bottom justify-content-evenly">
                                <div class="row">
                                    <div class="col text-primary ps-1"><span class="fw-bolder">Accès Dedikam</span></div>
                                </div>
                                <div class="row my-1">
                                    <div class="col ps-1 pe-0">
                                        <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Formule choisie :</span>
                                        <span>{{ $cartItem->attributes->form_level }}</span>
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col ps-1 pe-0">
                                        <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Espace disque :</span>
                                        <span>{{ $cartItem->attributes->form_diskspace }} Go</span>
                                    </div>
                                </div>
                                <div class="text-end p-1">
                                    <p class="fw-bolder">Prix : <span>{{ $cartItem->price }} €</span></p>
                                </div>
                            </div>
                            @if ($cartItem->attributes->coupon)
                                <div class="row border-bottom py-2">
                                    <div class="text-center align-self-center col-2">
                                        <a href="#"><i class="fa-solid fa-trash-can fs-2 text-danger"></i></a>
                                    </div>
                                    <div class="col p-1">
                                        <div class="row">
                                            <div class="col"><span class="text-primary fw-bolder">Coupon de déduction</span></div>
                                        </div>
                                        <div class="row ">
                                            <div class="col"><span>xxx--dfgdfs--zz444</span></div>
                                        </div>
                                    </div>
                                        <div class="col text-end p-1">
                                            <p class="fw-bolder">Réduction : <span>- 20,00 €</span></p>
                                        </div>
                                </div>
                            @endif
                            <div class="row justify-content-end pt-1">
                                <div class="col text-end p-1"><span class="fw-bolder">Total : {{ $cartItem->price + 14}} €</span></div>
                            </div>
                            <div class="row pt-1">
                                <div class="col text-end align-self-center p-1">
                                    <a class="btn btn-lg btn-primary fs-5 p-2 ms-2" href="#"><i class="fa-solid fa-cart-shopping me-1"></i>Choisir la formule annuelle</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($cartItem->attributes->form_diskspace >= 800)
                        <div class="card mb-2">
                            <div class="alert alert-secondary fw-bolder mb-1" role="alert"><span>Proposition 1 : abonnement mensuel</span></div>
                            <div class="card-body">
                                <div class="row border-bottom">
                                    <div class="col-7 p-1"><span class="text-primary fw-bolder">Adhésion obligatoire à l'association</span></div>
                                    <div class="col text-end p-1"><span>14,00 €</span></div>
                                </div>
                                <div class="row border-bottom justify-content-evenly">
                                    <div class="row">
                                        <div class="col text-primary ps-1"><span class="fw-bolder">Accès Dedikam</span></div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col ps-1 pe-0">
                                            <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Formule choisie :</span>
                                            <span>{{ $cartItem->attributes->form_level }}</span>
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col ps-1 pe-0">
                                            <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Espace disque :</span>
                                            <span>{{ $cartItem->attributes->form_diskspace }} Go</span>
                                        </div>
                                    </div>
                                    <div class="text-end p-1">
                                        <p class="fw-bolder">Prix : <span>{{ $cartItem->attributes->priceMonthly }} €</span></p>
                                    </div>
                                </div>
                                @if ($cartItem->attributes->coupon)
                                    <div class="row border-bottom py-2">
                                        <div class="text-center align-self-center col-2">
                                            <a href="#"><i class="fa-solid fa-trash-can fs-2 text-danger"></i></a>
                                        </div>
                                        <div class="col p-1">
                                            <div class="row">
                                                <div class="col"><span class="text-primary fw-bolder">Coupon de déduction</span></div>
                                            </div>
                                            <div class="row ">
                                                <div class="col"><span>xxx--dfgdfs--zz444</span></div>
                                            </div>
                                        </div>
                                            <div class="col text-end p-1">
                                                <p class="fw-bolder">Réduction : <span>- 20,00 €</span></p>
                                            </div>
                                    </div>
                                @endif
                                <div class="row justify-content-end pt-1">
                                    <div class="text-end p-1"><span class="fw-bolder ">Premier mois : {{ $cartItem->attributes->priceMonthly + 14}} €</span></div>
                                    <div class="text-end p-1"><span class="fw-bolder ">Abonnement mensuel : {{ $cartItem->attributes->priceMonthly }} €</span></div>
                                </div>
                                <div class="row pt-1">
                                    <div class="col text-end align-self-center p-1">
                                        <a class="btn btn-lg btn-primary fs-5 p-2 ms-2" href="#"><i class="fa-solid fa-cart-shopping me-1"></i>Choisir la formule mensuelle</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card mb-2">
                        <div class="card-body">
                            <form>
                                @csrf
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputCoupon">Coupon de réduction</label>
                                    <input class="form-control" type="text" name="inputCoupon" id="inputCoupon">
                                </div>
                                <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-ticket text-white me-1"></i>Appliquer à la commande</button>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger text-white">Vider le panier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @endsection
