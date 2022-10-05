@extends('layouts.app')
@section('content')

<div class="container-sm overflow-hidden p-0">
    <div class="row mx-2 mx-sm-0 g-2 text-center m-3">
        <div class="alert alert-primary fs-3 fw-bolder" role="alert">
            <span>{{__("Ajouter un accès")}}</span>
        </div>
        <div class="card border-secondary">
            <div class="card-body d-flex flex-column align-middle">
                {{-- INPUT --}}
                @include('offers.form.boxFreeTrial')
                {{-- INPUT --}}
            </div>
        </div>
        <p class="pricing headline text-secondary fs-1" style="font-family: Roboto, sans-serif;">{{__("Choisissez votre formule")}}</p>
        <p class="pricing-sub-headline fs-4">{{__("Toutes vos données fragmentées, copiées et réparties sur différents serveurs et Datacenters selon le niveau de disponibilité choisi.")}}
            <a class="text-primary" href="https://www.dedikam.com/lexique/#niveaux" target="_blank"><br>{{__("En savoir plus")}}</a>
        </p>
    </div>
    {{-- TABLEAU COMPARATIF --}}
    <div class="mb-4 mx-2 mx-sm-0">
        @include('offers.form.pricingTable')
    </div>
    {{-- TABLEAU COMPARATIF --}}
    <div class="row mx-2 mx-sm-0 g-2 m-3">
        <div class="mt-4 mb-2 range-slider-container text-center position-relative">
            <p class="p-2 p-sm-4 rounded-3 fs-5 bg-white border text-center">{{__("Choisissez votre espace disque en déplaçant le curseur orange vers la droite, tarif affiché en bas de page.")}}</p>
            <p class="mb-0">{{__("Espace disque")}} : <span id="slider-output">10Go</span></p>
            <input type="range" class="rs-range flex-grow-1" name="form_diskspace" id="slider" min="10" max="5000"
                step="10" value="{{ old('form_diskspace') ?? ($formDiskspace ?? 10) }}" form="formAddToCart">
            @error('form_diskspace')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="">
                <span style="font-size: 11px; opacity: 0.8;">{{__("Trafic illimité - Bande passante : 500 Mbit/s à 1Gbit/s, au dessus de 5 000Go, veuillez nous")}}
                    <a class="text-primary" href="https://www.dedikam.com/contact/" target="_blank">{{__("contacter")}}</a>.
                </span>
            </div>
        </div>
        <div class="my-4 range-slider-container text-center position-relative d-flex align-items-center flex-column d-none" id="boxInputsRadioDedicatedOffer">
            <p class="p-2 p-sm-4 rounded-3 fs-5 bg-white border text-center w-100">{{__("Choisissez votre espace disque, tarif affiché en bas de page.")}}</p>
            <div class="d-flex justify-content-evenly w-100" id="inputsRadioForDedicatedOffer">
                <div>
                    <input type="radio" name="sizeValueForDedicatedOffer" id="dedicated500" value="500" form="formAddToCart" checked {{ old('sizeValueForDedicatedOffer') == 500 ? 'checked' : ($formDiskspace == 500 ? 'checked' : '') }}>
                    <label for="dedicated500">500 Go</label>
                </div>
                <div>
                    <input type="radio" name="sizeValueForDedicatedOffer" id="dedicated1500" value="1500" form="formAddToCart" {{ old('sizeValueForDedicatedOffer') == 1500 ? 'checked' : ($formDiskspace == 1500 ? 'checked' : '') }}>
                    <label for="dedicated1500">1,5 To</label>
                </div>
                <div>
                    <input type="radio" name="sizeValueForDedicatedOffer" id="dedicated3000" value="3000" form="formAddToCart" {{ old('sizeValueForDedicatedOffer') == 3000 ? 'checked' : ($formDiskspace == 3000 ? 'checked' : '') }}>
                    <label for="dedicated3000">3 To</label>
                </div>
                <div>
                    <input type="radio" name="sizeValueForDedicatedOffer" id="dedicated5000" value="5000" form="formAddToCart" {{ old('sizeValueForDedicatedOffer') == 5000 ? 'checked' : ($formDiskspace == 5000 ? 'checked' : '') }}>
                    <label for="dedicated5000">5 To</label>
                </div>
            </div>
            <div>
                <span style="font-size: 11px; opacity: 0.8">{{__("Trafic illimité - Bande passante : 500 Mbit/s à 1Gbit/s, au dessus de 5 000Go, veuillez nous")}}
                    <a class="text-primary" href="https://www.dedikam.com/contact/" target="_blank">{{__("contacter")}}</a>.
                </span>
            </div>
            <p class="mb-0 mt-3 fw-bolder">{{__("Choix du nom de domaine")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></p>
            <div class="d-flex justify-content-center" id="inputsRadioForDomainType">
                <div class="d-flex me-4">
                    <input class="me-2" type="radio" name="domainType" id="dedikam" value="dedikam" form="formAddToCart" checked {{ old('domainType') === 'dedikam' ? 'checked' : ($domainType == 'dedikam' ? 'checked' : '') }}>
                    <label for="dedikam">*.dedikam.com</label>
                </div>
                <div>
                    <input class="me-1" type="radio" name="domainType" id="private" value="private" form="formAddToCart" {{ old('domainType') === 'private'? 'checked' : ($domainType == 'private' ? 'checked' : '') }}>
                    <label for="private">{{__("Privé")}}</label>
                </div>
            </div>
            <div class="mt-3 d-flex flex-column align-items-center" id="boxDomainUrlOrPrefix">
                <div>
                    <label class="small mb-1 fw-bolder" for="domainUrlOrPrefix">{{__("Choix du préfixe")}}</label><sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup>
                </div>
                <input class="form-control" id="domainUrlOrPrefix" type="text" name="domainUrlOrPrefix" value="{{ old('domainUrlOrPrefix') ? old('domainUrlOrPrefix') : $domainUrlOrPrefix }}" form="formAddToCart" style="width: 300px">
                <span>{{__("Exemple : 'votre-choix'.dedikam.com")}}</span>
                <div class="text-danger">{{ $errors->regex->first() }}</div>
                @error('domainUrlOrPrefix')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="d-table">
                <span class="offer_legend2 align-self-center">{{__("Récapitulatif de votre commande")}}</span>
                <div class="table-responsive" style="max-width: 50rem;margin-left: auto;margin-right: auto">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr class="text-center bg-light" style="vertical-align:middle">
                                <th>{{__("Formule")}}</th>
                                <th>{{__("Espace disque")}}</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center bg-white" id="recapDiskspace">
                                <td style="vertical-align:middle">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <span id="recapLevel" class="fs-3 fw-bolder">Standard</span>
                                        <span id="recapLevelOption"></span>
                                    </div>
                                </td>
                                <td style="vertical-align:middle">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <span id="recapDiskspaceGo" class="fs-3 fw-bold">10 Go</span>
                                        <span id="recapDiskspaceGio">(9.31 Gio )</span>
                                    </div>
                                </td>
                                <td style="vertical-align:middle" class="fs-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <div id="price_Y">
                                            <span id="textPricePerYear" class="text-primary fw-bolder">3.6 €</span>
                                            <span id="textRecapDurationFreeTrial" class="fw-bolder d-none">{{__("pour 30 jours")}}</span>
                                            <span id="textRecapDurationYear">{{__("pour 1 an jusqu'au")}}</span>
                                            <span id="recap_enddate">{{ date('d-m-Y', strtotime("+1 year")) }}</span>
                                        </div>
                                        <div id="boxPricePerMonth" class="d-none">
                                            <span class="text-secondary fw-bolder">{{__("ou")}}</span>
                                            <div>
                                                <span id="textPricePerMonth" class="text-primary fw-bolder"></span>
                                                <span>{{__("par mois")}}</span>
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
        @include('offers.form.formButton')
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
    const buttonsRadioForDedicatedOffer = document.querySelectorAll('input[name="sizeValueForDedicatedOffer"]');
    const buttonsRadioForDomainType = document.querySelectorAll('input[name="domainType"]');
    const cellsWithAttributesOffer = document.querySelectorAll("a[offer]");
    const cartLevelOffer = "{{ $level }}";
    const cartValueOffer = "{{ $formDiskspace }}";
    const cartButtonsRadioForOffer = "{{ $option }}";
    const cartButtonsRadioForDomainType = "{{ $domainType }}";
    const cartIsFreeTrial = "{{ $isFreeTrial }}";
    const inputIsFreeTrial = document.getElementById("isFreeTrial") ?? ''
    let timeout = null;
    const boxPricePerMonth = document.getElementById("boxPricePerMonth");
    const recapLevel = document.getElementById("recapLevel");
    const recapDiskspaceGo = document.getElementById("recapDiskspaceGo");
    const recapDiskspaceGio = document.getElementById("recapDiskspaceGio");
    const recapLevelOption = document.getElementById("recapLevelOption");
    const rangeSliderContainer = document.querySelector('.range-slider-container');
    const buttonsRadioForOfferBasique = [buttonsRadioForOffer[0], buttonsRadioForOffer[1], buttonsRadioForOffer[2]];
    const buttonsRadioForOfferDedicated = [buttonsRadioForOffer[3], buttonsRadioForOffer[4], buttonsRadioForOffer[5]];
    const boxInputsRadioDedicatedOffer = document.getElementById('boxInputsRadioDedicatedOffer')
    const boxDomainUrlOrPrefix = document.getElementById("boxDomainUrlOrPrefix")
    const textPricePerYear = document.getElementById("textPricePerYear");

    function calculAndDisplayOfferPrice(value, offer) {
        return fetch(`/amount?size=${value}&offer=${offer}`)
            .then(function (response) {
                return response.json();
            })
            .then((response) => {
                textPricePerYear.innerHTML = response.Y + " €";
                const textPricePerMonth = document.getElementById("textPricePerMonth");
                textPricePerMonth.innerHTML = response.M + " €";
                if (value >= 170) {
                    boxPricePerMonth.classList.contains("d-none") ? boxPricePerMonth.classList.toggle("d-none") : "";
                } else {
                    boxPricePerMonth.classList.contains("d-none") ? "" : boxPricePerMonth.classList.toggle("d-none");
                }
                switch (offer.charAt(0).toUpperCase() + offer.slice(1)) {
                    case "Basique":
                        recapLevel.innerHTML = '{{__("Basique")}}'
                        break;
                    case "Entreprise":
                        recapLevel.innerHTML = '{{__("Entreprise")}}'
                        break;
                    case "Dédié":
                        recapLevel.innerHTML = '{{__("Dédié")}}'
                        break;

                    default:
                        recapLevel.innerHTML = "Standard"
                        break;
                }
                recapDiskspaceGo.innerHTML = value + " Go";
                recapDiskspaceGio.innerHTML = Math.round(100 * value / 1.074) / 100 + " Gio";
                if(inputIsFreeTrial.checked) {
                    textPricePerYear.innerHTML = "Gratuit";
                    document.getElementById("textRecapDurationYear").classList.contains('d-none') ? '' : document.getElementById("textRecapDurationYear").classList.add('d-none')
                    document.getElementById("textRecapDurationFreeTrial").classList.contains('d-none') ? document.getElementById("textRecapDurationFreeTrial").classList.remove('d-none') : ''
                } else {
                    document.getElementById("textRecapDurationFreeTrial").classList.contains('d-none') ? "" : document.getElementById("textRecapDurationFreeTrial").classList.add('d-none')
                    document.getElementById("textRecapDurationYear").classList.contains('d-none') ? document.getElementById("textRecapDurationYear").classList.remove('d-none') : ''
                }
                if(offer !== 'dédié') {
                    slider.value = value;
                    boxInputsRadioDedicatedOffer.classList.contains("d-none") ? "" : boxInputsRadioDedicatedOffer.classList.add("d-none")
                    changeSliderColor()
                } else if(offer === 'dédié') {
                    boxInputsRadioDedicatedOffer.classList.remove("d-none")
                    document.querySelector("input[name='domainType']").setAttribute('required', '')
                }
                if( offer === "basique" || offer === "dédié") {
                    let buttonChecked;
                    buttonsRadioForOffer.forEach(button => {
                        if(button.checked === true) {
                            buttonChecked = button;
                        }
                    });
                    buttonChecked ? recapLevelOption.innerHTML = buttonChecked.value.charAt(0).toUpperCase() + buttonChecked.value.split("Offer")[0].slice(1) : recapLevelOption.innerHTML = "Pydio"
                } else {
                    recapLevelOption.innerHTML = ''
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

    function blockInputsFreeTrial() {
        removeSelectedClassToAllColumns();
        addSelectedClassToColumn(document.querySelectorAll("a[offer='standard']")[1]);
        document.querySelectorAll("a[offer]:not([offer='standard'])").forEach(element => element.classList.toggle('grayedOut'));
        rangeSliderContainer.classList.toggle('d-none');
        changeSliderColor();
        inputHiddenOfferAddToCartFormValue(document.querySelectorAll("a[offer='standard']")[1])
        calculAndDisplayOfferPrice(10, document.querySelector(".selected").getAttribute("offer"));
        cellsWithAttributesOffer.forEach((div) => {
            div.classList.toggle("disablePointerEvent");
        })
        buttonsRadioForOffer.forEach((button) => {
            button.toggleAttribute('disabled')
        })
        slider.toggleAttribute('disabled')
        document.getElementById("recap_enddate").classList.toggle("d-none");
    }

    if((document.querySelector('#form_level').value === 'dédié') && cartIsFreeTrial == '') {
        removeSelectedClassToAllColumns()
        calculAndDisplayOfferPrice(document.querySelector(`input[name='sizeValueForDedicatedOffer']:checked`).value, 'dédié');
        addSelectedClassToColumn(document.querySelectorAll("a[offer='dédié']")[1])
        toggleSlider(document.querySelector(".selected"));
    }

    if((document.querySelector('#form_level').value !== 'dédié') && cartIsFreeTrial == '') {
        removeSelectedClassToAllColumns()
        calculAndDisplayOfferPrice(slider.value, document.querySelector('#form_level').value);
        addSelectedClassToColumn(document.querySelectorAll(`a[offer="${document.querySelector('#form_level').value}"]`)[1])
        toggleSlider(document.querySelector(".selected"));
    }

    if(cartLevelOffer && cartIsFreeTrial == 'on') {
        inputIsFreeTrial.checked = true;
        blockInputsFreeTrial()
    } else if (cartLevelOffer) {
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
                switchTextDomainUrlOrPrefixDisplay();
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

    buttonsRadioForDedicatedOffer.forEach(button => {
        button.addEventListener("input", () => {
            calculAndDisplayOfferPrice(button.value, document.querySelector(".selected").getAttribute("offer"));
        })
    });

    buttonsRadioForDomainType.forEach(button => {
        button.addEventListener("input", switchTextDomainUrlOrPrefixDisplay)
    });

    function switchTextDomainUrlOrPrefixDisplay () {
        if(document.querySelector('input[name="domainType"]:checked').value == "dedikam") {
            boxDomainUrlOrPrefix.querySelector("span").innerHTML = '{{__("Exemple : 'votre-choix'.dedikam.com")}}'
            boxDomainUrlOrPrefix.querySelector("label").innerHTML = '{{__("Choix du préfixe")}}'
        } else {
            boxDomainUrlOrPrefix.querySelector("span").innerHTML = '{{__("CNAME de type : example-domain.com")}}'
            boxDomainUrlOrPrefix.querySelector("label").innerHTML = '{{__("Nom de votre domaine privé")}}'
        }
    }

    cellsWithAttributesOffer.forEach((div) => {
        div.addEventListener("click", function () {
            removeSelectedClassToAllColumns();
            addSelectedClassToColumn(div);
            toggleSlider(div);
            changeSliderColor();
            inputHiddenOfferAddToCartFormValue(div);
            if(div.getAttribute("offer") !== "dédié"){
                calculAndDisplayOfferPrice(slider.value, document.querySelector(".selected").getAttribute("offer"));
            } else {
                calculAndDisplayOfferPrice(document.querySelector("input[name='sizeValueForDedicatedOffer']:checked").value, document.querySelector(".selected").getAttribute("offer"));
            }
        })
    });

    @auth
        inputIsFreeTrial.addEventListener("input", () => blockInputsFreeTrial())
    @endauth


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
