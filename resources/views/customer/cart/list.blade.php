@extends('layouts.app') 
@section('style')
<style type="text/css">
    .plus-collapse{
        cursor: pointer;
    }
</style>
@endsection
@section('content') 
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List Keranjang Belanja Pelanggan </div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th>   
                                <th>Nama Pembeli</th>    
                                <th>Alamat</th>
                                <th>Handphone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($carts as $key => $c)
                            <tr class="ordering">
                                <th>{{++$key}}</th>  
                                <th><i class="fa fa-plus-square plus-collapse" data-rowid="{{$c->id}}" data-url-source="{{route("cart.list_by_cart",$c->id)}}"></i> &nbsp;{{$c->user->user_detail->first_name}}</th> 
                                <th>{{$c->user->user_detail->address}}</th>
                                <th>{{$c->user->user_detail->cellphone}}</th>
                                <th>{{rupiahFormat($c->total)}}</th>
                                <th>{{$c->status->name}}</th>
                                <th>@if($c->status_id != 2) <a href="{{route("cart.paid",$c->id)}}">Bayar</a> &nbsp;{!!getActions('cart','destroy', $c->id)?getActions('cart','destroy', $c->id):NULL!!}@endif</th> 
                            </tr>
                            <tr class="hide">
                                <td>&nbsp;</td>
                                <td class="hidden row_collapse" id="row_collapse_{{$c->id}}" colspan="5"></td>
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
