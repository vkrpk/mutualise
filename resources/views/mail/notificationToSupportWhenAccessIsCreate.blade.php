Un accès a été créé le {{ \Carbon\Carbon::parse($created_at)->format('d/m/Y à H:i:s') }}.<br><br>

Application: {{ $member_access }}<br>
Email: {{ $email }}<br>
Nom: {{ $name }}<br>
Espace disque: {{ $diskspace }} Go<br>
Numéro de commande: {{ $order_id }}<br>
@if ($domain !== '')
    Domaine: {{ $domain }}
@endif


