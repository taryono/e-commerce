@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Pengiriman <div style="text-align: right">{!!getActions('shipping','create')?getActions('shipping','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th>  
                                <th width="10px">Nama</th>  
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($shippings as $key => $c)
 
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>  
                                <th width="10px"><a href="{{route('shipping.detail',['id'=> $c->id])}}">{{$c->courier->name}}</a></th>
                                <th width="10px">{!!getActions('shipping', 'edit',$c->id)?getActions('shipping', 'edit', $c->id):NULL!!}&nbsp;{!!getActions('shipping', 'destroy', $c->id)?getActions('shipping', 'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$shippings->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
