@if ($errors->any())
    <div class="alert btn-outline-danger">
        @foreach ($errors->all() as $error)
            <p> {{ $error }}</p>
        @endforeach
    </div>
@endif
