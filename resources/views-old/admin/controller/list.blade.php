@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Controllers <div style="text-align: right"><a href="{{route('controller.create')}}">Tambah</a></div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th width="10px">Nama</th> 
                                <th width="10px">Group Menu</th> 
                                <th width="10px">Aksi</th>
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($controllers as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->name}}</th> 
                                <th width="10px">{{$c->group_menu->name}}</th> 
                                <th>{!!getActions('controller','edit', $c->id)?getActions('controller','edit', $c->id):NULL!!} &nbsp;{!!getActions('controller','destroy', $c->id)?getActions('controller','destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$controllers->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
