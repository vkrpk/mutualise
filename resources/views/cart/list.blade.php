@php
    $user = App\Models\User::find(Auth::user()->id);
@endphp

@extends('layouts.app')

@section('content')

    <div class="container-sm overflow-hidden">
        <div class="row text-center my-4">
            <div class="col-md-12 px-sm-0 ">
                <div class="alert alert-primary fs-3 fw-bolder mb-0" role="alert">
                    <span>{{__("Panier")}}</span>
                </div>
            </div>
        </div>
        @if (Cart::isEmpty())
            <p>{{__("Votre panier est vide.")}}</p>
        @else
            @foreach (Cart::getContent() as $cartItem)
                @php
                    if (!empty($cartItem)) {
                        $buttonsRadioForOfferName = $cartItem->attributes->buttonsRadioForOffer != null ? ucfirst(substr($cartItem->attributes->buttonsRadioForOffer, 0, strpos($cartItem->attributes->buttonsRadioForOffer, "Offer"))) : '';
                    }
                @endphp
                <section class="row" >
                    <div class="col-md-12 px-sm-0 mb-4">
                        <p class="h4 py-3 text-center bgSecondaryLight mb-0 borderRadiusTop textSecondaryDarken text-uppercase fw-bolder">{{ $cartItem->name }}</p>
                        <div class="card rounded-0">
                            <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>{{__("Récapitulatif de l'offre")}}</span></div>
                            <div class="card-body">
                                <div class="row justify-content-evenly">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 ps-1 pe-0">
                                            <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>{{__("Formule choisie")}} :</span>
                                            <span>{{ __(ucfirst($cartItem->attributes->form_level)) }}</span>
                                        </div>
                                        @if ($cartItem->attributes->buttonsRadioForOffer)
                                            <div class="col-12 col-sm-6 ps-1 pe-0">
                                                <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Option :</span>
                                                <span>{{ $buttonsRadioForOfferName }}</span>
                                            </div>
                                        @endif
                                        @if ($cartItem->attributes->isFreeTrial == true)
                                            <div class="col-12 col-sm-6 ps-1 pe-0">
                                                <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Option :</span>
                                                <span>{{__("Offre d'essai")}}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col ps-1 pe-0">
                                            <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>{{__("Espace disque")}} :</span>
                                            <span>{{ $cartItem->attributes->form_diskspace . ' Go' }}</span>
                                        </div>
                                    </div>

                                    @if ($cartItem->attributes->form_level === "dédié")
                                        <div class="row">
                                            <div class="col ps-1 pe-0 d-flex align-item-center">
                                                <span class="d-flex align-items-center"><i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i></span>
                                                <div>
                                                    <span class="fst-italic">{{__("Domaine")}} :</span>
                                                    <span>{{ $cartItem->attributes->domainUrlOrPrefix }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row px-1 mt-2">
                                        <div class="d-flex justify-content-end px-0">
                                            <a href="{{ route('offers', ["id" => $cartItem->id]) }}" class="me-2"><button type="button" class="btn btn-primary">{{__("Modifier")}}</button></a>
                                            <form action="{{ route('cart.remove', ["id" => $cartItem->id]) }}" method="POST">
                                                @csrf
                                                <div class="text-end">
                                                    <button type=submit class="btn btn-danger">{{__("Delete")}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0">
                            <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>{{ $cartItem->attributes->isFreeTrial == true ? __("Offre d'essai") : __("Proposition 1 : paiement à l'année")}}</span></div>
                            <div class="card-body">
                                <div class="row border-bottom justify-content-evenly">
                                    <div class="text-end p-1">
                                        <span class="fw-bolder">{{__("Prix")}} : <span>{{ $cartItem->price }} €</span></span>
                                    </div>
                                </div>
                                @if ($user->is_adherent == false ? ($cartItem->attributes->isFreeTrial == false ? : null) : null)
                                    <div class="row border-bottom">
                                        <div class="text-end p-1"><span class="text-primary fw-bolder">{{__("Adhésion obligatoire à l'association : 14.00 €")}}</span></div>
                                    </div>
                                    <div class="row justify-content-end pt-1">
                                        <div class="col text-end p-1"><span class="fw-bolder">Total : {{ $cartItem->attributes->isFreeTrial == false ? $cartItem->price + 14 : 0 }} €</span></div>
                                    </div>
                                @else
                                    <div class="row justify-content-end pt-1">
                                        <div class="col text-end p-1"><span class="fw-bolder">Total : {{ $cartItem->price }} €</span></div>
                                    </div>
                                @endif
                                <div class="row pt-1">
                                    <div class="col text-end align-self-center p-1">
                                        <button id="{{$cartItem->id}}" class="btn btn-primary" name="btnFormula" value="{{ $cartItem->attributes->isFreeTrial ? "free" : "yearly" }}"><i class="fa-solid fa-cart-shopping me-1"></i>{{ $cartItem->attributes->isFreeTrial == true ? __("Choisir la formule d'essai") : __("Choisir la formule annuelle") }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($cartItem->attributes->form_diskspace >= 170)
                            <div class="card rounded-0">
                                <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>{{__("Proposition 2 : abonnement mensuel")}}</span></div>
                                <div class="card-body">
                                    <div class="row border-bottom justify-content-evenly">
                                        <div class="text-end p-1">
                                            <span class="fw-bolder">{{__("Prix")}} : <span>{{ $cartItem->attributes->priceMonthly }} €</span></span>
                                        </div>
                                    </div>
                                    @if ($user->is_adherent == false)                                        
                                        <div class="row border-bottom">
                                            <div class="text-end p-1"><span class="text-primary fw-bolder">{{__("Adhésion obligatoire à l'association : 14.00 €")}}</span></div>
                                        </div>  
                                        <div class="row justify-content-end pt-1">
                                            <div class="text-end p-1"><span class="fw-bolder ">{{__("Premier mois")}} : {{ $cartItem->attributes->priceMonthly + 14}} €</span></div>
                                            <div class="text-end p-1"><span class="fw-bolder ">{{__("Abonnement mensuel")}} : {{ $cartItem->attributes->priceMonthly }} €</span></div>
                                        </div>
                                    @else
                                        <div class="row justify-content-end pt-1">
                                            <div class="text-end p-1"><span class="fw-bolder ">{{__("Abonnement mensuel")}} : {{ $cartItem->attributes->priceMonthly }} €</span></div>
                                        </div>
                                    @endif                                
                                    <div class="row pt-1">
                                        <div class="col text-end align-self-center p-1">
                                            <button id="{{$cartItem->id}}" class="btn btn-primary" name="btnFormula" value="monthly"><i class="fa-solid fa-cart-shopping me-1"></i>{{__("Choisir la formule mensuelle")}}</button>
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
                                            <label class="small mb-1" for="inputCoupon">{{__("Coupon de réduction")}}</label>
                                            <input class="form-control" type="text" name="inputCoupon" id="inputCoupon">
                                        </div>
                                        <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-ticket text-white me-1"></i>{{__("Appliquer à la commande")}}</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
                <input type="hidden" value={{ $cartItem->id }} form='formOrder' autocomplete='off'>
                @endforeach
                <section class="row justify-content-end" >
                <div class="px-sm-0 col-auto">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <div class="text-end">
                                    <button type=submit class="btn btn-danger">{{__("Vider le panier")}}</button>
                                </div>
                            </form>
                            <form action="{{ route('order.create') }}" method="POST" id="formOrder">
                                <input type="hidden" autocomplete='off' id="hiddenCartItemId" name="cartItemId">
                                <input type="hidden" autocomplete='off' id="hiddenFormula" name="formula_period">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        window.onload = function(){
            const inputHiddenCartItemId = document.getElementById('hiddenCartItemId');
            const inputHiddenFormula = document.getElementById('hiddenFormula');
            const buttons = document.querySelectorAll('button[name="btnFormula"]');
            
            buttons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    inputHiddenCartItemId.value = button.id;
                    inputHiddenFormula.value = button.value;
                    document.getElementById('formOrder').submit();
                })
            });
        }
    </script>
@endpush