@extends('layouts.app')
@section('content')
<div class="container-sm overflow-hidden p-0">
    <div class="row mx-2 mx-sm-0 g-2 text-center m-3">
        <div class="alert alert-primary fs-3 fw-bolder" role="alert">
            <span>Mes commandes</span>
        </div>
    </div>
    @foreach (App\Models\Order::getAllCreateadAtDesc() as $order)
        @php
            $orderAddress = App\Models\OrderAddress::find($order->id);
        @endphp
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header customCardHeader">
                        <span>{{__("Commande")}} #: {{ $order->id }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex flex-column">
                                <div class="d-flex flex-column mb-2">
                                    <span class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">{{__("Information d'achat")}}</span>
                                    <span><span class="fw-bolder">{{__("E-Mail Address")}}:</span> {{ Auth::user()->email }}</span>
                                    <span><span class="fw-bolder">{{__("Adresse de facturation")}}:</span> {{ $orderAddress->identifier }} {{ $orderAddress->address }} {{ $orderAddress->address_complement }} {{ $orderAddress->postal_code }} {{ $orderAddress->city }} {{ $orderAddress->state }} {{ $orderAddress->country }}</span>
                                    @if ($orderAddress->phone_number !== null)
                                        <span><span class="fw-bolder">{{__("Numéro de téléphone")}}:</span> {{ $orderAddress->phone_number }}</span>
                                    @endif
                                </div>
                                <div class="d-flex flex-column mb-2">
                                    <span class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">{{__("Résumé de la commande")}}</span>
                                    <span><span class="fw-bolder">Date:</span> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y à H:i:s') }}</span>
                                    <span><span class="fw-bolder">{{__("Type d'abonnement")}}:</span> {{ $order->mode }}</span>
                                    <span><span class="fw-bolder">{{__("Mode de paiement")}}:</span>{{ $order->payment_mode == 'paypal' ? $order->payment_mode : ($order->payment_mode == 'stripe' ? 'carte bancaire' : 'Aucun') }}</span>
                                    <span><span class="fw-bolder">{{__("Sous-total des produits")}}:</span> {{ $order->includes_adhesion ? ($order->total_paid - 14) : $order->total_paid }}€</span>
                                    <span><span class="fw-bolder">{{__("Montant total de cette commande")}}:</span> {{ $order->total_paid }}€</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-column mb-2">
                                        <span class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">{{__("Contenu de la commande")}}</span>
                                        <span><span class="fw-bolder">{{__("Espace disque")}}:</span> {{ $order->diskspace }} Go</span>
                                        <span><span class="fw-bolder">{{__("Niveau")}}:</span> {{ App\Models\Formula::find($order->formula_id)->name }}</span>
                                        <span><span class="fw-bolder">{{__("Nom de l'accès")}}:</span> {{ $order->access_name }}</span>
                                    </div>
                                    @foreach (App\Models\MemberAccess::where('order_id', $order->id)->get() as $memberAccess)
                                        <div class="d-flex flex-column mb-1">
                                            <span><span class="fw-bolder">Application:</span> {{ $memberAccess->member_access }}</span>
                                            <span><span class="fw-bolder">{{__("Adresse email associée")}}:</span> {{ $memberAccess->email }}</span>
                                            @if ($memberAccess->domain !== '')
                                                <span><span class="fw-bolder">{{__("Domaine")}}:</span> {{ $memberAccess->domain }}</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <form action="{{ route('order.download-facture') }}" method="POST">
                            @csrf
                            <input type="hidden" name="orderId" value="{{ $order->id }}">
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            <a target="_blank"><button type="submit" class="btn btn-secondary">{{__("Télécharger le PDF")}}</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection


