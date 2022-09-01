<form action="{{ url('member_accesses') }}" class="needs-validation" method="POST" novalidate id="formOrder">@csrf
    <input type="hidden" id="form_level" name="form_level" value="BAS">
    <input type="hidden" id="form_free_account" name="form_free_account" value="0">
    <input type="hidden" id="form_diskspace" name="form_diskspace" value="10">
    <input type="hidden" id="form_expire" name="form_expire" value="">
    <button class="btn fs-5 btn-primary" type="submit"><i class="fa-solid fa-cart-shopping"></i>
        Ajouter au panier
    </button>
</form>
