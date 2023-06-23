@extends('home')

@push('css')

@endpush

@section('content')

    <div class="alert alert-warning  alert-dismissible" role="alert">
        <div class="row">
            <div class="col-md-1">
                <span class="material-icons align-bottom">error</span>
            </div>
            <div class="col-md-11">
                <p class="bigger-150">403 Forbidden</p>
                You don't have access to this page. Please <a href="">login</a> or try something else. You may have lost your login
                session. Consider checking the '<i>Remember me</i>' button at you login page next time. If you think this is an error or a bug, please <a
                        href="">contact us</a>. <br/><br/>
                Thank you and sorry for the inconvenience.
            </div>
        </div>
    </div>

@endsection


@push('js')

@endpush