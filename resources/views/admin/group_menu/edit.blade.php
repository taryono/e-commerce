@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Grup Menu</div>

                <div class="panel-body">
                    {{ Form::model($groups, array('route' => array('group_menu.update', $groups->id), 'method' => 'PUT', 'class'=> 'form-horizontal')) }}
                        {{ csrf_field() }}
                         
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{$groups->name}}" required autofocus placeholder="menu.edit">

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
                                    <option value="0" {{($groups->is_publised == 0)?'selected="selected"':''}}>Unpublish</option>                       
                                    <option value="1" {{($groups->is_publised == 1)?'selected="selected"':''}}selected="selected">Publish</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4" style="text-align: left">
                                <button type="submit"class="btn btn-primary">
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
