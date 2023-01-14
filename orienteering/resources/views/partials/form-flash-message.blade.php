@if (session('success'))
    <div class="alert alert-success" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>
            <i class="fa fa-check-circle-o"></i>
            {!! session('success') !!}
        </p>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>
            <i class="fa fa-times-circle-o"></i>
            {!! session('warning') !!}
        </p>
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>
            <i class="fa fa-info-circle"></i>
            {!! session('info') !!}
        </p>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p>
            <i class="fa fa-times-circle-o"></i>
            {!! session('error') !!}
        </p>
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        @foreach ($errors->all() as $error)
            <p>
                <i class="fa fa-times-circle-o"></i>
                {!! $error !!}
            </p>
        @endforeach
    </div>
@endif