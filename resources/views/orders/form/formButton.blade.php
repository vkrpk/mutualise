<form action="{{ route('cart.store') }}" class="needs-validation" method="POST" id="formOrder" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="form_level" name="form_level" value="1">
    <button class="btn fs-5 btn-primary" type="submit">
        <i class="fa-solid fa-cart-shopping"></i>
        Ajouter au panier
    </button>
</form>
