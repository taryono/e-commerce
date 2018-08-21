@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Charges</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('charge.store') }}"  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Jumlah</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required autofocus>

                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="from_province_id" class="col-md-4 control-label">From</label>
                            
                            <div class="col-md-6">
                                <select name="from_province_id" class="form-control">
                                    @foreach($provinces as $c)
                                    <option value="{{$c->id}}">{{ucfirst($c->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="to_province_id" class="col-md-4 control-label">To</label>
                            
                            <div class="col-md-6">
                                <select name="to_province_id" class="form-control">
                                    @foreach($provinces as $c)
                                    <option value="{{$c->id}}">{{ucfirst($c->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                &nbsp; <button type="button" onclick="window.location.href='{{route("charge.index")}}'" class="btn btn-primary">
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
