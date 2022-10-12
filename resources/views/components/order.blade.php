@php
    $order = App\Models\Order::find($orderId);
    $orderAddress = App\Models\OrderAddress::find($order->id);
    $user = App\Models\User::find($order->user_id);
@endphp
<style>
    .card-header:first-child {
  border-radius: var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius) 0 0;
    }
    .card-header {
    padding: var(--bs-card-cap-padding-y) var(--bs-card-cap-padding-x);
    margin-bottom: 0;
    color: var(--bs-card-cap-color);
    background-color: var(--bs-card-cap-bg);
    border-bottom: var(--bs-card-border-width) solid var(--bs-card-border-color);
    }
    .customCardHeader {
    color: #984c13 !important;
    background-color: #ffe5d2 !important;
    border-color: #ffd8bc !important;
    font-weight: bold;
    padding: 16px !important;
    }
    *, ::before, ::after {
    box-sizing: border-box;
    }
    * {
    margin: 0;
        margin-bottom: 0px;
    padding: 0;
    }
    .bold{
        font-weight: 500;
    }
    .d-flex{
        display: flex;
    }
    .flex-column{
        flex-direction: column;
    }
    .mb-2 {
        margin-bottom: 8px;
    }
    .mb-1 {
        margin-bottom: 4px;
    }
    .w-100{
        width: 100%;
    }
    .fs-5 {
        font-size: 1.5rem;
    }
    .ps-2, p{
        padding-left: 8px;
    }
    .text-white{
        color: white;
    }
</style>
<div class="row">
    <div class="col">
        <div class="card mb-4">
            <div class="card-header customCardHeader">
                <span>Commande #: {{ $order->id }}</span>
            </div>
            <div style="display: flex; flex-direction: column">
                <div class="d-flex flex-column mb-2">
                    <p class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">Information d'achat</p>
                    <p><span class="bold">Adresse de courriel:</span> {{ $user->email }}</p>
                    <p><span class="bold bold">Adresse de facturation:</span> {{ $orderAddress->identifier }} {{ $orderAddress->address }} {{ $orderAddress->address_complement }} {{ $orderAddress->postal_code }} {{ $orderAddress->city }} {{ $orderAddress->state }} {{ $orderAddress->country }}</p>
                    @if ($orderAddress->phone_number !== null)
                        <p><span class="bold">Téléphone:</span> {{ $orderAddress->phone_number }}</p>
                    @endif
                </div>
                <div class="d-flex flex-column mb-2">
                    <p class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">Résumé de la commande</p>
                    <p><span class="bold">Date:</span> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y à H:i:s') }}</p>
                    <p><span class="bold">Type d'abonnement:</span> {{ $order->mode }}</p>
                    <p><span class="bold">Mode de paiement:</span> {{ $order->payment_mode }} (carte bleue)</p>
                    <p><span class="bold">Sous-total des produits:</span> {{ $order->includes_adhesion ? ($order->total_paid - 14) : $order->total_paid }}€</p>
                    <p><span class="bold">Montant total de cette commande:</span> {{ $order->total_paid }}€</p>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-column mb-2">
                        <p class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">Contenu de la commande</p>
                        <p><span class="bold">Espace disque:</span> {{ $order->diskspace }} Go</p>
                        <p><span class="bold">Niveau:</span> {{ App\Models\Formula::find($order->formula_id)->name }}</p>
                        <p><span class="bold">Nom de l'accès:</span> {{ $order->access_name }}</p>
                    </div>
                    @foreach (App\Models\MemberAccess::where('order_id', $order->id)->get() as $memberAccess)
                        <div class="d-flex flex-column mb-1">
                            <p><span class="bold">Application:</span> {{ $memberAccess->member_access }}</p>
                            <p><span class="bold">Email:</span> {{ $memberAccess->email }}</p>
                            @if ($memberAccess->domain !== '')
                                <p><span class="bold">Domaine:</span> {{ $memberAccess->domain }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
