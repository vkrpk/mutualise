<form action="{{ route('cart.store') }}" method="POST" id="formAddToCart" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="form_level" name="form_level" value="basique">
    <button class="btn fs-5 btn-primary" type="submit">
        <i class="fa-solid fa-cart-shopping me-1"></i>
        Ajouter au panier
    </button>
</form>
