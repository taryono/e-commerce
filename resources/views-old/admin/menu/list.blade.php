@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Menu <div style="text-align: right"><a href="{{route('menu.create')}}">Tambah</a></div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th>Nama</th> 
                                <th>Url</th> 
                                <th>Path</th>
                                <th>Aksi</th>
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($menus as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th><a href="{{route('menu.children', $c->id)}}">{{$c->name}}</a></th>  
                                <th>{{$c->route}}</th>
                                <th>{{$c->controller->name.$c->action}}</th> 
                                <th>{!!getActions('menu','edit', $c->id)?getActions('menu','edit', $c->id):NULL!!} &nbsp;{!!getActions('menu','destroy', $c->id)?getActions('menu','destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$menus->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
