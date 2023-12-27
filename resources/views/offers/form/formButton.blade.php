<form action="{{ route('cart.store') }}" method="POST" id="formAddToCart" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
    @csrf
    <input type="hidden" id="form_level" name="form_level" value="{{ old('form_level') ? old('form_level') : ($level ?? 'standard') }}">
    <input type="hidden" name="id" value="{{ $id }}">
        <div class="mb-3" style="width: 290px">
            <label class="small mb-1" for="accessName">{{__("Nom de l'accès")}}<sup><i class="fa-solid fa-asterisk" style="font-size: 8px;color: red;margin-top: -14px;"></i></sup></label>
            <input class="form-control" id="accessName" type="text" name="accessName" value="{{ old('accessName') ? old('accessName') : $accessName }}">
            @error('accessName')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn fs-5 btn-primary" type="submit"><i class="fa-solid fa-cart-shopping me-2"></i>{{ __( $id ? "Update" : "Ajouter au panier") }}</button>
</form>
