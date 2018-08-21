@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Controller</div> 
                <div class="panel-body">
                    {{ Form::model($controller, array('route' => array('controller.update', $controller->id), 'method' => 'PUT', 'class'=> 'form-horizontal')) }}
                        <input type="hidden" name="id" value="{{$controller->id}}">
                        {{ csrf_field() }} 
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"> 
                            <div class="col-md-3"><label for="name" class="col-md-12 control-label">Path </label></div>
                            <div class="col-md-4"><input  class="form-control"  type="text" value="\\App\\Http\\Controllers\\" readonly="readonly" size="30%"></div>
                            <div class="col-md-5"> 
                                <?php
                                $cons = explode('\\',$controller->name);
                                $name = "";
                                foreach($cons as $key => $c){
                                    if($key < 4) continue;
                                    $name .= "\\".$c;
                                } 
                                ?>
                                <input id="name" type="text" class="form-control" name="name" value="{{ substr($name,1) }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}"> 
                            <div class="col-md-7"><label for="title" class="col-md-12 control-label">Title</label></div> 
                            <div class="col-md-5"> 
                                <input id="name" type="text" class="form-control" name="title" value="{{ $controller->title }}" required autofocus placeholder="role">
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="form-group{{ $errors->has('group_menu_id') ? ' has-error' : '' }}">
                            <label for="is_published" class="col-md-7 control-label">Group Menu</label>

                            <div class="col-md-5"> 
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
                        <div class="form-group"> 
                            <div class="col-md-6"></div>
                            <div class="col-md-6" style="text-align: right">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="button" onclick="window.location.href='{{route("controller.index")}}'" class="btn btn-primary">
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
