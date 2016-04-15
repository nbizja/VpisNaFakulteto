@if (!empty(session('status')) && !empty(session('message')))

    <div class="alert alert-{{ session('status') }}" role="alert">
        {{ session('message') }}
    </div>
@endif