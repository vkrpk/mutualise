@extends('layouts.app')
@section('content')
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
        <p class="pricing headline text-secondary fs-1" style="font-family: Roboto, sans-serif;">Choisissez votre formule
        </p>
        <p class="pricing-sub-headline fs-4">Toutes vos données fragmentées, copiées et réparties sur différents serveurs et
            Datacenters selon le niveau de disponibilité choisi.
            <a class="text-primary" href="https://www.dedikam.com/lexique/#niveaux" target="_blank">En savoir plus</a>
        </p>
    </div>
    {{-- TABLEAU COMPARATIF --}}
    <div class="comparison mb-4">
        @include('orders.form.pricingTable')
    </div>
    {{-- TABLEAU COMPARATIF --}}
    <div class="row mx-2 mx-sm-0 g-2 m-3">

        <div class="my-4 range-slider-container text-center position-relative">
            <p class="p-2 p-sm-4 rounded-3 fs-5 bg-white border text-center">Choisissez votre espace disque en déplaçant le
                curseur orange vers la droite, tarif affiché en bas de page.</p>
            <p class="mb-0">Espace disque : <span id="slider-output">10Go</span></p>
            <input type="range" class="rs-range flex-grow-1" name="form_diskspace" id="slider" min="10" max="5000"
                step="10" value="{{ Cart::getContent()->first()->attributes->form_diskspace ?? 0 }}" form="formAddToCart">
            <div class="position-absolute start-50 translate-middle-x w-100 text-nowrap" style="bottom:-16px; ">
                <span style="font-size: 11px; opacity: 0.8">Trafic illimité - Bande passante : 500 Mbit/s à 1Gbit/s, au
                    dessus de 5 000Go, veuillez nous
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
                            <tr class="text-center bg-light" style="vertical-align:middle">
                                <th>Formule</th>
                                <th>Espace disque</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center" id="recapDiskspace">
                                <td style="vertical-align:middle">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <span id="recapLevel" class="fs-3 fw-bolder">Basique</span>
                                        <span id="recapLevelOption"></span>
                                    </div>
                                </td>
                                <td style="vertical-align:middle">
                                    <div class="d-flex flex-column align-items-center justify-content-center" >
                                        <span id="recapDiskspaceGo" class="fs-3 fw-bold">10 Go</span>
                                        <span id="recapDiskspaceGio">(9.31 Gio )</span>
                                    </div>
                                </td>
                                <td style="vertical-align:middle" class="fs-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div id="price_Y">
                                            <span id="textPricePerYear" class="text-primary fw-bolder">2€</span>
                                            <span id="recap_amount_free" class="text-primary fw-bolder"
                                                style="display: none;">gratuit pour 30 jours</span>
                                            <span id="recap_duration">pour 1 an jusqu'au</span>
                                            <span id="recap_enddate">01/06/2022</span>
                                        </div>
                                        <div id="boxPricePerMonth" class="d-none">
                                            <span class="text-secondary fw-bolder">ou</span>
                                            <div>
                                                <span id="textPricePerMonth" class="text-primary fw-bolder">2€</span>
                                                <span>par mois</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('orders.form.formButton')
    </div>
</div>
@endsection

@push('scripts')
<script>
window.onload = function () {
    const slider = document.getElementById("slider");
    const sliderOutput = document.getElementById("slider-output");
    const inputHiddenOfferAddToCartForm = document.getElementById("form_level");
    const buttonsRadioForOffer = document.querySelectorAll('input[name="buttonsRadioForOffer"]');
    const cellsWithAttributesOffer = document.querySelectorAll("a[offer]");
    const cartLevelOffer = "{!! Cart::getContent()->first()->attributes->form_level ?? 'null'!!}";
    const cartValueOffer = "{!! Cart::getContent()->first()->attributes->form_diskspace ?? 'null'!!}";
    const cartButtonsRadioForOffer = "{!! Cart::getContent()->first()->attributes->buttonsRadioForOffer ?? 'null' !!}";
    let timeout = null;
    const boxPricePerMonth = document.getElementById("boxPricePerMonth");
    const recapLevel = document.getElementById("recapLevel");
    const recapDiskspaceGo = document.getElementById("recapDiskspaceGo");
    const recapDiskspaceGio = document.getElementById("recapDiskspaceGio");
    const recapLevelOption = document.getElementById("recapLevelOption");
    const rangeSliderContainer = document.querySelector('.range-slider-container');
    const buttonsRadioForOfferBasique = [buttonsRadioForOffer[0], buttonsRadioForOffer[1], buttonsRadioForOffer[2]];
    const buttonsRadioForOfferDedicated = [buttonsRadioForOffer[3], buttonsRadioForOffer[4], buttonsRadioForOffer[5]];

    function calculAndDisplayOfferPrice(value, offer) {
        return fetch(`/amount?size=${value}&offer=${offer}`)
            .then(function (response) {
                return response.json();
            })
            .then((response) => {
                const textPricePerYear = document.getElementById("textPricePerYear");
                textPricePerYear.innerHTML = response.Y + " €";
                const textPricePerMonth = document.getElementById("textPricePerMonth");
                textPricePerMonth.innerHTML = response.M + " €";
                if (slider.value >= 170) {
                    boxPricePerMonth.classList.contains("d-none") ? boxPricePerMonth.classList.toggle("d-none") : "";
                } else {
                    boxPricePerMonth.classList.contains("d-none") ? "" : boxPricePerMonth.classList.toggle("d-none");
                }
                recapLevel.innerHTML = offer.charAt(0).toUpperCase() + offer.slice(1);
                if(offer !== 'dédié') {
                    recapDiskspaceGo.innerHTML = value + " Go";
                    recapDiskspaceGio.innerHTML = Math.round(100 * value / 1.074) / 100 + " Gio";
                } else if(offer === 'dédié') {
                    recapDiskspaceGo.innerHTML = 'Illimité'
                    recapDiskspaceGio.innerHTML = '';
                    boxPricePerMonth.classList.contains("d-none") ? boxPricePerMonth.classList.toggle("d-none") : "";
                    slider.value = 5000;
                }
                if( offer === "basique" || offer === "dédié") {
                    let buttonChecked;
                    buttonsRadioForOffer.forEach(button => {
                        if(button.checked === true) {
                            buttonChecked = button;
                        }
                    });
                    recapLevelOption.innerHTML = buttonChecked.value.charAt(0).toUpperCase() + buttonChecked.value.split("Offer")[0].slice(1)
                }
            });
    };

    function inputHiddenOfferAddToCartFormValue(column) {
        inputHiddenOfferAddToCartForm.value = column.getAttribute("offer");
    };

    function changeSliderColor() {
        const percent = Math.round((slider.value / 5000) * 100);
        slider.style.background = "linear-gradient(to right, #Fe7e20 0%, #Fe7e20 " + percent + "%, #ffd6b8 " + percent + "%, #ffd6b8 100%)";
        sliderOutput.innerHTML = slider.value + " Go";
    };

    function removeSelectedClassToAllColumns () {
        cellsWithAttributesOffer.forEach((div) => div.classList.remove("selected"))
    }

    function addSelectedClassToColumn(column) {
        column.classList.add("selected");
        resetRadioButtons(column)
    }

    function resetRadioButtons(column) {
        const isButtonsRadioForOfferBasiqueChecked = buttonsRadioForOfferBasique.some((button) => button.checked === true);
        const isButtonsRadioForOfferDedicatedChecked = buttonsRadioForOfferDedicated.some((button) => button.checked === true);
        if (column.getAttribute("offer") !== "basique" && column.getAttribute("offer") !== "dédié") {
            buttonsRadioForOffer.forEach((input) => (input.checked = false));
        } else if(column.getAttribute("offer") === "basique") {
            isButtonsRadioForOfferBasiqueChecked ? '' : buttonsRadioForOffer[0].checked = true;
        } else if(column.getAttribute("offer") === "dédié") {
            isButtonsRadioForOfferDedicatedChecked ? '' : buttonsRadioForOffer[3].checked = true;
        }
    }

    function toggleSlider(div) {
        if(div.getAttribute("offer") === "dédié") {
            rangeSliderContainer.classList.add('d-none');
        } else {
            rangeSliderContainer.classList.remove('d-none');
        }
    }

    if(cartLevelOffer != 'null'){
        removeSelectedClassToAllColumns()
        calculAndDisplayOfferPrice(cartValueOffer, cartLevelOffer);
        switch (cartLevelOffer) {
            case "basique":
                addSelectedClassToColumn(document.querySelectorAll("a[offer='basique']")[1]);
                document.querySelector(`input[value='${cartButtonsRadioForOffer}']`).checked = true;
                break;
            case "standard":
                addSelectedClassToColumn(document.querySelectorAll("a[offer='standard']")[1])
                break;
            case "entreprise":
                addSelectedClassToColumn(document.querySelectorAll("a[offer='entreprise']")[1])
                break;
            case "dédié":
                addSelectedClassToColumn(document.querySelectorAll("a[offer='dédié']")[1])
                document.querySelector(`input[value='${cartButtonsRadioForOffer}']`).checked = true;
                break;
            default:
                break;
        }
        toggleSlider(document.querySelector(".selected"));
    }

    changeSliderColor();

    slider.addEventListener("input", changeSliderColor);

    slider.addEventListener("input", function(e) {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            calculAndDisplayOfferPrice(slider.value, document.querySelector(".selected").getAttribute("offer"))
        }, 300);
    });

    cellsWithAttributesOffer.forEach((div) => {
        div.addEventListener("click", function () {
            removeSelectedClassToAllColumns();
            addSelectedClassToColumn(div);
            toggleSlider(div);
            inputHiddenOfferAddToCartFormValue(div);
            calculAndDisplayOfferPrice(slider.value, document.querySelector(".selected").getAttribute("offer"));
        })
    });

    // Popover bootstrap
    var popoverTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    var popover = new bootstrap.Popover(
        document.querySelector(".popover-dismiss"),
        {
            trigger: "focus",
        }
    );
};
</script>
@endpush