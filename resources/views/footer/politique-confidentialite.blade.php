@extends('layouts.app')
@section('content')
<div class="container-sm overflow-hidden p-0">
    <div class="row mx-2 mx-sm-0 g-2 text-center m-3">
        <div class="alert alert-primary fs-3 fw-bolder" role="alert">
            <span>{{strtoupper(__("Politique de confidentialité"))}}</span>
        </div>
    </div>
    <div class="row mx-2 mx-sm-0">
        <h4>1- {{__("Nature des données collectées")}}</h4>
        <p><strong>{{__("Dans le cadre de l’utilisation des services, DediKam est susceptible de collecter les catégories de données suivantes concernant ses Utilisateurs")}} :</strong><br>
            {{__("Données d’état-civil, d’identité, et d’identification")}}.<br>
            {{__("Données de connexion (adresses IP, journaux d’événements)")}}
        </p>
        <h4>2- {{__("Communication des données personnelles à des tiers")}}</h4>
        <p><strong>{{__("Pas de communication à des tiers")}} :</strong><br>
            {{__("Vos données ne font l’objet d’aucune communication à des tiers. Vous êtes toutefois informés qu’elles pourront être divulguées en application d’une loi, d’un règlement ou en vertu d’une décision d’une autorité réglementaire ou judiciaire compétente")}}.
        </p>
        <h4>3- {{__("Information préalable pour la communication des données personnelles à des tiers en cas de fusion / absorption")}}</h4>
        <p>
            <strong>{{__("Information préalable et possibilité d’opt-out avant et après la fusion / acquisition")}} :</strong><br>
            {{__("Dans le cas où nous prendrions part à une opération de fusion, d’acquisition ou à toute autre forme de cession d’actifs, nous nous engageons à garantir la confidentialité de vos données personnelles et à vous informer avant que celles-ci ne soient transférées ou soumises à de nouvelles règles de confidentialité")}}.
        </p>
        <h4>4- {{__("Agrégation des données")}}</h4>
        <p>
            <strong>{{__("Agrégation avec des données non personnelles")}} :</strong><br>
            {{__("Nous pouvons publier, divulguer et utiliser les informations agrégées (informations relatives à tous nos utilisateurs ou à des groupes ou catégories spécifiques d’Utilisateurs que nous combinons de manière à ce qu’un utilisateur individuel ne puisse plus être identifié ou mentionné) et les informations non personnelles à des fins d’analyse du secteur et du marché, de profilage démographique, à des fins promotionnelles et publicitaires et à d’autres fins commerciales")}}.<br>
            <strong>{{__("Agrégation avec des données personnelles disponibles sur les comptes sociaux de l’Utilisateur")}} :</strong><br>
            {{__("Si vous connectez votre compte à un compte d’un autre service afin de faire des envois croisés, le dit service pourra nous communiquer vos informations de profil, de connexion, ainsi que toute autre information dont vous avez autorisé la divulgation. Nous pouvons agréger les informations relatives à tous nos autres Utilisateurs, groupes, comptes, aux données personnelles disponibles sur l’Utilisateur")}}.
        </p>
        <h4>5- {{__("Collecte des données d'identité")}}</h4>
        <p>
            <strong>{{__("Inscription et identification préalable pour la fourniture du service")}} :</strong><br>
            {{__("L’utilisation du Site nécessite une inscription et une identification préalable. Vos données nominatives (nom, prénom, adresse postale, e-mail, numéro de téléphone,…) sont utilisées pour exécuter nos obligations légales résultant de la livraison des produits et / ou des services, en vertu du Contrat de licence utilisateur final, de la limite de garantie, le cas échéant, ou de toute autre condition applicable. Vous ne fournirez pas de fausses informations nominatives et ne créerez pas de compte pour une autre personne sans son autorisation. Vos coordonnées devront toujours être exactes et à jour")}}.
        </p>
        <h4>6- {{__("Collecte des données d'identification")}}</h4>
        <p>
            <strong>{{__("Utilisation de l’identifiant de l’utilisateur uniquement pour l’accès aux services")}} :</strong><br>
            {{__("Nous utilisons vos identifiants électroniques seulement pour et pendant l’exécution du contrat")}}.
        </p>
        <h4>7- {{__("Collecte des données du terminal")}}</h4>
        <p>
            <strong>{{__("Collecte des données de profilage et des données techniques à des fins de fourniture du service")}} :</strong><br>
            {{__("Certaines des données techniques de votre appareil sont collectées automatiquement par le Site")}}.<br>
            {{__("Ces informations incluent notamment votre adresse IP, fournisseur d’accès à Internet, configuration matérielle, configuration logicielle, type et langue du navigateur… La collecte de ces données est nécessaire à la fourniture des services")}}.<br>
            <strong>{{__("Collecte des données techniques à des fins publicitaires, commerciales et statistiques")}} :</strong><br>
            {{__("Les données techniques de votre appareil sont automatiquement collectées et enregistrées par le site, à des fins publicitaires, commerciales et statistiques. Ces informations nous aident à personnaliser et à améliorer continuellement votre expérience sur notre Site. Nous ne collectons ni ne conservons aucune donnée nominative (nom, prénom, adresse…) éventuellement attachée à une donnée technique. Les données collectées sont susceptibles d’être revendues à des tiers")}}.
        </p>
        <h4>8- {{__("Cookies")}}</h4>
        <p>
            <strong>{{__("Durée de conservation des cookies")}} :</strong><br>
            {{__("Conformément aux recommandations de la CNIL, la durée maximale de conservation des cookies est de 13 mois au maximum après leur premier dépôt dans le terminal de l’Utilisateur, tout comme la durée de la validité du consentement de l’Utilisateur à l’utilisation de ces cookies. La durée de vie des cookies n’est pas prolongée à chaque visite. Le consentement de l’Utilisateur devra donc être renouvelé à l’issue de ce délai")}}.<br>
            <strong>{{__("Finalité cookies")}}:</strong> <br>
            {{__("Les cookies peuvent être utilisés pour des fins statistiques notamment pour optimiser les services rendus à l’utilisateur, à partir du traitement des informations concernant la fréquence d’accès, la personnalisation des pages ainsi que les opérations réalisées et les informations consultées. Vous êtes informé que DediKam est susceptible de déposer des cookies sur votre terminal. Le cookie enregistre des informations relatives à la navigation sur le service (les pages que vous avez consultées, la date et l’heure de la consultation…) que nous pourrons lire lors de vos visites ultérieures")}}.<br>
            <strong>{{__("Droit de l’Utilisateur de refuser les cookies, la désactivation entraînant un fonctionnement dégradé du service")}}:</strong> <br>
            {{__("Vous reconnaissez avoir été informé que DediKam peut avoir recours à des cookies, et l’y autorisez")}}.<br>
            {{__("Si vous ne souhaitez pas que des cookies soient utilisés sur votre terminal, la plupart des navigateurs vous permettent de désactiver les cookies en passant par les options de réglage")}}.<br>
            {{__("Toutefois, vous êtes informé que certains services sont susceptibles de ne plus fonctionner correctement")}}.<br>
            {{__("Association possible des cookies avec des données personnelles pour permettre le fonctionnement du service")}}.<br>
            {{__("DediKam peut être amenée à recueillir des informations de navigation via l’utilisation de cookies")}}.
        </p>
        <h4>9 - {{__("Conservation des données techniques")}}</h4>
        <p>
            <strong>{{__("Durée de conservation des données techniques")}}: </strong><br>
            {{__("Les données techniques sont conservées pour la durée strictement nécessaire à la réalisation des finalités visées ci-avant")}}.
        </p>
        <h4>10- {{__("Délai de conservation des données personnelles et d'anonymisation")}}</h4>
        <p>
            <strong>{{__("Conservation des données pendant la durée de la relation contractuelle")}} :</strong><br>
            {{__("Conformément à l’article 6-5° de la loi n°78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, les données à caractère personnel faisant l’objet d’un traitement ne sont pas conservées au-delà du temps nécessaire à l’exécution des obligations définies lors de la conclusion du contrat ou de la durée prédéfinie de la relation contractuelle")}}.<br>
            <strong>{{__("Conservation des données anonymisées au delà de la relation contractuelle / après la suppression du compte")}} :</strong><br>
            {{__("Nous conservons les données personnelles pour la durée strictement nécessaire à la réalisation des finalités décrites dans les présentes Politiques de confidentialité")}}.<br>
            {{__("Au-delà de cette durée, elles seront anonymisées et conservées à des fins exclusivement statistiques et ne donneront lieu à aucune exploitation, de quelque nature que ce soit")}}.<br>
            <strong>{{__("Suppression des données après suppression du compte")}} :</strong><br>
            {{__("Des moyens de purge de données sont mis en place afin d’en prévoir la suppression effective dès lors que la durée de conservation ou d’archivage nécessaire à l’accomplissement des finalités déterminées ou imposées est atteinte. Conformément à la loi n°78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, vous disposez par ailleurs d’un droit de suppression sur vos données que vous pouvez exercer à tout moment en prenant contact avec DediKam")}}.<br>
            <strong>{{__("Suppression des données après 3 ans d’inactivité")}} :</strong><br>
            {{__("Pour des raisons de sécurité, si vous ne vous êtes pas authentifié sur le Site pendant une période de trois ans, vous recevrez un e-mail vous invitant à vous connecter dans les plus brefs délais, sans quoi vos données seront supprimées de nos bases de données")}}.
        </p>
        <h4>11- {{__("Suppression du compte")}}</h4>
        <p>
            <strong>{{__("Suppression du compte à la demande")}} :</strong><br>
            {{__("L’Utilisateur a la possibilité de supprimer son Compte à tout moment, par simple demande à DediKam OU par le menu de suppression de Compte présent dans les paramètres du Compte le cas échéant")}}.<br>
            <strong>{{__("Suppression du compte en cas de violation de la Politique de Confidentialité")}} :</strong><br>
            {{__("En cas de violation d’une ou de plusieurs dispositions de la Politique de Confidentialité ou de tout autre document incorporé aux présentes par référence, DediKam se réserve le droit de mettre fin ou restreindre sans aucun avertissement préalable et à sa seule discrétion, votre usage et accès aux services, à votre compte et à tous les services")}}.
        </p>
        <h4>12- {{__("Indications en cas de faille de sécurité décelée par DediKam")}}</h4>
        <p>
            <strong>{{__("Information de l’Utilisateur en cas de faille de sécurité")}} :</strong><br>
            {{__("Nous nous engageons à mettre en oeuvre toutes les mesures techniques et organisationnelles appropriées afin de garantir un niveau de sécurité adapté au regard des risques d’accès accidentels, non autorisés ou illégaux, de divulgation, d’altération, de perte ou encore de destruction des données personnelles vous concernant")}}.<br>
            {{__("Dans l’éventualité où nous prendrions connaissance d’un accès illégal aux données personnelles vous concernant stockées sur nos serveurs ou ceux de nos prestataires, ou d’un accès non autorisé ayant pour conséquence la réalisation des risques identifiés ci-dessus, nous nous engageons à")}} :<br>
            {{__("Vous notifier l’incident dans les plus brefs délais")}}<br>
            {{__("Examiner les causes de l’incident et vous en informer")}}<br>
            {{__("Prendre les mesures nécessaires dans la limite du raisonnable afin d’amoindrir les effets négatifs et préjudices pouvant résulter dudit incident")}}.<br>
            <strong>{{__("Limitation de la responsabilité")}} :</strong><br>
            {{__("En aucun cas les engagements définis au point ci-dessus relatifs à la notification en cas de faille de sécurité ne peuvent être assimilés à une quelconque reconnaissance de faute ou de responsabilité quant à la survenance de l’incident en question")}}.
        </p>
        <h4>13- {{__("Transfert des données personnelles à l'étranger")}}</h4>
        <p>
            <strong>{{__("Pas de transfert en dehors de l’Union européenne")}} :</strong><br>
            {{__("DediKam s’engage à ne pas transférer les données personnelles de ses Utilisateurs en dehors de l’Union européenne")}}.
        </p>
        <h4>14- {{__("Modification de la politique de confidentialité")}}</h4>
        <p>
            {{__("En cas de modification de la présente Politique de Confidentialité, engagement de ne pas baisser le niveau de confidentialité de manière substantielle sans l’information préalable des personnes concernées")}}.<br>
            {{__("Nous nous engageons à vous informer en cas de modification substantielle de la présente Politique de Confidentialité, et à ne pas baisser le niveau de confidentialité de vos données de manière substantielle sans vous en informer et obtenir votre consentement")}}.
        </p>
        <h4>15- {{__("Droit applicable et modalités de recours")}}</h4>
        <p>
            <strong>{{__("Application du droit français (législation CNIL) et compétence des tribunaux")}} :</strong><br>
            {{__("La présente Politique de Confidentialité et votre utilisation du Site sont régies et interprétées conformément aux lois de France, et notamment à la Loi n° 78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés. Le choix de la loi applicable ne porte pas atteinte à vos droits en tant que consommateur conformément à la loi applicable de votre lieu de résidence")}}.<br>
            {{__("Si vous êtes un consommateur, vous et nous acceptons de se soumettre à la compétence non-exclusive des juridictions françaises, ce qui signifie que vous pouvez engager une action relative à la présente Politique de Confidentialité en France ou dans le pays de l’UE dans lequel vous vivez")}}.<br>
            {{__("Si vous êtes un professionnel, toutes les actions à notre encontre doivent être engagées devant une juridiction en France")}}.<br>
            {{__("En cas de litige, les parties chercheront une solution amiable avant toute action judiciaire. En cas d’échec de ces tentatives, toutes contestations à la validité, l’interprétation et / ou l’exécution de la Politique de Confidentialité devront être portées même en cas de pluralité des défendeurs ou d’appel en garantie, devant les tribunaux français")}}.
        </p>
        <h4>16- {{__("Portabilité des données")}}</h4>
        <p>
            <strong>{{__("Portabilité des données")}} :</strong><br>
            {{__("DediKam s’engage à vous offrir la possibilité de vous faire restituer l’ensemble des données vous concernant sur simple demande. L’Utilisateur se voit ainsi garantir une meilleure maîtrise de ses données, et garde la possibilité de les réutiliser. Ces données devront être fournies dans un format ouvert et aisément réutilisable")}}.
        </p>
    </div>
@endsection

        
        


