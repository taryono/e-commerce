@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Grup Menu <div style="text-align: right"><a href="{{route('group_menu.create')}}">Tambah</a></div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th width="10px">Nama</th>  
                                <th width="10px">Status</th>
                                <th width="10px">Aksi</th>
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($group_menus as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->name}}</th>    
                                <th width="10px">{{($c->is_published == 1)?'Aktif':'Tidak Aktif'}}</th>
                                <th width="10px">{!!getActions('group_menu','edit', $c->id)?getActions("group_menu",'edit', $c->id):NULL!!}&nbsp;{!!getActions('group_menu','destroy', $c->id)?getActions("group_menu",'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$group_menus->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
