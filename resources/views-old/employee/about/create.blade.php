@extends('layouts.app')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('css/editor.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create User</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }} 
                        <div id="txtEditor"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script') 
<script src="{{ asset('js/editor.js') }}"></script>  
@endsection
