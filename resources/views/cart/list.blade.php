{{-- @extends('layouts.frontend') --}}
@extends('layouts.app')


@section('content')
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="" >
        <input type="number" name="quantity" value="" class="w-6 text-center bg-gray-300" />
        <button type="submit" class="px-2 pb-2 ml-2 text-white bg-blue-500">update</button>
    </form>
    <form action="{{ route('cart.remove') }}" method="POST">
        @csrf
        <input type="hidden" value="" name="id">
        <button class="px-4 py-2 text-white bg-red-600">x</button>
    </form>
    {{-- {{ dd(Cart::getContent()) }} --}}
    @foreach (Cart::getContent() as $item)
        <p>{{ $item->price }}</p>
    @endforeach
    Total: ${{ Cart::getTotal() }}
    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        <button class="px-6 py-2 text-red-800 bg-red-300">Remove All Cart</button>
    </form>

        <div class="container-sm overflow-hidden">
            <div class="row text-center">
                <div class="alert alert-primary fs-3 fw-bolder" role="alert">
                    <span>Panier</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 px-sm-0 ">
                    <div class="card mb-2">
                        <div class="alert alert-secondary" role="alert"><span><strong>Proposition 1 : paiement à l'année</strong></span></div>
                        <div class="card-body">
                            <div class="row border-bottom py-2">
                                <div class="col col-2"><span></span></div>
                                <div class="col col-7 p-1"><span class="text-primary fw-bolder">Adhésion obligatoire à l'association</span></div>
                                <div class="col text-end col-3 p-1"><span>14,00 €</span></div>
                            </div>
                            <div class="row border-bottom py-2">
                                <div class="col text-center d-flex justify-content-evenly align-self-center col-2"><span><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-trash fs-2 text-danger">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                        </svg></span><span><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-cloud-plus-fill fs-2 text-primary">
                                            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm.5 4v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0z"></path>
                                        </svg></span></div>
                                <div class="col col-7">
                                    <div class="row">
                                        <div class="col text-primary ps-1"><span class="fw-bolder">Accès Dedikam</span></div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col ps-1 pe-0 col-12 col-sm-6 col-md-5 col-lg-3"><span class="fst-italic"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle pe-1 text-secondary">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                                                </svg>Formule choisie :</span></div>
                                        <div class="col text-start align-self-center px-1"><span>ENTREPRISE</span></div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col align-self-center ps-1 pe-0 col-12 col-md-5 col-lg-3"><span class="fst-italic"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle pe-1 text-secondary">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                                                </svg>Alias du compte :</span></div>
                                        <div class="col text-start align-self-center ps-1"><span>un alias très très log xxxxxxxxxxxxxx dfdf</span></div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col ps-1 pe-0 col-12 col-sm-6 col-md-5 col-lg-3"><span class="fst-italic"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle pe-1 text-secondary">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                                                </svg>Espace disque :</span></div>
                                        <div class="col text-start align-self-center px-1"><span>1 890 Go</span></div>
                                    </div>
                                </div>
                                <div class="col text-end col-3 p-1"><span><br>936.08 €<br></span></div>
                            </div>
                            <div class="row border-bottom py-2">
                                <div class="col text-center align-self-center col-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-trash fs-2 text-danger">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                    </svg></div>
                                <div class="col col-7 p-1">
                                    <div class="row">
                                        <div class="col"><span class="text-primary fw-bolder">Coupon de déduction</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><span>xxx--dfgdfs--zz444</span></div>
                                    </div>
                                </div>
                                <div class="col text-end col-3 p-1"><span>- 20,00 €</span></div>
                            </div>
                            <div class="row justify-content-end pt-3">
                                <div class="col text-end align-self-center p-1 col-auto"><span class="fw-bolder pe-3">Total :</span><span class="fw-bolder">902.08 €</span></div>
                            </div>
                            <div class="row pt-3">
                                <div class="col text-end align-self-center p-1"><a class="btn btn-lg btn-primary fs-5 p-2 ms-2" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-cart-check-fill me-2">
                                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                                        </svg>Terminer ma commande</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="alert alert-secondary" role="alert"><span><strong>Proposition 2 : abonnement mensuel</strong></span></div>
                        <div class="card-body">
                            <div class="row border-bottom py-2">
                                <div class="col col-2"><span></span></div>
                                <div class="col col-7 p-1"><span class="text-primary fw-bolder">Adhésion obligatoire à l'association</span></div>
                                <div class="col text-end col-3 p-1"><span>14,00 €</span></div>
                            </div>
                            <div class="row border-bottom py-2">
                                <div class="col text-center d-flex justify-content-evenly align-self-center col-2"><span><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-trash fs-2 text-danger">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                        </svg></span><span><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-cloud-plus-fill fs-2 text-primary">
                                            <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm.5 4v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 1 0z"></path>
                                        </svg></span></div>
                                <div class="col col-7">
                                    <div class="row">
                                        <div class="col text-primary ps-1"><span class="fw-bolder">Accès Dedikam</span></div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col ps-1 pe-0 col-12 col-sm-6 col-md-5 col-lg-3"><span class="fst-italic"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle pe-1 text-secondary">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                                                </svg>Formule choisie :</span></div>
                                        <div class="col text-start align-self-center px-1"><span>ENTREPRISE</span></div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col align-self-center ps-1 pe-0 col-12 col-md-5 col-lg-3"><span class="fst-italic"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle pe-1 text-secondary">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                                                </svg>Alias du compte :</span></div>
                                        <div class="col text-start align-self-center ps-1"><span>un alias très très log xxxxxxxxxxxxxx dfdf</span></div>
                                    </div>
                                    <div class="row my-1">
                                        <div class="col ps-1 pe-0 col-12 col-sm-6 col-md-5 col-lg-3"><span class="fst-italic"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right-circle pe-1 text-secondary">
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"></path>
                                                </svg>Espace disque :</span></div>
                                        <div class="col text-start align-self-center px-1"><span>1 890 Go</span></div>
                                    </div>
                                </div>
                                <div class="col text-end col-3 p-1"><span><br>92.96 €<br></span></div>
                            </div>
                            <div class="row border-bottom py-2">
                                <div class="col text-center align-self-center col-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-trash fs-2 text-danger">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                                    </svg></div>
                                <div class="col col-7 p-1">
                                    <div class="row">
                                        <div class="col"><span class="text-primary fw-bolder">Coupon de déduction</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><span>xxx--dfgdfs--zz444</span></div>
                                    </div>
                                </div>
                                <div class="col text-end col-3 p-1"><span>- 20,00 €</span></div>
                            </div>
                            <div class="row justify-content-end pt-3">
                                <div class="col text-end align-self-center px-1 col-auto">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody class="border-0">
                                                <tr>
                                                    <td class="border-0 p-1"><span class="fw-bolder pe-3">Premier mois :</span></td>
                                                    <td class="border-0 p-1"><span class="fw-bolder">106.96€</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-0 p-1"><span class="fw-bolder pe-3">Abonnement mensuel :</span></td>
                                                    <td class="border-0 p-1"><span class="fw-bolder">92.96 €</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col text-end align-self-center p-1"><a class="btn btn-lg btn-primary fs-5 p-2 ms-2" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-cart-check-fill me-2">
                                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"></path>
                                        </svg>Terminer ma commande</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col col-12 mb-2"><label class="col-form-label fs-4" for="form_code_coupon">Coupon de réduction :</label></div>
                                    <div class="col col-auto mb-2"><input class="form-control" type="text" id="form_code_coupon" style="width: 15rem;"><span class="form-text">Saisissez un code de réduction et cliquez sur «Appliquer à la commande» ci-dessous.</span></div>
                                    <div class="col col-12"><button class="btn btn-secondary p-2 fs-5" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-cash pe-1">
                                                <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                                                <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"></path>
                                            </svg>Appliquer à la commande</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
