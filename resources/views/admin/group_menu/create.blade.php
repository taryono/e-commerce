@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Group Menu</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('group_menu.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Product">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="is_published" class="col-md-4 control-label">Is Publish</label> 
                            <div class="col-md-6">
                                <select name="is_published" class="form-control"> 
                                    <option value="0">Tidak Aktif</option>                       
                                    <option value="1">Aktif</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4" style="text-align: right">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="button" onclick="window.location.href='{{route("group_menu.index")}}'" class="btn btn-primary">
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
