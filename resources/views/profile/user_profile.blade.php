@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    <div class="form-horizontal"> 
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">Nama Depan</label>
                            <div class="col-md-6">
                                <label for="first_name" class="col-md-4 control-label">{{$user->user_detail->first_name}}</label> 
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Nama Belakang</label>
                            <div class="col-md-6">
                                <label for="last_name" class="col-md-4 control-label">{{$user->user_detail->last_name}}</label> 
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
