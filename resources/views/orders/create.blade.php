@php
$cartItem = Cart::getContent()->first();
@endphp

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <x-adresses-card :address="$address" />
            </div>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header customCardHeader fw-bolder">
                        <span>Récapitulatif de l'offre</span>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-evenly">
                            <div class="row">
                                <div class="col-12 col-sm-6 ps-1 pe-0">
                                    <span class="fst-italic">
                                        <i class="fa-solid fa-circle-arrow-right bg-white text-secondary me-2"></i>Formule
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
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <span>Total : </span>
                        <span>{{ $cartItem->price }} € </span>
                    </div>
                </div>
                <div class="card">                    
                    <div class="card-header py-3 fw-bolder customCardHeader">
                        <span>Conditions de vente</span>
                    </div>
                    <div class="card-body">
                        <span class="d-block fw-bolder">Identité de l'association : Dedikam</span>
                        <span class="d-block"><strong>Raison sociale :</strong> Association régie par la loi du 1er juillet 1901 et le décret du 16 août 1901. TVA non applicable art-293B du CGI.</span>
                        <span class="d-block"><strong>Support technique :</strong><a class="btn-link" href="mailto:support@dedikam.com"> support@dedikam.com</a></span>
                        <span class="d-block">Identifiant SIREN : 503341976</span>
                        <span class="d-block">CNIL : 1426354</span>
                        <span class="d-block">Code APE : 9499Z</span>
                        <span class="d-block">Identification WALDEC : W763003888</span>
                        <a href="https://labo-drupal.dedikam.com/content/conditions-de-vente" class="text-primary">Lire la suite</a>
                    </div>
                    <div class="card-footer">
                        <input class="form-check-input" type="checkbox" id="checboxCGU" name="checboxCGU">
                        <label class="form-check-label" for="checboxCGU"> J'accepte les conditions ci-dessus </label>
                        @error('checboxCGU')
                            <span class="text-danger">Vous devez accepter les conditions de vente pour continuer.</span>                            
                        @enderror
                    </div>                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card rounded-0">
                <div class="alert alert-secondary fw-bolder mb-1 rounded-0" role="alert"><span>Commentaires concernant la
                        commande</span></div>
                <div id="item-5" class=" item-5">
                    <div class="accordion-body">
                        <p class="mb-0">Utilisez cette zone pour des instructions spéciales ou des questions
                            concernant votre commande.<br></p>
                        <div class="form-floating">
                            <textarea class="form-control" id="comment" style="height: 6rem;"></textarea><label class="form-label" for="comment">Commentaires
                                concernant la
                                commande</label>
                        </div>
                        <button id="btn5" class="btn btn-primary mt-2 btn-lg" type="button">Valider</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="row"></div>
        <div class="row">

        </div>
    </div>
@endsection
