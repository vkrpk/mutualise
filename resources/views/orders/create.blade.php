@php
    $address = \App\Models\Addresses::where("user_id", Auth::id())->first();
    $item = \Cart::get($cartItemId);
    $buttonsRadioForOfferName = $item->attributes->buttonsRadioForOffer != null ? ucfirst(substr($item->attributes->buttonsRadioForOffer, 0, strpos($item->attributes->buttonsRadioForOffer, 'Offer'))) : '';
@endphp

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header customCardHeader">
                        <span>{{__("Adresse de facturation")}}</span>
                    </div>
                    <div class="card-body">
                        <x-adresses-card :address="$address" :form="'formRecapOrder'"/>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header customCardHeader">
                        <span>{{__("E-Mail Address")}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if ($item->attributes->isFreeTrial == true || $item->attributes->form_level === 'standard' || $item->attributes->form_level === 'entreprise' )
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="emailSeafile">Seafile<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                        <input form="formRecapOrder" class="form-control" id="emailSeafile" type="text" value="{{ old('emailSeafile') ? old('emailSeafile') : Auth::user()->email }}" name="emailSeafile">
                                        @error('emailSeafile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="emailNextcloud">Nextcloud<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                        <input form="formRecapOrder" class="form-control" id="emailNextcloud" type="text" value="{{ old('emailNextcloud') ? old('emailNextcloud') : Auth::user()->email }}" name="emailNextcloud">
                                        @error('emailNextcloud')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        @error('uniqEmail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                            @endif
                            @if ($item->attributes->buttonsRadioForOffer === 'nextcloudOfferBasique' || $item->attributes->buttonsRadioForOffer === 'nextcloudOfferDedicated')
                                <div class="col-12">
                                    <label class="small mb-1" for="emailNextcloud">Nextcloud<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                    <input form="formRecapOrder" class="form-control" id="emailNextcloud" type="text" value="{{ old('emailNextcloud') ? old('emailNextcloud') : Auth::user()->email }}" name="emailNextcloud">
                                    @error('emailNextcloud')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @elseif ($item->attributes->buttonsRadioForOffer === 'seafileOfferBasique' || $item->attributes->buttonsRadioForOffer === 'seafileOfferDedicated')
                                <div class="col-12">
                                    <label class="small mb-1" for="emailSeafile">Seafile<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                    <input form="formRecapOrder" class="form-control" id="emailSeafile" type="text" value="{{ old('emailSeafile') ? old('emailSeafile') : Auth::user()->email }}" name="emailSeafile">
                                    @error('emailSeafile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <span>{{__("Veuillez renseigner la ou les addresses mails qui seront utilisées pour se connecter à Seafile et Nextcloud")}}.</span>
                    </div>
                </div>

            </div>
            <div class="col-12 col-lg-6">
                <div class="card mb-4">
                    <div class="card-header customCardHeader">
                        <span>{{__("Récapitulatif de l'offre")}}</span>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-evenly">
                            <div class="row">
                                <div class="col-12 col-sm-6 ps-1 pe-0">
                                    <span class="fst-italic">
                                        <i class="fa-solid fa-circle-arrow-right bg-white text-tertiary me-2"></i>{{__("Formule choisie")}} :</span>
                                    <span>{{ __(ucfirst($item->attributes->form_level)) }}</span>
                                </div>
                                @if ($item->attributes->buttonsRadioForOffer)
                                    <div class="col-12 col-sm-6 ps-1 pe-0">
                                        <span class="fst-italic"><i
                                                class="fa-solid fa-circle-arrow-right bg-white text-tertiary me-2"></i>Option :</span>
                                        <span>{{ $buttonsRadioForOfferName }}</span>
                                    </div>
                                @endif
                                @if ($item->attributes->isFreeTrial == true)
                                    <div class="col-12 col-sm-6 ps-1 pe-0">
                                        <span class="fst-italic"><i
                                                class="fa-solid fa-circle-arrow-right bg-white text-tertiary me-2"></i>Option :</span>
                                        <span>{{__("Offre d'essai")}}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col ps-1 pe-0">
                                    <span class="fst-italic"><i class="fa-solid fa-circle-arrow-right bg-white text-tertiary me-2"></i>{{__("Espace disque")}} :</span>
                                    <span>{{ $item->attributes->form_diskspace . ' Go' }}</span>
                                </div>
                            </div>

                            @if ($item->attributes->form_level === 'dédié')
                                <div class="row">
                                    <div class="col ps-1 pe-0 d-flex align-item-center">
                                        <span class="d-flex align-items-center"><i class="fa-solid fa-circle-arrow-right bg-white text-tertiary me-2"></i></span>
                                        <div>
                                            <span class="fst-italic">{{__("Domaine")}} :</span>
                                            <span>{{ $item->attributes->domainUrlOrPrefix }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <span>Total : </span>
                        <span>{{ $formula_period === 'yearly' ? $item->price : $item->attributes->priceMonthly }} € {{ $formula_period === "monthly" ? __("par mois") : ($formula_period === "free" ? __("pour un mois") : __("pour un an")) }}</span>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header customCardHeader">
                        <span>{{__("Conditions de vente")}}</span>
                    </div>
                    <div class="card-body">
                        <span class="d-block fw-bolder">{{__("Identité de l'association : Mutualise")}}</span>
                        <span class="d-block"><strong>Raison sociale :</strong> Association régie par la loi du 1er juillet 1901 et le décret du 16 août 1901. TVA non applicable art-293B du CGI.</span>
                        <span class="d-block"><strong>{{__("Support technique")}} :</strong><a class="btn-link" href="mailto:support@victork.fr"> support@victork.fr</a></span>
{{--                        <span class="d-block">Identifiant SIREN : 503341976</span>--}}
{{--                        <span class="d-block">CNIL : 1426354</span>--}}
{{--                        <span class="d-block">Code APE : 9499Z</span>--}}
{{--                        <span class="d-block">Identification WALDEC : W763003888</span>--}}
                    </div>
                    <div class="card-footer">
                        <input class="form-check-input" type="checkbox" id="checboxCGU" name="checboxCGU" form="formRecapOrder">
                        <label class="form-check-label" for="checboxCGU"> {{__("J'accepte les conditions ci-dessus")}} </label><br>
                        @error('checboxCGU')
                            <span class="ms-3 text-danger">{{__("Vous devez accepter les conditions de vente pour continuer.")}}</span>
                        @enderror
                    </div>
                </div>
                @if ($item->attributes->isFreeTrial !== "on")
                    <div class="card mb-4">
                        <div class="card-header customCardHeader">
                            <span>Méthode de paiement</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input {{ old('methodPayment') ? (old('methodPayment') == 'paypal' ? 'checked' : '') : ''}} class="form-check-input" type="radio" id="paypal" name="methodPayment" form="formRecapOrder" value="paypal">
                                        <label class="form-check-label" for="paypal">Paypal (account sandbox required)<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input {{ old('methodPayment') ? (old('methodPayment') == 'stripe' ? 'checked' : '') : ''}} class="form-check-input" type="radio" id="stripe" name="methodPayment" form="formRecapOrder" value="stripe">
                                        <label class="form-check-label" for="stripe">Stripe test mode (CB)<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                                    </div>
                                    @error('methodPayment')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <div class="card-footer d-flex justify-content-between">
                                <span>Veuillez renseigner la méthode de paiement qui devra être utilisé.</span>
                            </div>
                        </div>
                    </div>
                @endif
        </div>
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-header customCardHeader">
                        <span>{{__("Commentaires concernant votre commande")}}</span>
                    </div>
                    <div class="card-body">
                        <p>{{__("Utilisez cette zone pour des instructions spéciales ou des questions concernant votre commande.")}}
                        </p>
                        <div class="form-floating">
                            <textarea class="form-control" id="comment" style="height: 6rem;" form="formRecapOrder" name="comment"></textarea>
                            <label class="form-label" for="comment">{{__("Commentaires concernant votre commande")}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
                <form action="{{ route('make.payment')}}" method="POST" id="formRecapOrder" name="formRecapOrder" class="d-flex justify-content-center">
                    @csrf
                    <input type="hidden" value="{{$cartItemId}}" name="cartItemId">
                    <input type="hidden" value="{{$formula_period}}" name="formula_period">
                    <button type="submit" class="btn btn-secondary btn-lg" id="buttonFormRecapOrder">{{__("Valider la commande")}}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
