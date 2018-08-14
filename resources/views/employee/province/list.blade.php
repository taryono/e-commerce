@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Propinsi <div style="text-align: right">{!!getActions('province','create')?getActions('province','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th>  
                                <th width="10px">Nama</th> 
                                <th width="10px">Km</th>  
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($provinces as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>                                  
                                <th width="10px">{{$c->name}}</th>
                                <th width="10px">{{$c->km}}</th> 
                                <th width="10px">{!!getActions('province', 'edit',$c->id)?getActions('province', 'edit', $c->id):NULL!!}&nbsp;{!!getActions('province', 'destroy', $c->id)?getActions('province', 'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$provinces->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
