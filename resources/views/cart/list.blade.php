@extends('layouts.app')

@section('content')


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
            @foreach (Cart::getContent() as $cartItem)
                @php
                    if (!empty($cartItem)) {
                        $buttonsRadioForOfferName = $cartItem->attributes->buttonsRadioForOffer != null ? ucfirst(substr($cartItem->attributes->buttonsRadioForOffer, 0, strpos($cartItem->attributes->buttonsRadioForOffer, "Offer"))) : '';
                    }
                @endphp
                <section class="row" >
                    <div class="col-md-12 px-sm-0">
                        <p class="h4 py-3 text-center bgSecondaryLight mb-0 borderRadiusTop textSecondaryDarken text-uppercase fw-bolder">{{ $cartItem->name }}</p>
                        <div class="card rounded-0">
                            <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>Récapitulatif de l'offre</span></div>
                            <div class="card-body">
                                <div class="row justify-content-evenly">
                                    <div class="row my-1">
                                        <div class="col ps-1 pe-0">
                                            <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Formule choisie :</span>
                                            <span>{{ ucfirst($cartItem->attributes->form_level) }}</span>
                                            @if ($cartItem->attributes->buttonsRadioForOffer)
                                                <span class="fst-italic ms-4"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Option :</span>
                                                <span>{{ $buttonsRadioForOfferName }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col ps-1 pe-0">
                                            <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Espace disque :</span>
                                            <span>{{ $cartItem->attributes->form_level === 'dédié' ? 'Illimité' : $cartItem->attributes->form_diskspace . ' Go' }}</span>
                                        </div>
                                    </div>
                                    <div class="row my-1 px-1">
                                        <div class="d-flex justify-content-end px-0">
                                            <a href="{{ route('services', ["id" => $cartItem->id]) }}" class="me-2"><button type="button" class="btn btn-primary">Modifier</button></a>
                                            <form action="{{ route('cart.remove', ["id" => $cartItem->id]) }}" method="POST">
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
                            <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>Proposition 1 : paiement à l'année</span></div>
                            <div class="card-body">
                                <div class="row border-bottom justify-content-evenly">
                                    <div class="text-end p-1">
                                        <span class="fw-bolder">Prix : <span>{{ $cartItem->price }} €</span></span>
                                    </div>
                                </div>
                                <div class="row border-bottom">
                                    <div class="text-end p-1"><span class="text-primary fw-bolder">Adhésion obligatoire à l'association : 14.00 €</span></div>
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
                                        <a class="btn btn-primary" href="#"><i class="fa-solid fa-cart-shopping me-1"></i>Choisir la formule annuelle</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($cartItem->attributes->form_diskspace >= 170)
                            <div class="card rounded-0">
                                <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>Proposition 2 : abonnement mensuel</span></div>
                                <div class="card-body">
                                    <div class="row border-bottom justify-content-evenly">
                                        <div class="text-end p-1">
                                            <span class="fw-bolder">Prix : <span>{{ $cartItem->attributes->priceMonthly }} €</span></span>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="text-end p-1"><span class="text-primary fw-bolder">Adhésion obligatoire à l'association : 14.00 €</span></div>
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
                                            <a class="btn btn-primary" href="#"><i class="fa-solid fa-cart-shopping me-1"></i>Choisir la formule mensuelle</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="card borderRadiusBottom mb-4">
                            <div class="card-body">
                                <form>
                                    @csrf
                                    <div class="mb-3 col-6" style="max-width: 253px">
                                        <label class="small mb-1" for="inputCoupon">Coupon de réduction</label>
                                        <input class="form-control" type="text" name="inputCoupon" id="inputCoupon">
                                    </div>
                                    <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-ticket text-white me-1"></i>Appliquer à la commande</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
            <section class="row justify-content-end" >
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
@endsection
