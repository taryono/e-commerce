@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Testimony</div> 
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('testimony.update', $testimony->id) }}">
                        {{ csrf_field() }} 
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-md-4 control-label">Kode</label>

                            <div class="col-md-6">
                                <input id="message" type="text" class="form-control" name="message" value="{{ $testimony->message }}" required autofocus>

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                &nbsp; <button type="button" onclick="window.location.href='{{route("testimony.index")}}'" class="btn btn-primary">
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
