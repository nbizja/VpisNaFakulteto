@if (!empty(session('errors')))
    <div class="alert alert-danger">
        @foreach (array_unique(session('errors')) as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif

@if (!empty(session('status')) && !empty(session('message')))

    <div class="alert alert-{{ session('status') }}" role="alert">
        {{ session('message') }}
    </div>
@endif