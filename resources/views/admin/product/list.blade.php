@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Craft <div style="text-align: right">{!!getActions('product','create')?getActions("product",'create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th width="10px">Nama</th> 
                                <th width="10px">Category</th>  
                                <th width="10px">Supplier</th>
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($products as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->name}}</th>  
                                <th width="10px">{{$c->category->name}}</th> 
                                <th width="10px">{{$c->supplier->name}}</th>
                                <th width="10px">{!!getActions('product','edit', $c->id)?getActions("product",'edit', $c->id):NULL!!}&nbsp;{!!getActions("product",'destroy', $c->id)?getActions("product",'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$products->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
