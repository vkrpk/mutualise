@extends('layouts.app')

@section('content')
    <div class="container-fluid px-0 gx-0">
        <section class="d-flex flex-column align-items-center" style="position: relative;background: url('{{ Vite::asset("resources/images/service-sauvegarde-stockage-owncloud.jpeg") }}') center / cover no-repeat">
            <div class="row text-white text-center gy-5 py-5 px-2 px-md-0 container opacityBackground">
                <p class="h1 fw-bolder px-sm-5 px-0">SAUVEGARDE ET PARTAGE DE DONNÉES EN LIGNE</p>
                <p class="h3 px-sm-5 px-0">PLATEFORME COLLABORATIVE - ESPACE DE TRAVAIL NUMERIQUE</p>
                <div class="row-cols d-flex align-items-center flex-column flex-sm-row py-sm-5" style="background: url('{{ Vite::asset("resources/images/Data-Center.jpg") }}') center / cover no-repeat; ">
                    <div class="col py-3 py-sm-0">
                        <p class="h5">Services mutualisés</p>
                        <a href="#" class="">
                            <button class="btn btn-secondary text-uppercase fw-bolder">Découvrir</button>
                        </a>
                    </div>
                    <div class="col py-3 py-sm-0">
                        <p class="h5">Services dédiés</p>
                        <a href="#" class="">
                            <button class="btn btn-secondary text-uppercase fw-bolder">Découvrir</button>
                        </a>
                    </div>
                </div>
                <p class="h4">DediKam est une association, indépendante sans publicité, totalement transparente et non lucrative. Nous offrons divers outils collaboratifs pour tout type d’utilisateurs, du particulier au professionnel</p>
                <p class="text-secondary text-uppercase fw-bolder h4"><u>Qui sommes nous ?</u></p>
            </div>
        </section>
        <section class="d-flex flex-column align-items-center py-5" style="background-image: linear-gradient(180deg, #fe7e20 0%, #74ba58 100%);--bs-primary: #74ba58;--bs-primary-rgb: 116,186,88;--bs-secondary: #fe7e20;--bs-secondary-rgb: 254,126,32;">
            <div class="container d-flex flex-column align-items-center">
                <div class="row text-center justify-content-center">
                    <p class="h4 fw-bolder">Nos services mutualisés</p>
                    <div class="mb-2 bg-primary" style="height: 5px; width: 130px;"></div>
                    <p class="h5 mb-5">Avec le service mutualisé, nous vous proposons des outils collaboratifs et des outils web pour gérer vos données comme bon vous semble<br>
                        Nous utilisons des outils 100% logiciel libre capable de répondre et de s’adapter aux besoins de nos utilisateurs
                    </p>
                </div>
                <div class="row justify-content-evenly flex-column flex-md-row mx-2 mx-sm-0" style="max-width: 1164px">
                    <div class="shadowBox col me-md-4 px-0 flex-column align-items-center bg-white text-center col-md-6 border-transparent rounded-4 overflow-hidden outilsWebEtCollaboratifs mb-5 mb-md-0 mt-3 mt-md-0">
                        <p class="h4 fw-bolder py-4 bg-primary">Outils collaboratifs</p>
                        <div class="px-2">
                            <figure>
                                <img src="{{ Vite::asset('resources/images/Nextcloud_Logo.svg') }}" alt="Nextcloud logo">
                            </figure>
                            <p>Nextcloud est un logiciel libre offrant une plateforme de partage de documents avancés qui vous offre un contrôle total sur vos paramètres de partage de fichiers. Il se présente comme une alternative à Google docs.</p>
                        </div>
                        <div class="px-2">
                            <figure>
                                <img src="{{ Vite::asset('resources/images/pydio.png') }}" alt="Pydio logo">
                                <figcaption>Pydio 8</figcaption>
                            </figure>
                            <p>Pydio est un logiciel libre offrant une plateforme de services de stockage et de partage de fichiers. Il se présente également comme une alternative à Dropbox.</p>
                        </div>
                    </div>
                    <div class="shadowBox col px-0 col-md-6 bg-white border-transparent rounded-4 overflow-hidden outilsWebEtCollaboratifs">
                        <p class="h4 fw-bolder py-4 bg-primary text-center mb-0">Outils web</p>
                        <div class="d-flex">
                            <div class="d-flex flex-column px-3 align-items-center pt-2">
                                <p style="width:91px"><button class="btn btn-secondary w-100">FTPS/FTP</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">SSH</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">ISCSI</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">SFTP</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">CIFS</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">WEBDAV</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">RSYNC</button></p>
                            </div>
                            <div class="col px-2 border-start pt-2">
                                <p class="justify">WebDAV est un protocole de longue date qui permet à un serveur Web d’agir comme un serveur de fichiers ett de prendre en charge la création collaborative de contenu sur le Web. Bien qu’étant supplanté par des mécanismes plus modernes, il reste un outil de travail fiable rencontré dans de nombreux serveurs, clients et applications différentes.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="opacityBackground rounded-4 text-center py-3 border border-secondary mt-5 text-white px-5">
                    <p class="h3">COMMANDEZ OU TESTEZ !</p>
                    <p>Testez nos services mutualisés pendant 30 jours avec <br><strong>10 Go de stockage gratuit</strong></p>
                    <a href="#"><button class="btn btn-secondary">Inscription</button></a>
                </div>
            </div>
        </section>
        <section class="d-flex flex-column align-items-center py-5">
            <div class="container">
                <div class="row text-center justify-content-center">
                    <p class="h4 fw-bolder">Nos services dédiés</p>
                    <div class="mb-2 bg-primary" style="height: 5px; width: 130px;"></div>
                    <p class="h5 mb-5">Nous vous proposons une solution dédiée NextCloud sur des serveurs de type VPS</p>
                </div>
                <div class="shadowBox rounded-4 text-center py-3 px-5 border border-primary" style="background-color: #E2E8E9;">
                    <p>A la différence du service mutualisé, le service dédié vous apporte un gain de performance significative puisque vous êtes seul sur le serveur.</p>
                    <p><strong>1 utilisateur = 1 serveur</strong></p>
                    <p>Cela permet d'exploiter à 100% les ressources matérielles et vous apporte une totale liberté dans l'administration de votre instance NextCloud. Disponibilité supplémentaire pour vos données entreprises.</p>
                    <p><u><strong>Marque blanche et personnalisation</strong></u></p>
                </div>
            </div>
        </section>
    </div>
@endsection
