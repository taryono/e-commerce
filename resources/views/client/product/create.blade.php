@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-defaul">
                <div class="panel-heading">Tambah Produk</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ code('product.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code" class="col-md-4 control-label">Route</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="code" value="{{ old('code') }}" required autofocus placeholder="/menu/edit">

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
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="menu.edit">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6"> 
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="action" type="file" class="form-control" name="image" required>

                                @if ($errors->has('action')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('is_slide') ? ' has-error' : '' }}">
                            <label for="is_slide" class="col-md-4 control-label">Show Image as slide</label>

                            <select name="category_id" class="form-control">
                                    <option value="1">Yes</option> 
                                    <option value="0">No</option> 
                            </select>
                        </div>
                         
                          
                        <div class="form-group{{ $errors->has('is_published') ? ' has-error' : '' }}">
                            <label for="is_published" class="col-md-4 control-label">Published</label> 
                            <div class="col-md-6"> 
                                <select name="is_published" class="form-control"> 
                                    <option value="0">Draft</option> 
                                    <option value="1">Publish</option>  
                                </select>
                                @if ($errors->has('is_published'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_published') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                            <label for="supplier_id" class="col-md-4 control-label">Supplier</label>

                            <div class="col-md-6"> 
                                <select name="supplier_id" class="form-control"> 
                                    @foreach($suppliers as $s)
                                    <option value="{{$s->id}}">{{$s->name}}</option>  
                                    @endforeach
                                </select>
                                @if ($errors->has('supplier_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('supplier_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="col-md-4 control-label">Harga</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}" required autofocus placeholder="10000">

                                @if ($errors->has('long'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('long') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('long') ? ' has-error' : '' }}">
                            <label for="long" class="col-md-4 control-label">Long</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="long" value="{{ old('long') }}" required autofocus placeholder="40 cm">

                                @if ($errors->has('long'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('long') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                            <label for="weight" class="col-md-4 control-label">Weight</label>

                            <div class="col-md-6">
                                <input id="weight" type="text" class="form-control" name="weight" value="{{ old('weight') }}" required autofocus placeholder="40 gr">

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
                                <input id="height" type="text" class="form-control" name="height" value="{{ old('height') }}" required autofocus placeholder="40 cm">

                                @if ($errors->has('height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4" style="text-align: right">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="button" onclick="window.location.hre='{{code("product.index")}}'" class="btn btn-primary">
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
<div class="pre" style="margin-bottom: 100px;">
    
</div>
@endsection
