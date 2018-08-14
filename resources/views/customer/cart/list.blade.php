@extends('layouts.app') 
@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Carts </div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th>No</th>   
                                <th>Nama</th>    
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($carts as $key => $c)
                            <tr class="ordering">
                                <th>{{++$key}}</th>
                                <th><?php echo $c->user?'<a href="'.route('cart.edit',$c->id).'">'.$c->cart_detail->craft->name.'</a>':NULL?></th>                                    
                                <th>{{$c->cart_detail->amount}}</th>
                                <th>{{rupiahFormat($c->total)}}</th>
                                <th>{{$c->status->name}}</th>
                                <th>@if($c->status_id != 2){!!getActions('cart','destroy', $c->id)?getActions('cart','destroy', $c->id):NULL!!}@endif</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$carts->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
