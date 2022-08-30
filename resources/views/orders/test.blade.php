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
        <p class="p-2 p-sm-4 rounded-3 fs-5 bg-white border">Choisissez votre espace disque en déplaçant le curseur orange vers la droite, tarif affiché en bas de page.</p>
        <div class="mx-4 my-4 range-slider-container text-center">
            <span>Espace disque : <span id="taille_output">10Go</span></span>
            <input type="range" class="rs-range flex-grow-1" name="taille" id="taille" min="10" max="5000" step="10" value="10" form="formOrder">
        </div>
        <div class="text-center">
            <span>Trafic illimité - Bande passante : 500 Mbit/s à 1Gbit/s
                <br>Au dessus de 5 000Go, veuillez nous
                <a class="text-primary" href="https://www.dedikam.com/contact/" target="_blank">contacter</a>.
            </span>
        </div>
        <span class="offer_legend2 align-self-left mt-4">Choisissez un nom pour l'accès<br></span>
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
        <span class="offer_legend2 align-self-center">Récapitulatif de votre commande</span>
        <div class="offer_content mt-0">
            <div class="d-table">
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
                                        <div id="price_Y" class="ms-5 d-flex flex-wrap">
                                            <span id="recap_amount_Y" class="fs-1 text-primary fw-bolder">2€</span>
                                            <span id="recap_amount_free" lass="fs-1 text-primary fw-bolder" style="display: none;">gratuit pour 30 jours</span>
                                            <span id="recap_duration" class="ms-2 me-1 text-align-buttom d-flex align-items-end">pour 1 an jusqu'au</span>
                                            <span id="recap_enddate" class="d-flex align-items-end">01/06/2022</span>
                                        </div>
                                        <div id="price_or" class="ms-5" style="display: none;">
                                            <span class="fs-3 text-secondary fw-bolder">ou</span>
                                        </div>
                                        <div id="price_M" class="ms-5" style="display: none;">
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
        @include('orders.form.formButton')
    </div>
</div>
@env('local')
<!-- member-access.create -->
@endenv
@endsection

@push('scripts')
<script>
    window.onload = function() {
            'use strict'
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.querySelectorAll('.needs-validation')
            const slider = document.getElementById('taille');
            const output = document.getElementById('taille_output');
            output.innerHTML = slider.value + " Go";
            let percent = slider.value / 5000 * 100;

            /* sliders sorcery */
            slider.addEventListener('input', function() {
                output.innerHTML = slider.value + " Go";
                percent = Math.round(slider.value / 5000 * 100);
                slider.style.background = "linear-gradient(to right, #Fe7e20 0%, #Fe7e20 " + percent +
                    "%, #ffd6b8 " + percent + "%, #ffd6b8 100%)";
            })

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

            // Logique pour la sélection des colonnes

            const col_1 = document.querySelectorAll('.col-n1');
            const col_2 = document.querySelectorAll('.col-n2');
            const col_3 = document.querySelectorAll('.col-n3');
            const col_4 = document.querySelectorAll('.col-n4');
            const col_collection = [col_1, col_2, col_3, col_4];

            col_collection.forEach(
                column => column.forEach(
                    element => element.addEventListener('click',
                        function() {
                            getUnselected(col_collection);
                            getSelected(column);
                        })))

            function getUnselected(col_collection) {
                col_collection.forEach(
                    column => column.forEach(
                        element => element.classList.remove('selected',
                            'selected-top', 'selected-bottom')));
            }

            function getSelected(column) {
                if (column === col_4) {
                    column.forEach(element => element.classList.add('selected', 'selected-bottom'));
                    column[0].classList.add('selected-top')
                    column[0].classList.remove('selected-bottom')
                } else {
                    column.forEach(element => element.classList.add('selected'));
                    column[0].classList.add('selected-top')
                    column[(column.length - 1)].classList.add('selected-bottom')
                }
            }

            // offres.forEach(offre => offre.addEventListener('click', function() {
            //     offres.forEach(offre => offre.classList.remove('selected'))
            //     if (!this.classList.contains('selected')) {
            //         this.classList.add('selected')
            //     } else {
            //         this.classList.remove('selected')
            //     }
            // }))

            // $(".slider").slider({
            //     min: 10,
            //     max: 5000,
            //     step: 10,
            //     change: sliderChange,
            // }).slider("float", {
            //     suffix: " Go",
            //     handle: true,
            //     pips: false,
            // });

            // function sliderChange() {
            //     let val = $(".slider").slider("value");
            //     if (val > 10) {
            //         $('#check_free_account').prop("checked", false);
            //         $('#form_free_account').val(0);
            //     }
            //     $('#recap_diskspace_go').html(val + "Go");
            //     $('#form_diskspace').val(val);
            //     $('#recap_diskspace_gio').html(Math.round(100 * val * 1000 / 1024) / 100 + " Gio");
            //     calcAmount();
            // }

            function calcAmount() {
                let l = 1;
                if ($('#form_free_account').val() == 0) {
                    ;
                    switch ($("#form_level").val()) {
                        case 'BAS':
                            l = 1;
                            break;
                        case 'STD':
                            l = 2;
                            break;
                        case 'ENT':
                            l = 3;
                            break;
                        case 'DED':
                            l = 4;
                            break;
                        default:
                            console.log("level undefined");
                    }
                    let s = $('#form_diskspace').val();
                    axios.post('/api/calc_price', {
                            "level": l,
                            "size": s
                        })
                        .then((response) => {
                            let res = response.data.Y;
                            //let resm = response.data.M/12;
                            let resm = response.data.M;
                            if (l == 4) {
                                $("#recap_amount_Y").html(330 + " €");
                                $("#recap_amount_M").html(30 + " €");
                            } else {
                                $("#recap_amount_Y").html(Math.round(100 * res) / 100 + " €");
                                $("#recap_amount_M").html(Math.round(100 * resm) / 100 + " €");
                            }

                            if ($('#form_diskspace').val() >= 170) {
                                $('#price_M').show();
                                $('#price_or').show();
                            } else {
                                $('#price_M').hide();
                                $('#price_or').hide();
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        })
                }
            }

            $('.offre_n1').click(() => {
                $('.espace').show();
                $("#recap_level").html("BASIQUE");
                $("#form_level").val("BAS");
                $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
                $(".offre_n1").addClass('activated');
                $(".offre_n1 .offer-choice").addClass('activated');
                $(".offre_n2").removeClass('activated');
                $(".offre_n2 .offer-choice").removeClass('activated');
                $(".offre_n3").removeClass('activated');
                $(".offre_n3 .offer-choice").removeClass('activated');
                $(".offre_n4").removeClass('activated');
                $(".offre_n4 .offer-choice").removeClass('activated');
                $('#check_free_account').prop("checked", false);
                $('#form_free_account').val(0);
                $('#recap_duration').html('pour 1 an jusqu\'au');
                $('#recap_duration').show();
                $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
                $('#recap_amount_Y').show();
                $('#recap_amount_free').hide();
                $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
                calcAmount();
            })
            $('.offre_n2').click(() => {
                $('.espace').show();
                $("#recap_level").html("STANDARD");
                $("#form_level").val("STD");
                $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
                $(".offre_n2").addClass('activated');
                $(".offre_n2 .offer-choice").addClass('activated');
                $(".offre_n1").removeClass('activated');
                $(".offre_n1 .offer-choice").removeClass('activated');
                $(".offre_n3").removeClass('activated');
                $(".offre_n3 .offer-choice").removeClass('activated');
                $(".offre_n4").removeClass('activated');
                $(".offre_n4 .offer-choice").removeClass('activated');
                $('#check_free_account').prop("checked", false);
                $('#form_free_account').val(0);
                $('#recap_duration').html('pour 1 an jusqu\'au');
                $('#recap_duration').show();
                $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
                $('#recap_amount_Y').show();
                $('#recap_amount_free').hide();
                $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
                calcAmount();
            })
            $('.offre_n3').click(() => {
                $('.espace').show();
                $("#recap_level").html("ENTREPRISE");
                $("#form_level").val("ENT");
                $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
                $(".offre_n3").addClass('activated');
                $(".offre_n3 .offer-choice").addClass('activated');
                $(".offre_n4").removeClass('activated');
                $(".offre_n4 .offer-choice").removeClass('activated');
                $(".offre_n2").removeClass('activated');
                $(".offre_n2 .offer-choice").removeClass('activated');
                $(".offre_n1").removeClass('activated');
                $(".offre_n1 .offer-choice").removeClass('activated');
                $('#check_free_account').prop("checked", false);
                $('#form_free_account').val(0);
                $('#recap_duration').html('pour 1 an jusqu\'au');
                $('#recap_duration').show();
                $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
                $('#recap_amount_Y').show();
                $('#recap_amount_free').hide();
                $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
                calcAmount();
            })
            $('.offre_n4').click(() => {
                $("#recap_level").html("DEDIÉ");
                $("#form_level").val("DED");
                $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
                $(".offre_n4").addClass('activated');
                $(".offre_n4 .offer-choice").addClass('activated');
                $(".offre_n3").removeClass('activated');
                $(".offre_n3 .offer-choice").removeClass('activated');
                $(".offre_n2").removeClass('activated');
                $(".offre_n2 .offer-choice").removeClass('activated');
                $(".offre_n1").removeClass('activated');
                $(".offre_n1 .offer-choice").removeClass('activated');
                $('#check_free_account').prop("checked", false);
                $('#form_free_account').val(0);
                $('#recap_duration').html('pour 1 an jusqu\'au');
                $('#recap_duration').show();
                $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
                $('#recap_amount_Y').show();
                $('#recap_amount_free').hide();
                // $('.espace').hide();
                $('#recap_amount_Y').html('330 €');
                $('#recap_amount_M').html('30 €');
                //$('#price_M').html('<span id="recap_amount_M" class="fs-1 text-primary fw-bolder">30 €</span><span class="ms-2">par mois</span>');
                $('#price_M').show();
                $('#price_or').show();
                $('#recap_diskspace_go').html('Illimité');
                $('#recap_diskspace_gio').html('');


                //calcAmount();
            })

            $('#check_free_account').click(() => {
                $('.offre_n1').click();
                $('#check_free_account').prop("checked", true);
                $(".slider").slider("value", 10);
                sliderChange();
                $('#form_free_account').val(1);
                $("#form_expire").val("{{ $enddate30d->format('Y-m-d') }}");
                $("#recap_level").html("ESSAI");
                $("#form_level").val("ESS");
                $('#recap_duration').html('jusqu\'au');
                $('#price_M').hide();
                $('#recap_enddate').html('{{ $enddate30d->format('d/m/Y') }}');
                $('#recap_amount_Y').hide();
                $('#recap_amount_free').show();
            })

            // init values
            $('{{ $offer }}').click();
            $(".slider").slider("value", {{ $diskspace }});
            sliderChange();
            $('#access_name').val('{{ $access_name }}');
            $('#formCheck-2[value={{ $option }}]').prop("checked", true)
            if ('{{ $free_account }}' == 'true') {
                $('#check_free_account').click();
            }
            //$('#check_free_account').prop("checked", {{ $free_account }});
        };
</script>
@endpush
