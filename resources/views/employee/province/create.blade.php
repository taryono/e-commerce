@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Province</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('province.store') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group{{ $errors->has('km') ? ' has-error' : '' }}">
                            <label for="km" class="col-md-4 control-label">Km</label>

                            <div class="col-md-6">
                                <input id="km" type="text" class="form-control" name="km" value="{{ old('km') }}" required autofocus>

                                @if ($errors->has('km'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('km') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                         
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                &nbsp; <button type="button" onclick="window.location.href='{{route("province.index")}}'" class="btn btn-primary">
                                    Batal
                                </button> 
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
