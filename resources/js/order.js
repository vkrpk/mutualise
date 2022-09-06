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
