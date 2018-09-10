@extends('layouts.app')
@section('styles')  
<link rel="stylesheet" href="{{ asset('plugins/editable/bootstrap3-editable/css/bootstrap-editable.css')}}"> 
@stop
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
                                <th>
                                    @if(Auth::check() && Auth::user()->hasRole('administrator'))
                                    <a href="#" id="bank_account_number" data-name="bank_account_number" data-type="text" data-pk="{{$about->id}}" data-url="{{route('about.update', $about->id)}}" data-title="Content">{{$about->bank_account_number}}</a>
                                    @else 
                                        {{$about->bank_account_number}}
                                    @endif 
                                </th>
                            </tr> 
                            <tr class="table-success">
                                <th>a.n</th>
                                <th>
                                    @if(Auth::check() && Auth::user()->hasRole('administrator'))
                                    <a href="#" id="bank_account_name" data-name="bank_account_name" data-type="textarea" data-pk="{{$about->id}}" data-url="{{route('about.update', $about->id)}}" data-title="Content">{{$about->bank_account_name}}</a>
                                    @else 
                                        {{$about->bank_account_name}}
                                    @endif  
                                </th>
                            </tr> 
                            <tr class="table-success">
                                <th>Bank</th>
                                <th>
                                    @if(Auth::check() && Auth::user()->hasRole('administrator'))
                                    <a href="#" id="bank_name" data-name="bank_name" data-type="text" data-pk="{{$about->id}}" data-url="{{route('about.update', $about->id)}}" data-title="Content">{{$about->bank_name}}</a>
                                    @else 
                                        {{$about->bank_name}}
                                    @endif  
                                </th>
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
@section('script')
 <script src="{{ asset('plugins/editable/bootstrap3-editable/js/bootstrap-editable.min.js')}}" type="text/javascript"></script>
    <script>
            $(function(){
                $.fn.editable.defaults.mode = 'inline';
                $.fn.editable.defaults.ajaxOptions = {type: "PUT"};
                $("a#bank_account_number,a#bank_account_name,a#bank_name").editable();
            });
        </script>
@endsection 
@endsection
