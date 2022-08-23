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

@section('content')
    <form action="{{ url('member_accesses') }}" class="needs-validation" method="POST" novalidate>@csrf
        <div class="row">
            <div class="col px-sm-0">
                <div class="alert alert-primary mt-4 mb-2 fs-2 fw-bolder" role="alert"><span>Ajouter un accès</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card border-secondary">
                    <div class="card-body d-flex flex-column align-middle">
                        <h4 class="card-title align-self-center">Offre d'essai : 10 Go gratuits</h4>
                        <p class="card-text align-self-center">Testez toutes les fonctionnalités Dedikam gratuitement
                            pendant 30 jours.<br>Vous pouvez commander jusqu'à 4 accès gratuits. Il vous en reste
                            {{ $nbfreeaccount }}.</p>
                        <div class="form-check align-self-center"><input id="check_free_account" class="form-check-input"
                                type="checkbox" id="formCheck-1" {{ $nbfreeaccount == 0 ? 'disabled' : '' }}><label
                                class="form-check-label" for="formCheck-1">Profiter de l'offre</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="row pt-2 offer_content pb-2">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <h1 class="pricing headline text-center" style="font-family: Roboto, sans-serif;">Choisissez
                                    votre formule</h1>
                                <h3 class="pricing-sub-headline text-center">Toutes vos données fragmentées, copiées et
                                    réparties sur différents serveurs et Datacenters selon le niveau de disponibilité
                                    choisi. <a class="text-secondary" href="https://www.dedikam.com/lexique/#niveaux"
                                        target="_blank">En savoir plus</a></h3>
                                {{-- <div class="row row-cols-2 row-cols-lg-4">
                                    <div class="col hover offre selected">
                                        <div class="row" style="height: 2rem;">
                                            <div class="col offre_n1 offer_hf activated">
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n1 offer_body activated fs-4 py-4 fw-bolder">
                                                <span>BASIC</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n1 offer_body activated py-2 fs-6 d-flex justify-content-center"
                                                style="height: 4rem;"><span class="align-self-center my-3">Données réparties
                                                    sur 1 serveur</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n1 offer_body activated py-2 fs-6 d-flex justify-content-center flex-wrap"
                                                style="height: 20rem;"><span class="mx-1 dedikam_pulse my-3"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;Pydio<br></span><span
                                                    class="mx-1 my-3 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;Nextcloud<br></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div
                                                class="col offre_n1 offer_body activated d-flex justify-content-center flex-column">
                                                <span class="fs-5 fw-bolder"><br>disponibilité normale<br><br></span><span
                                                    class="offer-choice activated p-2 border border-white border-2 rounded fw-bold">Votre
                                                    choix</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n1 offer_hf activated">
                                                <div style="height: 2rem;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col hover offre">
                                        <div class="row" style="height: 2rem;">
                                            <div class="col offre_n2 offer_hf">
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n2 offer_body fs-4 py-4 fw-bolder">
                                                <span>STANDARD</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n2 offer_body py-2 fs-6 d-flex justify-content-center"
                                                style="height: 4rem;"><span class="align-self-center my-3">Données réparties
                                                    sur 2 serveurs<br></span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n2 offer_body py-2 fs-6 d-flex justify-content-center flex-wrap"
                                                style="height: 20rem;"><span class="mx-1 my-3 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;Pydio<br></span><span
                                                    class="mx-1 my-3 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;Nextcloud<br></span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;SSH</span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;RSYNC sur
                                                    SSH</span><span class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;SFTP</span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;FTPS / FTP</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n2 offer_body d-flex justify-content-center flex-column">
                                                <span class="fs-5 fw-bolder"><br>disponibilité accrue<br><br></span><span
                                                    class="offer-choice p-2 border border-white border-2 rounded fw-bold">Votre
                                                    choix</span>
                                            </div>
                                        </div>
                                        <div class="row" style="height: 2rem;">
                                            <div class="col offre_n2 offer_hf">
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col hover offre">
                                        <div class="row" style="height: 2rem;">
                                            <div class="col offre_n3 offer_hf">
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n3 offer_body fs-4 py-4 fw-bolder">
                                                <span>ENTREPRISE</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n3 offer_body py-2 fs-6 d-flex justify-content-center"
                                                style="height: 4rem;"><span class="align-self-center my-3">Données réparties
                                                    sur 3 serveurs et 2 datacenters<br></span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n3 offer_body py-2 fs-6 d-flex justify-content-center flex-wrap"
                                                style="height: 20rem;"><span class="mx-1 dedikam_pulse my-3"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;Pydio<br></span><span
                                                    class="mx-1 my-3 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;Nextcloud<br></span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;SSH</span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;RSYNC sur
                                                    SSH</span><span class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;SFTP</span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;FTPS /
                                                    FTP</span><span class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;iSCSI</span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;CIFS</span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;WEBDAV</span><span
                                                    class="my-3 mx-1 dedikam_pulse"><i
                                                        class="fa fa-check text-primary fs-2"></i>&nbsp;SI</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n3 offer_body d-flex justify-content-center flex-column">
                                                <span class="fs-5 fw-bolder"><br>disponibilité critique<br><br></span><span
                                                    class="offer-choice p-2 border border-white border-2 rounded fw-bold">Votre
                                                    choix</span>
                                            </div>
                                        </div>
                                        <div class="row" style="height: 2rem;">
                                            <div class="col offre_n3 offer_hf">
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col hover offre">
                                        <div class="row" style="height: 2rem;">
                                            <div class="col offre_n4 offer_hf">
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n4 offer_body fs-4 py-4 fw-bolder"><span
                                                    dedie="">DEDIÉ</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n4 offer_body py-2 fs-6 d-flex justify-content-center"
                                                style="height: 4rem;"><span class="align-self-center my-3">Données
                                                    réparties
                                                    sur 3 serveurs et 2 datacenters<br></span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col d-flex flex-column offre_n4 offer_body py-2 fs-6"
                                                style="height: 20rem;"><span class="mx-1 my-3">&nbsp;Option au choix
                                                    :<br></span>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input me-2" type="radio" id="formCheck-2"
                                                        name="form_ded_option" value="nextcloud" checked>
                                                    <label class="form-check-label" for="formCheck-2">Nextcloud</label>
                                                </div>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input me-2" type="radio" id="formCheck-2"
                                                        name="form_ded_option" value="pydio">
                                                    <label class="form-check-label" for="formCheck-2">Pydio</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col offre_n4 offer_body d-flex justify-content-center flex-column">
                                                <span class="fs-5 fw-bolder"><br />VPS<br /><br /></span><span
                                                    class="offer-choice p-2 border border-white border-2 rounded fw-bold">Votre
                                                    choix</span>
                                            </div>
                                        </div>
                                        <div class="row" style="height: 2rem;">
                                            <div class="col offre_n4 offer_hf">
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col comparison">
                                    <table>
                                        <colgroup>
                                            <col>
                                            <col class="offer">
                                            <col class="offer selected">
                                            <col class="offer">
                                            <col class="offer">
                                        </colgroup>
                                        <thead>
                                            <tr class="price-header">
                                                <th class="tl tl2" valign="bottom"></th>
                                                <th class="qbse qbse-first">
                                                    <h3> BASIQUE </h3>
                                                    <p>Données regroupées sur 1 serveur</p>
                                                </th>
                                                <th class="qbse qbse-second">
                                                    <h3> STANDARD </h3>
                                                    <p>Données réparties sur 2 serveurs</p>
                                                </th>
                                                <th class="qbse qbse-third">
                                                    <h3> ENTREPRISE </h3>
                                                    <p>Données réparties sur 3 serveurs et 2 datacenters</p>
                                                </th>
                                                <th class="qbse qbse-last">
                                                    <h3> DÉDIÉ </h3>
                                                    <p>Données réparties sur 3 serveurs et 2 datacenters</p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td colspan="3">Pydio</td>
                                            </tr>
                                            <tr>
                                                <td>Pydio</td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td rowspan="11">
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input me-2" type="radio" id="formCheck-2"
                                                            name="form_ded_option" value="nextcloud" checked>
                                                        <label class="form-check-label" for="formCheck-2">Nextcloud</label>
                                                    </div>
                                                    <div class="form-check d-flex justify-content-center">
                                                        <input class="form-check-input me-2" type="radio" id="formCheck-2"
                                                            name="form_ded_option" value="pydio">
                                                        <label class="form-check-label" for="formCheck-2">Pydio</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">NextCloud</td>
                                            </tr>
                                            <tr>
                                                <td>NextCloud</td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">SSH</td>
                                            </tr>
                                            <tr>
                                                <td>SSH</td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">RSYNC sur SSH</td>
                                            </tr>
                                            <tr>
                                                <td>RSYNC sur SSH</td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">SFTP</td>
                                            </tr>
                                            <tr>
                                                <td>SFTP</td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">FTPS/FTP</td>
                                            </tr>
                                            <tr>
                                                <td>FTPS/FTP</td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">iSCSI</td>
                                            </tr>
                                            <tr>
                                                <td>iSCSI</td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">CIFS</td>
                                            </tr>
                                            <tr>
                                                <td>CIFS</td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">WEBDAV</td>
                                            </tr>
                                            <tr>
                                                <td>WEBDAV</td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td colspan="3">SI</td>
                                            </tr>
                                            <tr>
                                                <td>SI</td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td><i class="fa-solid fa-xmark"></i></td>
                                                <td class="checked"><i class="fa-solid fa-check"></i></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="options"></td>
                                                <td class="package-btn pack-1"><a href="#"
                                                        class="n-button n-button-grey button-offer">Choisir</a></td>
                                                <td class="package-btn pack-2"><a href="#"
                                                        class="n-button n-button-blue button-offer">Choisir</a></td>
                                                <td class="package-btn pack-3"><a href="#"
                                                        class="n-button n-button-purple button-offer">Choisir</a></td>
                                                <td class="package-btn pack-4"><a href="#"
                                                        class="n-button n-button-green button-offer">Choisir</a></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 espace">
            <div class="col">
                <div class="row">
                    <div class="col d-flex flex-nowrap">
                        <!--<span class="offer_legend1">2</span>-->
                        <span class="offer_legend2 align-self-center">Choisissez votre espace disque en déplaçant le
                            curseur orange vers la droite<br></span>
                    </div>
                </div>
                <div class="row pt-2 offer_content">
                    <div class="col">
                        <div class="row">
                            <div class="col"><span>Tarif affiché en bas de page</span></div>
                        </div>
                        <div class="row">
                            <div class="col d-none d-md-grid col-md-1"></div>
                            <div class="col align-self-center col-12 col-md-11">
                                <div class="row range-slider-container align-items-center" style="margin-top: 70px;">
                                    <div class="col col-2"><span>Espace disque : <span id="taille_output">10
                                                Go</span></span></div>
                                    {{-- insert range here --}}

                                    <input type="range" class="rs-range" name="taille" id="taille" min="10"
                                        max="5000" step="10" value="10">
                                </div>
                                <div class="row mt-2">
                                    <div class="col d-none d-md-grid col-md-2"></div>
                                    <div class="col text-center"><span>Trafic illimité - Bande passante : 500 Mbit/s à
                                            1Gbit/s<br>Au dessus de 5000Go, veuillez nous&nbsp;<a class="text-secondary"
                                                href="https://www.dedikam.com/contact/"
                                                target="_blank">contacter</a>.<br><br></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="row">
                    <div class="col d-flex flex-nowrap">
                        <!--<span class="offer_legend1">3</span>-->
                        <span class="offer_legend2 align-self-center">Choisissez un nom pour l'accès<br></span>
                    </div>
                </div>
                <div class="row pt-2 offer_content pb-2">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="form_access_name" data-bs-toggle="tooltip" data-bss-tooltip=""
                                data-bs-placement="right" id="access_name"
                                class="form-control  @error('form_access_name') is-invalid @enderror"
                                @error('form_access_name') autofocus @enderror placeholder="Nom de l'accès" required
                                style="width: 20rem;" title="Donnée obligatoire" maxlength="40"
                                value="{{ old('form_access_name') }}"
                                aria-describedby="validationform_access_nameFeedback">
                            <label class="form-label" for="access_name">Nom de l'accès<sup><i class="bi bi-asterisk ms-1"
                                        style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
                            <div class="invalid-feedback">
                                Le nom de l'accès est obligatoire
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <div class="row">
                    <div class="col d-flex flex-nowrap">
                        <!--<span class="offer_legend1">4</span>-->
                        <span class="offer_legend2 align-self-center">Récapitulatif de votre commande<br></span>
                    </div>
                </div>
                <div class="row pt-2 offer_content pb-2">
                    <div class="col d-table">
                        <div class="table-responsive my-3" style="max-width: 50rem;margin-left: auto;margin-right: auto">
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
                                            <div><span id="recap_level" class="fs-2 fw-bolder">BASIC</span></div>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <div class="d-flex flex-column"><span id="recap_diskspace_go"
                                                    class="fs-2 fw-bold">10 Go</span><span id="recap_diskspace_gio">( 9.31
                                                    Gio )</span></div>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <div class="d-flex flex-column align-items-start">
                                                <div id="price_Y" class="ms-5 d-flex flex-wrap"><span
                                                        id="recap_amount_Y" class="fs-1 text-primary fw-bolder">2
                                                        €</span><span id="recap_amount_free"
                                                        class="fs-1 text-primary fw-bolder" style="display: none;">gratuit
                                                        pour 30 jours</span><span id="recap_duration"
                                                        class="ms-2 me-1 text-align-buttom d-flex align-items-end">pour 1
                                                        an
                                                        jusqu'au</span><span id="recap_enddate"
                                                        class="d-flex align-items-end">01/06/2022</span>
                                                </div>
                                                <div id="price_or" class="ms-5" style="display: none;"><span
                                                        class="fs-3 text-secondary fw-bolder">ou</span></div>
                                                <div id="price_M" class="ms-5" style="display: none;"><span
                                                        id="recap_amount_M" class="fs-1 text-primary fw-bolder">2
                                                        €</span><span class="ms-2">par mois</span></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <input type="hidden" id="form_level" name="form_level" value="BAS">
                <input type="hidden" id="form_free_account" name="form_free_account" value="0">
                <input type="hidden" id="form_diskspace" name="form_diskspace" value="10">
                <input type="hidden" id="form_expire" name="form_expire" value="">
                <button class="btn btn-lg fs-3 btn-primary" type="submit"><i class="bi bi-cart-plus-fill"></i>
                    Ajouter au panier
                </button>
            </div>
        </div>
    </form>
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
                    "%, #d5d9da " + percent + "%, #d5d9da 100%)";
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

            const offres = document.querySelectorAll('.offer');
            const button_offer = document.querySelectorAll('.button-offer')

            const correspondance = {}

            for (let i = 0; i < offres.length; i++) {
                correspondance[offres[i]] = button_offer[i]
            }

            window.addEventListener('click', function() {
                console.log(offres);
                console.log(button_offer);
                console.log(correspondance);
            })

            button_offer.forEach(bouton => bouton.addEventListener('click', function(e) {
                e.preventDefault()
                console.log(this.parentNode);
                console.log(offres);
                console.log(button_offer);
            }))

            offres.forEach(offre => offre.addEventListener('click', function() {
                offres.forEach(offre => offre.classList.remove('selected'))
                if (!this.classList.contains('selected')) {
                    this.classList.add('selected')
                } else {
                    this.classList.remove('selected')
                }
            }))

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

            // $('.offre_n1').click(() => {
            //     $('.espace').show();
            //     $("#recap_level").html("BASIQUE");
            //     $("#form_level").val("BAS");
            //     $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
            //     $(".offre_n1").addClass('activated');
            //     $(".offre_n1 .offer-choice").addClass('activated');
            //     $(".offre_n2").removeClass('activated');
            //     $(".offre_n2 .offer-choice").removeClass('activated');
            //     $(".offre_n3").removeClass('activated');
            //     $(".offre_n3 .offer-choice").removeClass('activated');
            //     $(".offre_n4").removeClass('activated');
            //     $(".offre_n4 .offer-choice").removeClass('activated');
            //     $('#check_free_account').prop("checked", false);
            //     $('#form_free_account').val(0);
            //     $('#recap_duration').html('pour 1 an jusqu\'au');
            //     $('#recap_duration').show();
            //     $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
            //     $('#recap_amount_Y').show();
            //     $('#recap_amount_free').hide();
            //     $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
            //     calcAmount();
            // })
            // $('.offre_n2').click(() => {
            //     $('.espace').show();
            //     $("#recap_level").html("STANDARD");
            //     $("#form_level").val("STD");
            //     $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
            //     $(".offre_n2").addClass('activated');
            //     $(".offre_n2 .offer-choice").addClass('activated');
            //     $(".offre_n1").removeClass('activated');
            //     $(".offre_n1 .offer-choice").removeClass('activated');
            //     $(".offre_n3").removeClass('activated');
            //     $(".offre_n3 .offer-choice").removeClass('activated');
            //     $(".offre_n4").removeClass('activated');
            //     $(".offre_n4 .offer-choice").removeClass('activated');
            //     $('#check_free_account').prop("checked", false);
            //     $('#form_free_account').val(0);
            //     $('#recap_duration').html('pour 1 an jusqu\'au');
            //     $('#recap_duration').show();
            //     $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
            //     $('#recap_amount_Y').show();
            //     $('#recap_amount_free').hide();
            //     $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
            //     calcAmount();
            // })
            // $('.offre_n3').click(() => {
            //     $('.espace').show();
            //     $("#recap_level").html("ENTREPRISE");
            //     $("#form_level").val("ENT");
            //     $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
            //     $(".offre_n3").addClass('activated');
            //     $(".offre_n3 .offer-choice").addClass('activated');
            //     $(".offre_n4").removeClass('activated');
            //     $(".offre_n4 .offer-choice").removeClass('activated');
            //     $(".offre_n2").removeClass('activated');
            //     $(".offre_n2 .offer-choice").removeClass('activated');
            //     $(".offre_n1").removeClass('activated');
            //     $(".offre_n1 .offer-choice").removeClass('activated');
            //     $('#check_free_account').prop("checked", false);
            //     $('#form_free_account').val(0);
            //     $('#recap_duration').html('pour 1 an jusqu\'au');
            //     $('#recap_duration').show();
            //     $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
            //     $('#recap_amount_Y').show();
            //     $('#recap_amount_free').hide();
            //     $('#recap_diskspace_go').html($(".slider").slider("value") + "Go");
            //     calcAmount();
            // })
            // $('.offre_n4').click(() => {
            //     $("#recap_level").html("DEDIÉ");
            //     $("#form_level").val("DED");
            //     $("#form_expire").val('{{ $enddate1y->format('Y-m-d') }}');
            //     $(".offre_n4").addClass('activated');
            //     $(".offre_n4 .offer-choice").addClass('activated');
            //     $(".offre_n3").removeClass('activated');
            //     $(".offre_n3 .offer-choice").removeClass('activated');
            //     $(".offre_n2").removeClass('activated');
            //     $(".offre_n2 .offer-choice").removeClass('activated');
            //     $(".offre_n1").removeClass('activated');
            //     $(".offre_n1 .offer-choice").removeClass('activated');
            //     $('#check_free_account').prop("checked", false);
            //     $('#form_free_account').val(0);
            //     $('#recap_duration').html('pour 1 an jusqu\'au');
            //     $('#recap_duration').show();
            //     $('#recap_enddate').html('{{ $enddate1y->format('d/m/Y') }}');
            //     $('#recap_amount_Y').show();
            //     $('#recap_amount_free').hide();
            //     // $('.espace').hide();
            //     $('#recap_amount_Y').html('330 €');
            //     $('#recap_amount_M').html('30 €');
            //     //$('#price_M').html('<span id="recap_amount_M" class="fs-1 text-primary fw-bolder">30 €</span><span class="ms-2">par mois</span>');
            //     $('#price_M').show();
            //     $('#price_or').show();
            //     $('#recap_diskspace_go').html('Illimité');
            //     $('#recap_diskspace_gio').html('');


            //     //calcAmount();
            // })

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
