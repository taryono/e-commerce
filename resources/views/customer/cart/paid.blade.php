@extends('layouts.app')

@section('content')
<?php $cart_details = $cart->cart_detail; ?>

<div class="container-fluid"> 
    <div class="container">  
        <div class="row">
            <div class="col-lg-6">
                @if($cart_details->count() > 0) 
                @foreach($cart_details->chunk(round(3)) as $chunks)
                <div class="row">
                    @foreach($chunks as $cart_detail) 
                    <div class="col-lg-4"> 
                        <img class="rounded-circle" src="/uploads/<?= $cart_detail->craft->craft_image->path . '/' . $cart_detail->craft->craft_image->name ?>" alt="Generic placeholder image" width="140" height="140">
                        <h4>{{$cart_detail->craft->name}}</h4>
                        <table class="table table-striped">
                            <tr class="table-success">
                                <th width="100">Kategori</th>
                                <th>{{$cart_detail->craft->category?$cart_detail->craft->category->name:NULL}} </th>
                            </tr>
                            <tr>
                                <td width="100">Supplier</td>
                                <td>{{$cart_detail->craft->supplier?$cart_detail->craft->supplier->name:NULL}} </td>
                            </tr>
                            <tr>
                                <td width="100">Harga</td>
                                <td>{{$cart_detail->craft->craft_detail?rupiahFormat($cart_detail->craft->craft_detail->price):NULL}} </td>
                            </tr>
                            <tr>
                                <td width="100">Stok</td>
                                <td>{{$cart_detail->craft->craft_detail?$cart_detail->craft->craft_detail->stock:NULL}} PCS</td>
                            </tr>
                        </table>
                        <p style="font-weight: bold; color: red;">{{$cart_detail->amount}} x {{rupiahFormat($cart_detail->price)}}</p>
                    </div> 
                    @endforeach
                </div><!-- /.row -->
                @endforeach 
                @endif
            </div>
            <div class="col-lg-6">
                <div class="row"> 
                    <div class="col-md-6">
                        <table class="table table-striped"> 
                            <tr class="table-success">
                                <th>Subtotal</th>
                                <th>{{rupiahFormat($cart->subtotal)}}</th>
                            </tr> 
                            <tr class="table-success">
                                <th>Fee</th>
                                <th>{{rupiahFormat($cart->fee)}}</th>
                            </tr> 
                            <tr class="table-success">
                                <th>Total</th>
                                <th>{{rupiahFormat($cart->total)}}</th>
                            </tr> 
                        </table> 

                    </div>
                    <div class="col-md-6">

                        <table class="table table-striped"> 
                            <tr class="table-success">
                                <th>Silahkan Kirim Ke No Rek :</th>
                                <th>1234</th>
                            </tr> 
                            <tr class="table-success">
                                <th>a.n</th>
                                <th>Didin Imanudin</th>
                            </tr> 
                            <tr class="table-success">
                                <th>Bank</th>
                                <th>BRI Cabang Kalimantan</th>
                            </tr> 
                        </table>    
                    </div> 
                </div>
                <div class="row">
                        <div class="col-md-6"></div>
                    <div class="col-md-6"> <button class="button btn-success form-control" id="pay">Bayar</button></div>
                    
                </div>
            </div>
        </div>

    </div> 
</div> 
@endsection
