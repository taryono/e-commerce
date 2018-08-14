@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Roles</div>
                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th width="10px">Nama</th> 
                                <th width="10px">Description</th> 
                                <th width="10px">Aksi</th>
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($roles as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->name}}</th>  
                                <th width="10px">{{$c->description}}</th>
                                <th width="10px">{!!getActions('acl','edit', $c->id)?getActions("acl",'edit', $c->id):NULL!!}&nbsp;{!!getActions('acl','destroy', $c->id)?getActions('acl','destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$roles->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
