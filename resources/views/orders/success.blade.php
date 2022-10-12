@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-header customCardHeader">
                        <span>Votre commande a bien été effectué.</span>
                    </div>
                    <div class="card-body">
                        <p>Vous allez être redirigé automatiquement.</p>
                        <p>Si ce n'est pas le cas, veuillez cliquer <a class="text-decoration-underline text-primary" href="{{ route('access.index') }}">ici</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
window.onload = function () {
    const redirectToAccessIndex = () => {
        setTimeout(function() {
               window.location.href = '{{ route('access.index') }}'
           }, 5000);
    }
    redirectToAccessIndex();
}
</script>
@endpush
