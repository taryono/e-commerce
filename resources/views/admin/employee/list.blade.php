@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">List Pegawai <div style="text-align: right">{!!getActions('employee','create')?getActions('employee','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th>
                                <th width="10px">Nama</th> 
                                <th width="10px">Email</th> 
                                <th width="10px">Alamat</th>  
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($users as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->user_detail?$c->user_detail->first_name:NULL}} &nbsp; {{$c->user_detail?$c->user_detail->last_name:NULL}}</th>  
                                <th width="10px">{{$c->email}}</th>
                                <th width="10px">{{$c->user_detail?$c->user_detail->address:NULL}}</th>
                                <th width="10px">{!!getActions('employee','edit', $c->id)?getActions('employee','edit', $c->id):NULL!!}&nbsp;{!!getActions('employee','destroy', $c->id)?getActions('employee','destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$users->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
