@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Craft <div style="text-align: right">{!!getActions('craft','create')?getActions('craft','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th width="10px">Kode</th> 
                                <th width="10px">Nama</th>  
                                <th width="10px">Stok</th>
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($crafts as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->code}}</th>  
                                <th width="10px">{{$c->name}}</th>
                                <th width="10px">{{$c->craft_detail?$c->craft_detail->stock:NULL}}</th>
                                <th width="10px">{!!getActions('craft', 'edit',$c->id)?getActions('craft', 'edit', $c->id):NULL!!}&nbsp;{!!getActions('craft', 'destroy', $c->id)?getActions('craft', 'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$crafts->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
