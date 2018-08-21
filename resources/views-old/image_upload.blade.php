@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Image</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('upload.save') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('directory') ? ' has-error' : '' }}">
                            <label for="route" class="col-md-4 control-label">Category</label>
                            <div class="col-md-6">
                                <select name="directory" class="form-control">
                                    @foreach($categories as $c)
                                    <option value="{{$c->name}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('directory'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('directory') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                            <label for="route" class="col-md-4 control-label">Upload</label>
 
                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="image" value="{{ old('image') }}" required autofocus>

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="role" type="hidden" class="form-control" name="haji">
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
<div class="pre" style="margin-bottom: 100px;">
    
</div>
@endsection 
 