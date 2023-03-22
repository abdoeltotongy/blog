@if(session('msg'))
    <div class="alert alert-success" role="alert">
        {{ session('msg') }}
    </div>
@endif