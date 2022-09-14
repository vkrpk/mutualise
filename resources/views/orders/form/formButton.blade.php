<form action="{{ route('cart.store') }}" method="POST" id="formAddToCart" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="form_level" name="form_level" value="{{ $level ?? 'standard' }}">
    <input type="hidden" name="id" value="{{ $id }}">
        <div class="col-3 mb-3">
            <label class="small mb-1" for="accessName">Nom de l'accès<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
            <input class="form-control" id="accessName" type="text" name="accessName" required value="{{ $accessName }}">
        </div>
        <button class="btn fs-5 btn-primary" type="submit"><i class="fa-solid fa-cart-shopping me-1"></i>{{ $id ? 'Modifier' : 'Ajouter au panier' }}</button>
</form>
