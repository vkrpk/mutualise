window.onload = function () {
    "use strict";
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    let forms = document.querySelectorAll(".needs-validation");
    const slider = document.getElementById("taille");
    const output = document.getElementById("taille_output");
    output.innerHTML = slider.value + " Go";
    let percent = (slider.value / 5000) * 100;

    // const getAmount = function calcAmount(value, offer) {
    //     return fetch(`/amount?size=${value}&offer=${offer}`)
    //         .then(function (response) {
    //             return response.json();
    //         })
    //         .then((response) => {
    //             let recap = document.getElementById("recap_amount_Y");
    //             recap.innerHTML = Math.round(100 * response.Y) / 100 + " €";
    //             let recapPerMonth = document.getElementById("recap_amount_M");
    //             recapPerMonth.innerHTML =
    //                 Math.round(100 * response.M) / 100 + " €";
    //         });
    // };

    const calculAmount = function () {
        output.innerHTML = slider.value + " Go";
        let sliderValue = slider.value;
        let priceOr = document.getElementById("price_or");
        let priceM = document.getElementById("price_M");
        if (sliderValue >= 170) {
            priceOr.classList.contains("d-none")
                ? priceOr.classList.toggle("d-none")
                : "";
            priceM.classList.contains("d-none")
                ? priceM.classList.toggle("d-none")
                : "";
        } else {
            priceOr.classList.contains("d-none")
                ? ""
                : priceOr.classList.toggle("d-none");
            priceM.classList.contains("d-none")
                ? ""
                : priceM.classList.toggle("d-none");
        }
        const selectedOffer = document.querySelector(".selected");
        let price = getAmount(sliderValue, selectedOffer.getAttribute("offer"));
        return;
    };

    const changeInputColor = function () {
        percent = Math.round((slider.value / 5000) * 100);
        slider.style.background =
            "linear-gradient(to right, #Fe7e20 0%, #Fe7e20 " +
            percent +
            "%, #ffd6b8 " +
            percent +
            "%, #ffd6b8 100%)";
        return;
    };

    const debounce = function (fn, d) {
        let timer;
        return function () {
            clearTimeout(timer);
            timer = setTimeout(() => {
                calculAmount.apply();
            }, d);
        };
    };

    const onFinishTyping = debounce(calculAmount, 300);

    slider.addEventListener("input", changeInputColor);
    slider.addEventListener("input", onFinishTyping);

    const col_1 = document.querySelectorAll(".col1");
    const col_2 = document.querySelectorAll(".col2");
    const col_3 = document.querySelectorAll(".col3");
    const col_4 = document.querySelectorAll(".col4");
    const inputsDedicated = document.querySelectorAll(
        'input[id="dedicatedChoice"]'
    );
    const inputsBasique = document.querySelectorAll(
        'input[id="basiqueChoice"]'
    );
    const col_collection = [col_1, col_2, col_3, col_4];

    col_collection.forEach((column) =>
        column.forEach((element) =>
            element.addEventListener("click", function () {
                onFinishTyping();
                getUnselected(col_collection);
                getSelected(column);
            })
        )
    );

    function getUnselected(col_collection) {
        col_collection.forEach((column) =>
            column.forEach((element) => element.classList.remove("selected"))
        );
    }

    function getSelected(column) {
        console.log(column.children);
        for (let child of column.children) {
            console.log("element", child);
            column.classList.add("selected")
        }
        if (column != col_4) {
            inputsDedicated.forEach((input) => (input.checked = false));
        }
        if (column != col_1) {
            inputsBasique.forEach((input) => (input.checked = false));
        }
    }

    // slider.addEventListener(
    //     "input",
    //     setTimeout(() => {
    //         const timeoutId = calculAmount();
    //     }, 1000)
    // );

    // inputCheckFreeAccount.addEventListener("change", checkFreeAccount);

    /* sliders sorcery */

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
};

//     function calcAmount() {
//         let l = 1;
//         if ($('#form_free_account').val() == 0) {
//             ;
//             switch ($("#form_level").val()) {
//                 case 'BAS':
//                     l = 1;
//                     break;
//                 case 'STD':
//                     l = 2;
//                     break;
//                 case 'ENT':
//                     l = 3;
//                     break;
//                 case 'DED':
//                     l = 4;
//                     break;
//                 default:
//                     console.log("level undefined");
//             }
//             let s = $('#form_diskspace').val();
//             axios.post('/api/calc_price', {
//                     "level": l,
//                     "size": s
//                 })
//                 .then((response) => {
//                     let res = response.data.Y;
//                     //let resm = response.data.M/12;
//                     let resm = response.data.M;
//                     if (l == 4) {
//                         $("#recap_amount_Y").html(330 + " €");
//                         $("#recap_amount_M").html(30 + " €");
//                     } else {
//                         $("#recap_amount_Y").html(Math.round(100 * res) / 100 + " €");
//                         $("#recap_amount_M").html(Math.round(100 * resm) / 100 + " €");
//                     }

//                     if ($('#form_diskspace').val() >= 170) {
//                         $('#price_M').show();
//                         $('#price_or').show();
//                     } else {
//                         $('#price_M').hide();
//                         $('#price_or').hide();
//                     }
//                 })
//                 .catch((error) => {
//                     console.log(error);
//                 })
//         }
//     }

//     $('.offre_n1').click(() => {
//         $('.espace').show();
//         $("#recap_level").html("BASIQUE");
//         $("#form_level").val("BAS");
//         $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
//         $(".offre_n1").addClass('activated');
//         $(".offre_n1 .offer-choice").addClass('activated');
//         $(".offre_n2").removeClass('activated');
//         $(".offre_n2 .offer-choice").removeClass('activated');
//         $(".offre_n3").removeClass('activated');
//         $(".offre_n3 .offer-choice").removeClass('activated');
//         $(".offre_n4").removeClass('activated');
//         $(".offre_n4 .offer-choice").removeClass('activated');
//         $('#check_free_account').prop("checked", false);
//         $('#form_free_account').val(0);
//         $('#recap_duration').html('pour 1 an jusqu\'au');
//         $('#recap_duration').show();
//         $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
//         $('#recap_amount_Y').show();
//         $('#recap_amount_free').hide();
//         $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
//         calcAmount();
//     })
//     $('.offre_n2').click(() => {
//         $('.espace').show();
//         $("#recap_level").html("STANDARD");
//         $("#form_level").val("STD");
//         $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
//         $(".offre_n2").addClass('activated');
//         $(".offre_n2 .offer-choice").addClass('activated');
//         $(".offre_n1").removeClass('activated');
//         $(".offre_n1 .offer-choice").removeClass('activated');
//         $(".offre_n3").removeClass('activated');
//         $(".offre_n3 .offer-choice").removeClass('activated');
//         $(".offre_n4").removeClass('activated');
//         $(".offre_n4 .offer-choice").removeClass('activated');
//         $('#check_free_account').prop("checked", false);
//         $('#form_free_account').val(0);
//         $('#recap_duration').html('pour 1 an jusqu\'au');
//         $('#recap_duration').show();
//         $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
//         $('#recap_amount_Y').show();
//         $('#recap_amount_free').hide();
//         $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
//         calcAmount();
//     })
//     $('.offre_n3').click(() => {
//         $('.espace').show();
//         $("#recap_level").html("ENTREPRISE");
//         $("#form_level").val("ENT");
//         $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
//         $(".offre_n3").addClass('activated');
//         $(".offre_n3 .offer-choice").addClass('activated');
//         $(".offre_n4").removeClass('activated');
//         $(".offre_n4 .offer-choice").removeClass('activated');
//         $(".offre_n2").removeClass('activated');
//         $(".offre_n2 .offer-choice").removeClass('activated');
//         $(".offre_n1").removeClass('activated');
//         $(".offre_n1 .offer-choice").removeClass('activated');
//         $('#check_free_account').prop("checked", false);
//         $('#form_free_account').val(0);
//         $('#recap_duration').html('pour 1 an jusqu\'au');
//         $('#recap_duration').show();
//         $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
//         $('#recap_amount_Y').show();
//         $('#recap_amount_free').hide();
//         $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
//         calcAmount();
//     })
//     $('.offre_n4').click(() => {
//         $("#recap_level").html("DEDIÉ");
//         $("#form_level").val("DED");
//         $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
//         $(".offre_n4").addClass('activated');
//         $(".offre_n4 .offer-choice").addClass('activated');
//         $(".offre_n3").removeClass('activated');
//         $(".offre_n3 .offer-choice").removeClass('activated');
//         $(".offre_n2").removeClass('activated');
//         $(".offre_n2 .offer-choice").removeClass('activated');
//         $(".offre_n1").removeClass('activated');
//         $(".offre_n1 .offer-choice").removeClass('activated');
//         $('#check_free_account').prop("checked", false);
//         $('#form_free_account').val(0);
//         $('#recap_duration').html('pour 1 an jusqu\'au');
//         $('#recap_duration').show();
//         $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
//         $('#recap_amount_Y').show();
//         $('#recap_amount_free').hide();
//         // $('.espace').hide();
//         $('#recap_amount_Y').html('330 €');
//         $('#recap_amount_M').html('30 €');
//         //$('#price_M').html('<span id="recap_amount_M" class="fs-1 text-primary fw-bolder">30 €</span><span class="ms-2">par mois</span>');
//         $('#price_M').show();
//         $('#price_or').show();
//         $('#recap_diskspace_go').html('Illimité');
//         $('#recap_diskspace_gio').html('');

//         //calcAmount();
//     })

//     $('#check_free_account').click(() => {
//         $('.offre_n1').click();
//         $('#check_free_account').prop("checked", true);
//         $(".slider").slider("value", 10);
//         sliderChange();
//         $('#form_free_account').val(1);
//         $("#form_expire").val("{{ $enddate30d->format('Y-m-d') }}");
//         $("#recap_level").html("ESSAI");
//         $("#form_level").val("ESS");
//         $('#recap_duration').html('jusqu\'au');
//         $('#price_M').hide();
//         $('#recap_enddate').html('{{ $enddate30d->format('d/m/Y') }}');
//         $('#recap_amount_Y').hide();
//         $('#recap_amount_free').show();
//     })

//     // init values
//     $('{{ $offer }}').click();
//     $(".slider").slider("value", {{ $diskspace }});
//     sliderChange();
//     $('#access_name').val('{{ $access_name }}');
//     $('#formCheck-2[value={{ $option }}]').prop("checked", true)
//     if ('{{ $free_account }}' == 'true') {
//         $('#check_free_account').click();
//     }
//     //$('#check_free_account').prop("checked", {{ $free_account }});
// };
