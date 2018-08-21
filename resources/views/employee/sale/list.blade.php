@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Laporan Penjualan</div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th>Nama Pembeli</th> 
                                <th>Nama Barang</th> 
                                <th>Harga</th>  
                                <th>Jumlah Pembelian</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @if($cart_details->count() > 0)
                                @foreach($cart_details as $key => $c)
                                <tr class="ordering">
                                    <th>{{++$key}}</th>
                                    <th>{{$c->cart->user->user_detail->first_name}}</th>
                                    <th>{{$c->craft->name}}</th>  
                                    <th>{{rupiahFormat($c->price)}}</th>
                                    <th>{{$c->amount}}</th>
                                     <th>{{rupiahFormat($c->subtotal)}}</th>
                                    <th>{!!getActions('craft', 'edit',$c->id)?getActions('craft', 'edit', $c->id):NULL!!}&nbsp;{!!getActions('craft', 'destroy', $c->id)?getActions('craft', 'destroy', $c->id):NULL!!}</th> 
                                </tr>
                                @endforeach
                            @else
                                <tr class="ordering">
                                    <th colspan="5" style="text-align: center">Data Penjualan Kosong</th>
                                </tr>
                            @endif
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$cart_details->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
