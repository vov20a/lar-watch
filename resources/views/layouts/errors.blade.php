<div class="col-md-12" style="padding: 0; text-align:center;">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session()->has('success'))
    <div class="alert alert-success">
        @if (Auth::user())
        <span style="font-weight: bold; color:#000;">{{ Auth::user()->name }}:&nbsp; </span>
        @endif
        {{ session('success') }}
    </div>
    @endif
</div>
