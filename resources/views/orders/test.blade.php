@extends('layouts.app')
@section('content')
@php
    switch ($level) {
        case 'STD':
        $offer = '.offre_n2';
        break;
        case 'ENT':
        $offer = '.offre_n3';
        break;
        case 'DED':
        $offer = '.offre_n4';
        break;
        default:
        $offer = '.offre_n1';
        break;
    }
@endphp
<div class="container-sm overflow-hidden p-0">
    <div class="row mx-2 mx-sm-0 g-2 text-center m-3">
        <div class="alert alert-primary fs-3 fw-bolder" role="alert">
            <span>Ajouter un accès</span>
        </div>
        <div class="card border-secondary">
            <div class="card-body d-flex flex-column align-middle">
                {{-- INPUT --}}
                @include('orders.form.boxFreeTrial')
                {{-- INPUT --}}
                </div>
        </div>
        <h1 class="pricing headline text-secondary" style="font-family: Roboto, sans-serif;">Choisissez votre formule</h1>
        <h3 class="pricing-sub-headline">Toutes vos données fragmentées, copiées et réparties sur différents serveurs et Datacenters selon le niveau de disponibilité choisi.
            <a class="text-primary" href="https://www.dedikam.com/lexique/#niveaux" target="_blank">En savoir plus</a>
        </h3>
    </div>
    {{-- TABLEAU COMPARATIF --}}
    <div class="comparison mb-4">
        @include('orders.form.pricingTable')
    </div>
    {{-- TABLEAU COMPARATIF --}}
    <div class="row mx-2 mx-sm-0 g-2 m-3">
        <p class="p-2 p-sm-4 rounded-3 fs-5 bg-white border text-center">Choisissez votre espace disque en déplaçant le curseur orange vers la droite, tarif affiché en bas de page.</p>
        <div class="my-4 range-slider-container text-center position-relative">
            <p class="mb-0">Espace disque : <span id="taille_output">10Go</span></p>
            <input type="range" class="rs-range flex-grow-1" name="taille" id="taille" min="10" max="5000" step="10" value="10" form="formOrder">
            <div class="position-absolute start-50 translate-middle-x w-100 text-nowrap" style="bottom:-16px; ">
                <span style="font-size: 11px; opacity: 0.8">Trafic illimité - Bande passante : 500 Mbit/s à 1Gbit/s, au dessus de 5 000Go, veuillez nous
                    <a class="text-primary" href="https://www.dedikam.com/contact/" target="_blank">contacter</a>.
                </span>
            </div>
        </div>
        <div class="offer_content mt-0">
            <div class="d-table">
                <span class="offer_legend2 align-self-center">Récapitulatif de votre commande</span>
                <div class="table-responsive" style="max-width: 50rem;margin-left: auto;margin-right: auto">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center bg-light">
                                <th>Formule</th>
                                <th>Espace disque</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td style="vertical-align:middle">
                                    <div><span id="recap_level" class="fs-2 fw-bolder">BASIQUE</span></div>
                                </td>
                                <td style="vertical-align:middle">
                                    <div class="d-flex flex-column">
                                        <span id="recap_diskspace_go" class="fs-2 fw-bold">10 Go</span>
                                        <span id="recap_diskspace_gio">(9.31 Gio )</span>
                                    </div>
                                </td>
                                <td style="vertical-align:middle">
                                    <div class="d-flex flex-column align-items-start">
                                        <div id="price_Y" class="ms-5">
                                            <span id="recap_amount_Y" class="fs-1 text-primary fw-bolder">2€</span>
                                            <span id="recap_amount_free" class="fs-1 text-primary fw-bolder" style="display: none;">gratuit pour 30 jours</span>
                                            <span id="recap_duration" class="ms-2 me-1">pour 1 an jusqu'au</span>
                                            <span id="recap_enddate">01/06/2022</span>
                                        </div>
                                        <div id="price_or" class="ms-5 d-none">
                                            <span class="fs-3 text-secondary fw-bolder">ou</span>
                                        </div>
                                        <div id="price_M" class="ms-5 d-none">
                                            <span id="recap_amount_M" class="fs-1 text-primary fw-bolder">2€</span>
                                            <span class="ms-2">par mois</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <span class="offer_legend2 align-self-left">Choisissez un nom pour l'accès<br></span>
        <div class="form-floating offer_content pb-2 mt-0">
            <input type="text" name="form_access_name" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="right" id="access_name" class="form-control  @error('form_access_name') is-invalid @enderror form=" formOrder"" @error('form_access_name') autofocus @enderror placeholder="Nom de l'accès" required style="width: 20rem;" title="Donnée obligatoire" maxlength="40" value="{{ old('form_access_name') }}" aria-describedby="validationform_access_nameFeedback">
            <label class="form-label" for="access_name">Nom de l'accès
                <sup>
                    <i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i>
                </sup>
            </label>
            <div class="invalid-feedback">
                Le nom de l'accès est obligatoire
            </div>
        </div>
        @include('orders.form.formButton')
    </div>
</div>
@env('local')
<!-- member-access.create -->
@endenv
@endsection

@stack('order')
