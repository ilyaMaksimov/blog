@if(session('status'))
    <div class="container">
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    </div>
@endif
@if(session('success'))
    <div class="container">
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    </div>
@endif
@if(session('danger'))
    <div class="container">
        <div class="alert alert-danger">
            {{session('danger')}}
        </div>
    </div>
@endif