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
                <div class="panel-heading">List Pengiriman <div style="text-align: right">{!!getActions('shipping','create')?getActions('shipping','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th>  
                                <th>Nama Kurir</th>  
                                <th>Tanggal Pengiriman</th>
                                <th>Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($shippings as $key => $c)
 
                            <tr class="ordering">
                                <th>{{++$key}}</th>  
                                <th><i class="fa fa-plus-square plus-collapse" data-rowid="{{$c->id}}" data-url-source="{{route("shipping.listCartByShippingId",$c->id)}}"></i> &nbsp;{{$c->courier->name}}</th>
                                <th>{{date('d-m-Y', strtotime($c->send_date))}}</th>
                                <th>{!!getActions('shipping', 'edit',$c->id)?getActions('shipping', 'edit', $c->id):NULL!!}&nbsp;{!!getActions('shipping', 'destroy', $c->id)?getActions('shipping', 'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            <tr class="hide">
                                <td>&nbsp;</td>
                                <td class="hidden row_collapse" id="row_collapse_{{$c->id}}" colspan="3"></td>
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
