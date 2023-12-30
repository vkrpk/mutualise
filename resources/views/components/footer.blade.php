<footer class="footer-basic mt-auto py-1 bg-info fixed-bottom position-relative ">
    <ul class="list-inline text-secondary">
        <li class="list-inline-item"><a href="{{ route('contact.index') }}">Contact</a></li>
        <li class="list-inline-item"><a href="{{ route('footer.cguv') }}">{{__("CGUV")}}</a></li>
        <li class="list-inline-item"><a href="{{ route('footer.politique-confidentialite') }}">{{__("Politique de confidentialité")}}</a></li>
        <div class="d-inline-block">
            <li class="list-inline-item social pb-0"><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li class="list-inline-item social pb-0"><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
        </div>
    </ul>
    <p class="copyright text-primary">Victork © {{ now()->year }}</p>
    @isAdmin()
        <div class="admin rounded-2 text-white">Administrateur</div>
    @endisAdmin
</footer>
