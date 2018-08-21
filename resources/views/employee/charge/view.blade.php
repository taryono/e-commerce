@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Craft</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('craft.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Kode</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus>

                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
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
                        <div class="form-group">
                            <label for="category_id" class="col-md-4 control-label">Kategori</label>
                            
                            <div class="col-md-6">
                                <select name="category_id" class="form-control">
                                    @foreach($charges as $c)
                                    <option value="{{$c->id}}">{{ucfirst($c->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                            <label for="weight" class="col-md-4 control-label">Weight</label> 
                            <div class="col-md-6">
                                <input id="weight" type="number" min="1" class="form-control" name="weight" value="{{ old('weight') }}" required autofocus>

                                @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                            <label for="height" class="col-md-4 control-label">Height</label> 
                            <div class="col-md-6">
                                <input id="height" type="number" min="1" class="form-control" name="height" value="{{ old('height') }}" required autofocus>

                                @if ($errors->has('height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('long') ? ' has-error' : '' }}">
                            <label for="long" class="col-md-4 control-label">Long</label> 
                            <div class="col-md-6">
                                <input id="long" type="number" min="1" class="form-control" name="long" value="{{ old('long') }}" required autofocus>

                                @if ($errors->has('long'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('long') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                            <label for="color" class="col-md-4 control-label">Color</label> 
                            <div class="col-md-6">
                                <input id="color" type="text" class="form-control" name="color" value="{{ old('color') }}" required autofocus>

                                @if ($errors->has('color'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('color') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="supplier_id" class="col-md-4 control-label">Supplier</label>
                            
                            <div class="col-md-6">
                                <select name="supplier_id" class="form-control">
                                    @foreach($suppliers as $s)
                                    <option value="{{$s->id}}">{{ucfirst($s->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                         
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image</label> 
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image" value="{{ old('image') }}" required autofocus>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
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
