<footer class="footer-basic mt-auto py-1 bg-info fixed-bottom position-relative">
    <ul class="list-inline mt-md-4 text-primary">
        <li class="list-inline-item"><a href="{{ route('contact.index') }}">Contact</a></li>
        <li class="list-inline-item"><a href="{{ route('footer.cguv') }}">CGUV</a></li>
        <li class="list-inline-item"><a href="{{ route('footer.politique-confidentialite') }}">Politique de confidentialité</a></li>
        <div class="d-inline-block">
            <li class="list-inline-item social pb-0"><a href="https://www.facebook.com/DediKam"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li class="list-inline-item social pb-0"><a href="https://twitter.com/DediKam"><i class="fa-brands fa-twitter"></i></a></li>
        </div>
    </ul>
    <p class="copyright text-primary">Dedikam © 2008 - 2021</p>
    @isAdmin()
        <div class="admin rounded-2 text-white">Administrateur</div>
    @endisAdmin
</footer>
