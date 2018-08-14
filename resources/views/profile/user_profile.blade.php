@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    <div class="form-horizontal"> 
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <label for="name" class="col-md-4 control-label">{{$user->name}}</label> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Alamat Email</label> 
                            <div class="col-md-6">
                                <label for="name" class="col-md-4 control-label">{{$user->email}}</label>
                            </div>
                        </div> 
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
