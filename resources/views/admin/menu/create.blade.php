@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('menu.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('route') ? ' has-error' : '' }}">
                            <label for="route" class="col-md-4 control-label">Route</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="route" value="{{ old('route') }}" required autofocus placeholder="menu.edit">

                                @if ($errors->has('route'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('route') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="menu/edit">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('path') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Path</label>

                            <div class="col-md-6"> 
                                <select name="path" class="form-control">
                                    @foreach($controllers as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('path'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('action') ? ' has-error' : '' }}">
                            <label for="action" class="col-md-4 control-label">Aksi</label>

                            <div class="col-md-6">
                                <input id="action" type="text" class="form-control" name="action" required placeholder="index">

                                @if ($errors->has('action')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('action') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('param') ? ' has-error' : '' }}">
                            <label for="param" class="col-md-4 control-label">Parameter</label>

                            <div class="col-md-6">
                                <input id="param" type="text" class="form-control" name="param" placeholder="{id}">

                                @if ($errors->has('param')) 
                                    <span class="help-block">
                                        <strong>{{ $errors->first('param') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('method') ? ' has-error' : '' }}">
                            <label for="method" class="col-md-4 control-label">Method</label>

                            <div class="col-md-6"> 
                                <select name="method" class="form-control"> 
                                    <option value="get">GET</option> 
                                    <option value="post">POST</option>
                                    <option value="put">PUT</option> 
                                    <option value="delete">DELETE</option> 
                                    <option value="all">GET,POST</option> 
                                </select>
                                @if ($errors->has('method'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('method') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                            <label for="position" class="col-md-4 control-label">Jabatan</label>

                            <div class="col-md-6"> 
                                <select name="position" class="form-control"> 
                                    <option value="bo">BO</option> 
                                    <option value="front">FRONT</option>  
                                </select>
                                @if ($errors->has('position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nav_type') ? ' has-error' : '' }}">
                            <label for="nav_type" class="col-md-4 control-label">Posisi Navigasi</label>

                            <div class="col-md-6"> 
                                <select name="nav_type" class="form-control"> 
                                    <option value="top-right">Top Right</option> 
                                    <option value="top-left">Top Left</option> 
                                    <option value="sidebar">Sidebar</option>  
                                </select>
                                @if ($errors->has('nav_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nav_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nav_type') ? ' has-error' : '' }}">
                            <label for="is_published" class="col-md-4 control-label">Status</label>

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
                        <div class="form-group{{ $errors->has('group_menu_id') ? ' has-error' : '' }}">
                            <label for="is_published" class="col-md-4 control-label">Group Menu</label>

                            <div class="col-md-6"> 
                                <select name="group_menu_id" class="form-control"> 
                                    @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>  
                                    @endforeach
                                </select>
                                @if ($errors->has('group_menu_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('group_menu_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label> 
                            <div class="col-md-6"> 
                                <select name="type" class="form-control"> 
                                    <option value="">--</option> 
                                    <option value="index">List</option> 
                                    <option value="create">Create</option>  
                                    <option value="edit">Edit</option> 
                                    <option value="show">Show</option> 
                                    <option value="update">Update</option> 
                                    <option value="destroy">Delete</option> 
                                </select>
                                @if ($errors->has('is_published'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('is_show') ? ' has-error' : '' }}">
                            <label for="is_show" class="col-md-4 control-label">Generate Route</label> 
                            <div class="col-md-6"> 
                                <select name="is_show" class="form-control"> 
                                    <option value="">--</option> 
                                    <option value="1">Ya</option> 
                                    <option value="0" selected="selected">Tidak</option>   
                                </select>
                                @if ($errors->has('is_published'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_show') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4" style="text-align: right">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="button" onclick="window.location.href='{{route("menu.index")}}'" class="btn btn-primary">
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
