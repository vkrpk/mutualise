@extends('layouts.app')

@section('content')
<div class="d-flex flex-column" style="position: relative;background: url('{{ Vite::asset("resources/images/service-sauvegarde-stockage-owncloud.jpeg") }}') center / cover no-repeat, rgba(20,30,40,0);display: flex;opacity: 1;min-height: 200px;color: var(--bs-light);text-align: center;padding: 0;line-height: 100%;margin-top: 0;margin-right: auto;margin-left: auto;z-index: 2;">
    <div class="d-flex flex-column justify-content-around" style="max-width: 700px;margin-left: auto;margin-right: auto;padding-bottom: 40px;display: flex;">
        <h1 style="text-align: center;font-weight: bold;padding-right: 30px;padding-left: 30px;margin-top: 30px;">SAUVEGARDE ET PARTAGE DE DONNÉES EN LIGNE<br></h1>
        <h4 class="text-center" style="--bs-body-font-weight: normal;margin-bottom: 20px;--bs-body-bg: #590cd7;"><br> PLATEFORME COLLABORATIVE - ESPACE DE TRAVAIL NUMERIQUE<br><br></h4>
        <div class="container">
            <div class="row" style="background: url('{{ Vite::asset("resources/images/Data-Center.jpg") }}');">
                <div class="col-md-6" style="height: 120px;">
                    <h5 style="margin-top: 15px;">Services mutualisés<br></h5><button class="btn btn-primary" type="button" style="background: var(--bs-secondary);color: rgb(255,255,255);border-style: none;border-right-style: none;margin: 10px 0;font-weight: bold;">DECOUVRIR</button>
                </div>
                <div class="col-md-6" style="height: 120px;">
                    <h5 style="margin-top: 15px;">Services dédiés<br></h5><button class="btn btn-primary" type="button" style="background: var(--bs-secondary);color: rgb(255,255,255);border-style: none;border-right-style: none;margin: 10px 0;font-weight: bold;">DECOUVRIR</button>
                </div>
            </div>
        </div>
        <h4 class="text-center" style="letter-spacing: 0px;width: auto;height: auto;margin-top: 30px;margin-bottom: 30px;">DediKam est une association, indépendante sans publicité, totalement transparente et non lucrative. Nous offrons divers outils collaboratifs pour tout type d’utilisateurs, du particulier au professionnel<br></h4>
        <h4 class="text-uppercase text-center" data-bss-hover-animate="pulse" style="height: auto;display: inline-block;text-align: center;line-height: 2px;color: var(--bs-secondary);font-weight: bold;text-decoration: underline;letter-spacing: 2px;margin-top: 15px;margin-bottom: 15px;"><br><a href="https://www.dedikam.com/qui-sommes-nous/"> </a><br> <br> <br> <br>Qui sommes nous ?<br></h4>
        <div id="content" style="position: absolute;background: #141e28;display: block;opacity: 0.58;max-height: 600px;min-height: 200px;color: var(--bs-light);top: 0;z-index: -1;height: 100%;width: 100%;max-width: 900px;"></div>
    </div>
</div>
<div style="/*background: var(--bs-secondary);*/text-align: center;position: relative;padding-bottom: 40px;height: auto;background-image: linear-gradient(180deg, #fe7e20 0%, #74ba58 100%);--bs-primary: #74ba58;--bs-primary-rgb: 116,186,88;--bs-secondary: #fe7e20;--bs-secondary-rgb: 254,126,32;">
    <div class="container">
        <h1 style="line-height: 22.2px;font-weight: bold;/*fill: #74ba58;*/"><br><br>Nos services mutualisés <br> <br><br></h1>
        <div style="border-bottom-color: var(--bs-primary);height: 5px;background: var(--bs-primary);width: 130px;text-align: center;position: absolute;left: 50%;right: 50%;transform: translateX(-50%);top: 95px;"></div>
        <div>
            <h4 style="font-weight: bold;margin-bottom: 0;line-height: 29.6205px;">Avec le service mutualisé, nous vous proposons des outils collaboratifs <br>et des outils web pour gérer vos données comme bon vous semble<br></h4>
            <p class="fs-6" style="margin: 0px;line-height: 11px;text-align: center;margin-bottom: 40px;"><br>Nous utilisons des outils 100% logiciel libre capable de répondre et de s’adapter aux besoins de nos utilisateurs<br></p>
        </div>
    </div>
    <div class="container d-flex justify-content-center" style="border-radius: 108px;border-bottom-left-radius: 31px;border-bottom-right-radius: 22px;border-right-width: 9px;padding-right: 0;margin: auto;margin-right: auto;margin-left: auto;padding-left: 0;">
        <div class="row gx-5 gy-5 d-flex d-lg-flex d-xl-flex justify-content-evenly flex-md-row align-items-md-start flex-lg-row align-items-lg-center flex-xl-row align-items-xl-center flex-xxl-row align-items-xxl-start" style="border-radius: 10px;border-bottom-right-radius: 37;border-bottom-left-radius: 32px;border-right-width: 22px;border-bottom-width: 0px;margin-bottom: 0;padding-bottom: 0;width: 100%;margin-top: 0;margin-left: 0;margin-right: 0;">
            <div class="col-md-6 col-xl-6" style="border-radius: -9px;border-top-left-radius: 0px;border-bottom-right-radius: 20px;border-bottom-left-radius: 20px;border-width: 6px;border-right-width: 26px;border-right-color: var(--bs-dark);border-bottom-width: 6px;padding-right: 0;padding-left: 0;margin-right: 0;box-shadow: 20px 20px 10px 0px rgba(0,0,0,0.5);max-width: 440px;margin-top: 0;">
                <h4 style="background: var(--bs-primary);line-height: 11.9px;border-radius: 10px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: bold;margin-bottom: 0;height: 71px;border-top-right-radius: 20px;border-top-left-radius: 20px;"><br><br> <br> Outils collaboratifs <br> <br><br></h4>
                <div style="z-index: 10;background-color: white;color: var(--bs-dark);"><img src="{{ Vite::asset('resources/images/nextcloud.png') }}">
                    <h6 style="color: var(--bs-dark);font-weight: bold;font-size: 11.4px;margin-bottom: 0;">NextCloud 24<br></h6>
                    <p style="margin-bottom: 0;padding-bottom: 40px;border-bottom-right-radius: 0px;"><br>Nextcloud est un logiciel libre offrant une plateforme de partage de <br>documents avancés qui vous offre un contrôle total sur vos paramètres de<br> partage de fichiers. Il se présente comme une alternative à Google <br>docs.<br></p>
                </div>
                <div style="z-index: 10;color: var(--bs-dark);border-radius: 10px;border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;border-width: 7px;background: var(--bs-white);border-top-right-radius: 0;border-top-left-radius: 0;"><img src="{{ Vite::asset('resources/images/pydio.png') }}">
                    <h6 style="color: var(--bs-dark);font-weight: bold;font-size: 11.4px;margin-bottom: 0;">Pydio 8</h6>
                    <p style="padding-bottom: 20px;border-radius: 255px;border-bottom-right-radius: 32;border-bottom-left-radius: 25;border-width: 0;border-right-width: 49px;margin: 0;"><br>Pydio est un logiciel libre offrant une plateforme de services de <br>stockage et de partage de fichiers. Il se présente également comme une <br>alternative à Dropbox.<br></p>
                </div>
            </div>
            <div class="col-md-6 flex-column" style="border-radius: -9px;border-top-left-radius: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 20px;border-width: 6px;border-right-width: 26px;border-right-color: var(--bs-dark);border-bottom-width: 6px;display: flex;overflow: hidden;background: rgb(255,255,255);padding-left: 0;padding-right: 0;margin-left: 0;box-shadow: 20px 20px 10px 0px rgba(0,0,0,0.5);max-width: 440px;margin-top: 0;border-top-right-radius: 20px;max-height: 731px;height: 661px;">
                <h4 style="background: var(--bs-primary);line-height: 11.9px;border-radius: 10px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: bold;margin-bottom: 0;height: 71px;width: auto;border: 1px solid var(--bs-secondary);border-top-right-radius: 20px;border-top-left-radius: 20px;"><br><br> <br>Outils web</h4>
                <div class="row d-flex flex-row justify-content-end align-items-end flex-nowrap justify-content-md-end align-items-md-start justify-content-xl-end align-items-xl-center" style="display: flex;margin-left: 0;width: auto;margin-right: 0;">
                    <div class="col-xl-3 d-sm-flex d-md-flex d-lg-flex flex-column justify-content-center align-items-center flex-nowrap justify-content-sm-center justify-content-md-center align-items-lg-center align-items-xl-center" style="height: 100%;background: #ffffff;border-bottom-left-radius: 10px;border-bottom-width: 0px;padding-left: 10px;padding-top: 1px;padding-right: 10px;width: 30%;">
                        <div class="justify-content-center align-items-center" style="height: 55px;background: var(--bs-secondary);margin-top: 13px;margin-bottom: 13px;border-radius: 10px;text-align: center;display: flex;width: 100%;">
                            <p style="line-height: normal;text-align: center;margin-bottom: 0;">FTPS/FTP<br></p>
                        </div>
                        <div class="justify-content-center align-items-center" style="width: 100%;height: 55px;background: var(--bs-secondary);margin-top: 13px;margin-bottom: 13px;border-radius: 10px;text-align: center;display: flex;">
                            <p style="line-height: normal;text-align: center;margin-bottom: 0;">SSH<br></p>
                        </div>
                        <div class="justify-content-center align-items-center" style="width: 100%;height: 55px;background: var(--bs-secondary);margin-top: 13px;margin-bottom: 13px;border-radius: 10px;text-align: center;display: flex;">
                            <p style="line-height: normal;text-align: center;margin-bottom: 0;">ISCSI<br></p>
                        </div>
                        <div class="justify-content-center align-items-center" style="width: 100%;height: 55px;background: var(--bs-secondary);margin-top: 13px;margin-bottom: 13px;border-radius: 10px;text-align: center;display: flex;">
                            <p style="line-height: normal;text-align: center;margin-bottom: 0;">SFTP<br></p>
                        </div>
                        <div class="justify-content-center align-items-center" style="width: 100%;height: 55px;background: var(--bs-secondary);margin-top: 13px;margin-bottom: 13px;border-radius: 10px;text-align: center;display: flex;">
                            <p style="line-height: normal;text-align: center;margin-bottom: 0;">CIFS<br></p>
                        </div>
                        <div class="justify-content-center align-items-center" style="width: 100%;height: 55px;background: var(--bs-secondary);margin-top: 13px;margin-bottom: 13px;border-radius: 10px;text-align: center;display: flex;">
                            <p style="line-height: normal;text-align: center;margin-bottom: 0;">WEBDAV<br></p>
                        </div>
                        <div class="justify-content-center align-items-center" style="width: 100%;height: 55px;background: var(--bs-secondary);margin-top: 13px;margin-bottom: 13px;border-radius: 10px;text-align: center;display: flex;">
                            <p style="line-height: normal;text-align: center;margin-bottom: 0;">RSYNC<br></p>
                        </div>
                    </div>
                    <div class="col-8 col-xl-8 text-start justify-content-start" style="width: 70%;display: block;background: #fcfcfc;height: 100%;border-bottom-right-radius: 10px;padding-right: 0;max-width: 400px;padding-left: 0;">
                        <p class="lead fs-6 text-start" style="text-align: left;display: block;position: relative;height: auto;width: 100%;margin-top: 13px;max-width: 100%;padding-right: 10px;padding-left: 10px;">WebDAV est un protocole de longue date qui permet à un serveur Web d’agir comme un serveur de fichiers ett de prendre en charge la création collaborative de contenu sur le Web. Bien qu’étant supplanté par des mécanismes plus modernes, il reste un outil de travail fiable rencontré dans de nombreux serveurs, clients et applications différentes. <br><br></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-lg-flex" style="background: var(--bs-primary);padding-bottom: 20px;padding-top: 20px;max-height: -1px;">
    <div class="container justify-content-xl-center" style="position: relative;/*background: var(--bs-primary);*/margin-bottom: 40px;padding-left: 0;padding-right: 0;">
        <div class="row d-sm-flex d-lg-flex justify-content-between flex-sm-column justify-content-sm-center align-items-sm-center" id="inscription" style="position: relative;top: 0;background: rgba(0,0,0,0);z-index: 2;border-radius: 20px;border: 2px solid var(--bs-secondary);padding: 20px 40px;left: 50%;right: 50%;transform: translateX(-50%);margin-left: 0;margin-right: 0;max-width: 592px;height: 100%;width: 90%;">
            <div class="col-md-6 flex-column" style="width: auto;color: rgb(253,254,255);border-radius: 20;border-top-left-radius: 20px;">
                <h3 style="text-align: center;">COMMANDEZ OU TESTEZ !</h3>
                <p style="margin-bottom: 0;text-align: center;">Testez nos services mutualisés pendant 30 jours avec<br></p>
                <p data-bss-hover-animate="swing" style="font-weight: bold;text-align: center;">10 Go de stockage gratuit<br></p>
            </div>
            <div class="col-md-6 text-center d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="padding-left: 0;margin-left: auto;margin-right: auto;padding-right: 0;"><button class="btn btn-primary" type="button" style="background: var(--bs-secondary);color: rgb(255,255,255);font-weight: bold;padding-left: 12px;padding-right: 12px;text-align: center;margin-left: auto;margin-right: auto;">INSCRIPTION</button></div>
        </div>
        <div id="calqueInscription" style="height: 100%;color: rgb(0,0,0);width: 90%;background: #000000;opacity: 0.37;left: 50%;right: 50%;transform: translateX(-50%);position: absolute;max-width: 592px;border-radius: 20px;border: 3px solid var(--bs-secondary);border-top-width: 1px;top: 0;"></div>
    </div>
</div>
<div class="container d-flex d-xl-flex flex-column justify-content-xl-center" style="text-align: center;position: relative;background: rgba(246,153,63,0);height: auto;border-radius: 20px;border: 2px solid rgba(23,86,149,0) ;">
    <div class="d-flex flex-column align-items-md-center align-items-lg-center align-items-xl-center" style="position: relative;">
        <h1 style="font-weight: bold;padding-bottom: 75px;margin-top: 40px;">Nos services dédiés</h1>
        <div style="border-bottom-color: var(--bs-primary);height: 5px;background: var(--bs-primary);width: 130px;text-align: center;position: absolute;left: 50%;right: 50%;transform: translateX(-50%);top: 120px;"></div>
        <h4 style="font-weight: bold;margin-bottom: 40px;">Nous vous proposons une solution dédiée NextCloud sur des serveurs de type VPS</h4>
        <div style="position: relative;border: 3px solid var(--bs-primary);border-radius: 20px;box-shadow: 20px 20px 10px 0px rgba(0,0,0,0.5);margin-bottom: 40px;max-width: 500px;padding: 0 40px;margin-right: 10px;width: 90%;margin-left: 10px;">
            <div style="background-color: #141E28;opacity: 0.17;filter: blur(0px) brightness(88%) contrast(0%) hue-rotate(0deg) saturate(107%);height: 100%;width: 100%;position: absolute;top: 0;z-index: 130;border-radius: 20px;border-width: 2px;border-color: rgba(33,37,41,0);border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;padding: 0;right: 50%;left: 50%;transform: translateX(-50%);max-width: 500px;"></div>
            <p style="font-weight: bold;"><br> A la différence du service mutualisé, le service dédié vous apporte un gain de performance significative puisque vous êtes seul sur le serveur.<br></p><strong>1 utilisateur = 1serveur</strong>
            <p><br>Cela permet d'exploiter à 100% les <br>ressources matérielles et vous apporte une totale liberté dans <br>l'administration de votre instance NextCloud.<em>Disponibilité supplémentaire pour vos données entreprises</em><br></p><strong><strong><span style="text-decoration: underline;">Marque blanche et personnalisation</span></strong><br><br></strong>
        </div>
    </div>
    <div style="margin-bottom: 80px;border-radius: 20px;border: 3px solid var(--bs-primary);margin-top: 40px;box-shadow: 20px 20px 10px 0px rgba(0,0,0,0.5);">
        <h3 style="background: #71cf62;margin-bottom: 0;color: rgb(255,255,255);line-height: 80px;font-weight: bold;border-radius: 20px;border-width: 2px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;">SERVICE NEXTCLOUD PRO</h3>
        <h3 style="background: var(--bs-secondary);line-height: 60px;font-weight: bold;margin-bottom: 0;">ESPACE DISQUE JUSQU'A 5 To (5000 Go) Extensible</h3>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;">
            <div class="d-md-flex d-xl-flex flex-row align-items-md-center justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p style="display: inline;line-height: 47.56px;margin-bottom: 0;margin-left: 15px;font-style: italic;font-size: 18px;">Nom de domaine et interface personnalisable</p>
            </div>
            <div style="color: #a4a8ac;height: 5px;width: 80%;background: #a4a8ac;margin-right: auto;margin-left: auto;border-radius: 10px;border-width: 2px;"></div>
        </div>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;">
            <div class="d-xl-flex flex-row justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p class="fs-5" style="display: inline;line-height: normal;margin-bottom: 0;margin-left: 15px;font-style: italic;">Infogérance complète du serveur et de l’instance<br></p>
            </div>
            <div style="color: #a4a8ac;height: 5px;width: 80%;background: #a4a8ac;margin-right: auto;margin-left: auto;border-radius: 10px;border-width: 2px;"></div>
        </div>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;">
            <div class="d-xl-flex flex-row justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p class="fs-5" style="display: inline;line-height: 47.56px;margin-bottom: 0;margin-left: 15px;font-style: italic;">Accès administrateur, nombre d'utilisateurs illimités<br></p>
            </div>
            <div style="color: #a4a8ac;height: 5px;width: 80%;background: #a4a8ac;margin-right: auto;margin-left: auto;border-radius: 10px;border-width: 2px;"></div>
        </div>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;">
            <div class="d-xl-flex flex-row justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p class="fs-5" style="display: inline;line-height: normal;margin-bottom: 0;margin-left: 15px;font-style: italic;">Sauvegarde externalisée des données et réplication sur plusieurs serveurs<br></p>
            </div>
            <div style="color: #a4a8ac;height: 5px;width: 80%;background: #a4a8ac;margin-right: auto;margin-left: auto;border-radius: 10px;border-width: 2px;"></div>
        </div>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;">
            <div class="d-xl-flex flex-row justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p class="fs-5" style="display: inline;line-height: 47.56px;margin-bottom: 0;margin-left: 15px;font-style: italic;">Archivage des données avec une rétention de 10 jours<br></p>
            </div>
            <div style="color: #a4a8ac;height: 5px;width: 80%;background: #a4a8ac;margin-right: auto;margin-left: auto;border-radius: 10px;border-width: 2px;"></div>
        </div>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;">
            <div class="d-xl-flex flex-row justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p class="fs-5" style="display: inline;line-height: normal;margin-bottom: 0;margin-left: 15px;font-style: italic;">Accès aux archives via le protocole FTP/FTPS (emergency connexion)<br></p>
            </div>
            <div style="color: #a4a8ac;height: 5px;width: 80%;background: #a4a8ac;margin-right: auto;margin-left: auto;border-radius: 10px;border-width: 2px;"></div>
        </div>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;">
            <div class="d-xl-flex flex-row justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p class="fs-5" style="display: inline;line-height: 47.56px;margin-bottom: 0;margin-left: 15px;font-style: italic;">Traffic illimité<br></p>
            </div>
            <div style="color: #a4a8ac;height: 5px;width: 80%;background: #a4a8ac;margin-right: auto;margin-left: auto;border-radius: 10px;border-width: 2px;"></div>
        </div>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;">
            <div class="d-xl-flex flex-row justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p class="fs-5" style="display: inline;line-height: 47.56px;margin-bottom: 0;margin-left: 15px;font-style: italic;">Pas d’engagement – possibilité de vous désabonnez à tout moment<br></p>
            </div>
            <div style="color: #a4a8ac;height: 5px;width: 80%;background: #a4a8ac;margin-right: auto;margin-left: auto;border-radius: 10px;border-width: 2px;"></div>
        </div>
        <div class="d-xl-flex flex-column justify-content-xl-center align-items-xl-start" style="display: flex;background: #fffcfc;line-height: 80px;border-bottom-right-radius: 20px;border-bottom-left-radius: 20px;">
            <div class="d-xl-flex flex-row justify-content-xl-center align-items-xl-center paragraphServiceNextcloud" style="display: flex;margin-left: 150px;"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" class="fs-4 text-secondary" style="color: var(--bs-secondary);">
                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                    </svg></span>
                <p class="fs-5" style="display: inline;line-height: 47.56px;margin-bottom: 0;margin-left: 15px;font-style: italic;">Paiement mensuel ou annuel<br></p>
            </div><button class="btn btn-primary btn-lg" type="button" style="background: var(--bs-secondary);color: rgb(255,255,255);margin-left: auto;margin-right: auto;margin-bottom: 40px;margin-top: 10px;">COMMANDER</button>
        </div>
    </div>
</div>
<div class="d-flex d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-center align-items-center justify-content-sm-center align-items-sm-center justify-content-md-center align-items-md-center justify-content-lg-center align-items-lg-center justify-content-xl-center align-items-xl-center" style="position: relative;background: url('{{ Vite::asset("resources/images/service-fichier-owncloud2.jpg") }}') center / cover no-repeat;width: 100%;height: 750px;">
    <div class="d-xl-flex flex-column align-items-xl-center" style="text-align: center;border-radius: 20px;max-width: 816px;/*margin-right: auto;*//*margin-left: auto;*/border: 2px solid var(--bs-secondary);/*margin-bottom: 40px;*/padding: 20px;position: relative;padding-right: 20px;z-index: 2;width: 80%;">
        <h2 id="h3" style="line-height: 69.56px;color: rgb(255,255,255);font-weight: bold;">Déjà 14 années d'expérience dans la sauvegarde en ligne<br></h2>
        <p class="fs-5" style="line-height: 29.04px;color: rgb(255,255,255);padding: 10px 0;">Identifiez vos besoins en matière de sauvegarde ou de partage de données et si besoin, <br>Contactez- nous par mail ou par téléphone pour vous assister et vous proposer la solution la plus adaptée à vos attentes.<br></p><button class="btn btn-primary btn-lg" type="button" style="background: var(--bs-secondary);color: rgb(255,255,255);font-weight: bold;">Demande d'informations</button>
        <div id="calqueNoir" style="background: #f5f5f5;width: 100%;height: 100%;position: absolute;filter: blur(0px) brightness(0%) contrast(121%) hue-rotate(0deg) saturate(100%);background-color: #141E28;opacity: 0.50;z-index: -1;max-width: 816px;top: 50%;bottom: 50%;transform: translateY(-50%);border-radius: 20px;border-width: 0px;border-style: solid;bottom: 0;left: 0;"></div>
    </div>
</div>
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
