@extends('layouts.app')
@section('content')
<div class="container-sm overflow-hidden p-0">
    <div class="row mx-2 mx-sm-0 g-2 text-center m-3">
        <div class="alert alert-primary fs-3 fw-bolder" role="alert">
            <span>{{__("Mes accès")}}</span>
        </div>
    </div>
    <div class="row mx-2 mx-sm-0 g-2 m-3">
        <a href="{{ route('offers') }}" class="mt-0"><button class="btn btn-secondary btn-lg"><i class="fa-solid fa-cloud-arrow-up me-2"></i>{{__("Ajouter un accès")}}</button></a>
    </div>
    @foreach (App\Models\Order::where('user_id', Auth::user()->id)->get() as $order)
        @php
            $orderAddress =  App\Models\OrderAddress::find($order->id);
        @endphp
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header customCardHeader">
                        <span>Commande #: {{ $order->id }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex flex-column">
                                <div class="d-flex flex-column mb-2">
                                    <span class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">Information d'achat</span>
                                    <span><span class="fw-bolder">Adresse de courriel:</span> {{ Auth::user()->email }}</span>
                                    <span><span class="fw-bolder">Adresse de facturation:</span> {{ $orderAddress->identifier }} {{ $orderAddress->address }} {{ $orderAddress->address_complement }} {{ $orderAddress->postal_code }} {{ $orderAddress->city }} {{ $orderAddress->state }} {{ $orderAddress->country }}</span>
                                    @if ($orderAddress->phone_number !== null)
                                        <span><span class="fw-bolder">Téléphone:</span> {{ $orderAddress->phone_number }}</span>
                                    @endif
                                </div>
                                <div class="d-flex flex-column mb-2">
                                    <span class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">Résumé de la commande</span>
                                    <span><span class="fw-bolder">Date:</span> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y à H:i:s') }}</span>
                                    <span><span class="fw-bolder">Type d'abonnement:</span> {{ $order->mode }}</span>
                                    <span><span class="fw-bolder">Mode de paiement:</span> {{ $order->payment_mode }} (carte bleue)</span>
                                    <span><span class="fw-bolder">Sous-total des produits:</span> {{ $order->includes_adhesion ? ($order->total_paid - 14) : $order->total_paid }}€</span>
                                    <span><span class="fw-bolder">Montant total de cette commande:</span> {{ $order->total_paid }}€</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-column mb-2">
                                        <span class="w-100 text-white fs-5 ps-2 rounded-2" style="background: #006699">Contenu de la commande</span>
                                        <span><span class="fw-bolder">Espace disque:</span> {{ $order->diskspace }} Go</span>
                                        <span><span class="fw-bolder">Niveau:</span> {{ App\Models\Formula::find($order->formula_id)->name }}</span>
                                        <span><span class="fw-bolder">Nom de l'accès:</span> {{ $order->access_name }}</span>
                                    </div>
                                    @foreach (App\Models\MemberAccess::where('order_id', $order->id)->get() as $memberAccess)
                                        <div class="d-flex flex-column mb-1">
                                            <span><span class="fw-bolder">Application:</span> {{ $memberAccess->member_access }}</span>
                                            <span><span class="fw-bolder">Email:</span> {{ $memberAccess->email }}</span>
                                            @if ($memberAccess->domain !== '')
                                                <span><span class="fw-bolder">Domaine:</span> {{ $memberAccess->domain }}</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="#"><button class="btn btn-primary">Imprimer la facture</button></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection


