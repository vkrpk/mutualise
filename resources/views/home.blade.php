@extends('layouts.app')

@section('content')
    <div class="container-fluid px-0 gx-0">
        <section class="d-flex flex-column align-items-center" style="position: relative;background: url('{{ Vite::asset("resources/images/bx.jpg") }}') center / cover no-repeat">
            <div class="row text-primary text-center gy-5 py-5 px-2 px-md-0 container">
                <p class="h1 fw-bolder px-sm-5 px-0">{{Str::upper(__("Sauvegarde et partage de données en ligne"))}}</p>
                <p class="h3 px-sm-5 px-0 text-primary">{{Str::upper(__("Plateforme collaborative - espace de travail numérique"))}}</p>
                <p id="sectionServicesMutualises" class="text-primary text-uppercase fw-bolder h4"><u>{{__("Qui sommes-nous ?")}}</u></p>

                <p class="text-primary h3">{{__("Mutualisé est une association, indépendante sans publicité, totalement transparente et non lucrative. Nous offrons divers outils collaboratifs pour tout type d’utilisateurs, du particulier au professionnel")}}</p>

                <div class="row-cols d-flex align-items-center flex-column flex-sm-row py-sm-5" style="background: url('{{ Vite::asset("resources/images/Data-Center.jpg") }}') center / cover no-repeat; ">
                    <div class="col py-3 py-sm-0">
                        <p class="h3 text-white">{{__("Services mutualisés")}}</p>
                        <a href="#sectionServicesMutualises">
                            <button class="btn btn-secondary text-uppercase fw-bolder">{{__("Découvrir")}}</button>
                        </a>
                    </div>
                    <div class="col py-3 py-sm-0">
                        <p class="h3 text-white">{{__("Services dédiés")}}</p>
                        <a href="#sectionServicesDedies">
                            <button class="btn btn-secondary text-uppercase fw-bolder">{{__("Découvrir")}}</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="d-flex flex-column align-items-center py-5" style="background-image: linear-gradient(180deg, #fa8334 0%, #17b890 100%);--bs-primary: #74ba58;--bs-primary-rgb: 116,186,88;--bs-secondary: #fe7e20;--bs-secondary-rgb: 254,126,32;">
            <div class="container d-flex flex-column align-items-center">
                <div class="row text-center justify-content-center">
                    <p class="h4 fw-bolder">{{__("Nos services mutualisés")}}</p>
                    <div class="mb-2 bg-primary" style="height: 5px; width: 130px;"></div>
                    <p class="h5 mb-5">{{__("Avec le service mutualisé, nous vous proposons des outils collaboratifs et des outils web pour gérer vos données comme bon vous semble")}}<br>
                        {{__("Nous utilisons des outils 100% logiciel libre capable de répondre et de s’adapter aux besoins de nos utilisateurs")}}
                    </p>
                </div>
                <div class="row justify-content-evenly flex-column flex-md-row mx-2 mx-sm-0" style="max-width: 1164px">
                    <div class="shadowBox col me-md-4 px-0 flex-column align-items-center bg-white text-center col-md-6 border-transparent rounded-4 overflow-hidden outilsWebEtCollaboratifs mb-5 mb-md-0 mt-3 mt-md-0">
                        <p class="h4 fw-bolder py-4 bg-tertiaryBis text-white">{{__("Outils collaboratifs")}}</p>
                        <div class="px-2">
                            <figure>
                                <img src="{{ Vite::asset('resources/images/Nextcloud_Logo.svg') }}" alt="Nextcloud logo">
                            </figure>
                            <p>{{__("Nextcloud est un logiciel libre offrant une plateforme de partage de documents avancés qui vous offre un contrôle total sur vos paramètres de partage de fichiers. Il se présente comme une alternative à Google docs.")}}</p>
                        </div>
                        <div class="px-2">
                            <figure class="mb-0">
                                <img src="{{ Vite::asset('resources/images/seafile-logo.jpeg') }}" alt="Pydio logo" style="max-width: 141px; height: auto">
                            </figure>
                            <p>{{__("Seafile est un logiciel libre offrant une plateforme de services de stockage et de partage de fichiers. Il se présente également comme une alternative à Dropbox.")}}</p>
                        </div>
                    </div>
                    <div class="shadowBox col px-0 col-md-6 bg-white border-transparent rounded-4 overflow-hidden outilsWebEtCollaboratifs">
                        <p class="h4 fw-bolder py-4 bg-tertiaryBis text-center mb-0 text-white">{{__("Outils web")}}</p>
                        <div class="d-flex">
                            <div class="d-flex flex-column px-3 align-items-center pt-2" id="boxForTheButtonsInOutilsWeb">
                                <p style="width:91px"><button class="btn btn-secondary w-100">FTPS/FTP</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">SSH</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">ISCSI</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">SFTP</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">CIFS</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">WEBDAV</button></p>
                                <p style="width:91px"><button class="btn btn-secondary w-100">RSYNC</button></p>
                            </div>
                            <div class="col px-2 border-start pt-2">
                                <p class="justify" id="textForTheButtonsInOutilsWeb">{{__("WebDAV est un protocole de longue date qui permet à un serveur Web d’agir comme un serveur de fichiers et de prendre en charge la création collaborative de contenu sur le Web. Bien qu’étant supplanté par des mécanismes plus modernes, il reste un outil de travail fiable rencontré dans de nombreux serveurs, clients et applications différentes.")}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="opacityBackground rounded-4 text-center py-3 border border-secondary mt-5 text-white px-5">
                    <p class="h3">{{Str::upper(__("Commandez ou testez !"))}}</p>
                    <p>{{__("Testez nos services mutualisés pendant 30 jours avec")}} <br><strong>{{__("10 Go de stockage gratuit")}}</strong></p>
                    <a id="sectionServicesDedies" href="{{ route('register') }}"><button class="btn btn-secondary">{{__("Register")}}</button></a>
                </div>
            </div>
        </section>
        <section class="d-flex flex-column align-items-center py-5">
            <div class="container">
                <div class="row text-center justify-content-center">
                    <p class="h4 fw-bolder">{{__("Nos services dédiés")}}</p>
                    <div class="mb-2 bg-primary" style="height: 5px; width: 130px;"></div>
                    <p class="h5 mb-5">{{__("Nous vous proposons une solution dédiée (NextCloud ou Seafile) sur des serveurs de type VPS")}}</p>
                </div>
                <div class="shadowBox rounded-4 text-center py-3 px-5 border border-primary mb-5" style="background-color: #E2E8E9;">
                    <p>{{__("A la différence du service mutualisé, le service dédié vous apporte un gain de performance significative puisque vous êtes seul sur le serveur.")}}</p>
                    <p><strong>{{__("1 utilisateur = 1 serveur")}}</strong></p>
                    <p>{{__("Cela permet d'exploiter à 100% les ressources matérielles et vous apporte une totale liberté dans l'administration de votre instance NextCloud. Disponibilité supplémentaire pour vos données entreprises.")}}</p>
                    <p><u><strong>{{__("Marque blanche et personnalisation")}}</strong></u></p>
                </div>
                <div class="border border-primary rounded-4 shadowBox overflow-hidden pb-3" style="background: #FFFCFC">
                    <p class="h4 fw-bolder py-4 bg-tertiaryBis text-center mb-0 text-white">{{Str::upper(__("Service Nextclound Pro"))}}</p>
                    <p class="h4 fw-bolder py-4 bg-tertiary text-center mb-0 px-2">{{__("ESPACE DISQUE JUSQU'A 5 To (5000 Go) Extensible")}}</p>
                    <div class="row d-flex flex-column align-items-start p-2 boxServiceNextcloudPro">
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Nom de domaine et interface personnalisable")}}</p>
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Infogérance complète du serveur et de l’instance")}}</p>
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Accès administrateur, nombre d'utilisateurs illimités")}}</p>
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Sauvegarde externalisée des données et réplication sur plusieurs serveurs")}}</p>
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Archivage des données avec une rétention de 10 jours")}}</p>
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Accès aux archives via le protocole FTP/FTPS (emergency connexion)")}}</p>
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Traffic illimité")}}</p>
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Pas d’engagement – possibilité de vous désabonnez à tout moment")}}</p>
                        <p class="d-flex align-items-start col-md offset-md-2 offset-xxl-3">
                            <span class="text-tertiaryBis me-2"><i class="fa-solid fa-circle-check"></i></span>{{__("Paiement mensuel ou annuel")}}</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('offers') }}"><button class="btn btn-secondary">{{__("Commandez")}}</button></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 px-2" style="position: relative;background: url('{{ Vite::asset("resources/images/service-fichier-owncloud2.jpg") }}') center / cover no-repeat">
            <div class="container">
                <div class="opacityBackgroundMoreOpace rounded-4 border border-secondary text-white text-center py-5 px-lg-5 px-2">
                    <p class="h2 mb-4">{{__("Déjà 14 années d'expérience dans la sauvegarde en ligne")}}</p>
                    <p class="h5 mb-4 px-lg-5 px-0">{{__("Identifiez vos besoins en matière de sauvegarde ou de partage de données et si besoin, contactez-nous par mail ou par téléphone pour vous assister et vous proposer la solution la plus adaptée à vos attentes.")}}</p>
                    <a href="{{ route('contact.index') }}"><button class="btn btn-secondary btn-lg">{{__("Demande d'informations")}}</button></a>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        const textForTheButtonsInOutilsWeb = document.getElementById("textForTheButtonsInOutilsWeb")
        const boxForTheButtonsInOutilsWeb = document.getElementById("boxForTheButtonsInOutilsWeb").querySelectorAll("p")

        boxForTheButtonsInOutilsWeb.forEach(button => {
            button.addEventListener("click", () => {
                switch (button) {
                    case boxForTheButtonsInOutilsWeb[1]:
                        textForTheButtonsInOutilsWeb.innerHTML = "{{__("L’accès SSH vous permet d’accéder à une console SSH reliée directement à votre compte Mutualisé à travers une connexion entièrement chiffrée et sécurisée. L’authentification à cette console peut se faire via un couple login/mot de passe ou via un couple clé privée/clé publique.")}}"
                        break;
                    case boxForTheButtonsInOutilsWeb[2]:
                        textForTheButtonsInOutilsWeb.innerHTML = "{{__("Le disque ISCSI fonctionne et se comporte de la même manière qu’un disque local : le but de l’ISCSI est d’avoir un ou plusieurs disques durs sur son ordinateur ou son serveur et d’avoir l’illusion qu’ils sont physiquement connectés sur la carte-mère. En réalité ce sont des disques virtuels hébergés dans une infrastructure redondante, sécurisée et performante. Cela permet de pallier différentes pannes matérielles que peuvent subir une machine ou un disque dur.")}}"
                        break;
                    case boxForTheButtonsInOutilsWeb[3]:
                        textForTheButtonsInOutilsWeb.innerHTML = "{{__("Le SFTP est un protocole de communication fonctionnant au-dessus de SSH pour transférer et gérer des fichiers à distance. Avec le SFTP vous pouvez uploader et downloader vos fichiers, dossiers et reprendre les transferts après interruption ou déconnexion (resume). Vous pouvez également écraser des fichiers sans changer de clé de téléchargement. Connexion chiffrée et sécurisée.")}}"
                        break;
                    case boxForTheButtonsInOutilsWeb[4]:
                        textForTheButtonsInOutilsWeb.innerHTML = "{{__("L’option CIFS est un protocole TCP/IP réseau qui permet de partager des ressources et l’accès aux fichiers à distance en utilisant des millions d’ordinateurs à la fois. Les utilisateurs avec différentes plates-formes et les ordinateurs peuvent partager des fichiers sans avoir à installer de nouveaux logiciels. Avec le CIFS, les modifications apportées à un fichier sont simultanément enregistrées à la fois sur le client et côté serveur.")}}"
                        break;
                    case boxForTheButtonsInOutilsWeb[5]:
                        textForTheButtonsInOutilsWeb.innerHTML = "{{__("WebDAV est un protocole de longue date qui permet à un serveur Web d’agir comme un serveur de fichiers et de prendre en charge la création collaborative de contenu sur le Web. Bien qu’étant supplanté par des mécanismes plus modernes, il reste un outil de travail fiable rencontré dans de nombreux serveurs, clients et applications différentes.")}}"
                        break;
                    case boxForTheButtonsInOutilsWeb[6]:
                        textForTheButtonsInOutilsWeb.innerHTML = "{{__("Synchronise et transfert uniquement les nouveaux fichiers ou les fichiers modifiés. Rsync permet surtout d’uploader des morceaux de fichiers. C’est à dire, que si vous travaillez sur un fichier de 300 Mo mais que vous n’en changez que la fin, rsync effectuera le calcul pour envoyer que la différence. C’est donc beaucoup beaucoup plus rapide que le SFTP qui ira transférer le fichier entièrement.")}}"
                        break;
                    default:
                        textForTheButtonsInOutilsWeb.innerHTML = "{{__("Le FTP/FTPS est un protocole de communication fonctionnant au-dessus de SSH pour transférer et gérer des fichiers à distance. Avec le FTP/FTPS vous pouvez uploader et downloader vos fichiers, dossiers et reprendre les transferts après interruption ou déconnexion (resume). Vous pouvez également écraser des fichiers sans changer de clé de téléchargement. Connexion chiffrée et sécurisée.")}}"
                    break;
                }
            })
        });
    </script>
@endpush
