@extends('layouts.app') 
@section('content') 
<!--@@include('layouts.carousel') -->
<div class="container-fluid"> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-6">
                <img alt="Bootstrap Image Preview" src="{{asset('images/harley (2).jpeg')}}" width="500" height="400" class="img-responsive" />
                <h4>{{$craft->name}}</h4>
                <table class=" table table-bordered">
                    <tr>
                        <td width="100">Kategori</td>
                        <td>{{$craft->category?$craft->category->name:NULL}} </td>
                    </tr>
                    <tr>
                        <td width="100">Supplier</td>
                        <td>{{$craft->supplier?$craft->supplier->name:NULL}} </td>
                    </tr>
                    <tr>
                        <td width="100">Harga</td>
                        <td>{{$craft->craft_detail?rupiahFormat((int)$craft->craft_detail->price):NULL}} </td>
                    </tr>
                    <tr>
                        <td width="100">Stok</td>
                        <td><div id="stock">{{$craft->craft_detail?$craft->craft_detail->stock:NULL}}</div> </td>
                    </tr>
                    <tr>
                        <td width="100">Description</td>
                        <td><div id="stock">{{$craft?$craft->description:NULL}}</div> </td>
                    </tr>
                </table> 

            </div> 
            <div class="col-md-6">
               
                <h4>@if(!Auth::check())Untuk melanjutkan pembelian silahkan  <a href="{{route('login',['params'=> ['redirect'=> 'product.detail','param'=>$craft->id]])}}">login</a> dan isi form berikut: @endif </h4>
                <table class="table table-responsive">
                    <tr>
                        <td style="width: 150px">Jasa Pengiriman </td>
                        <td> 
                            <div class="form-group">   
                                <select id="courier_id" name="courier_id" class="form-control example-getting-started">
                                    <option value="">--Pilih Jasa Pengiriman--</option>
                                    @foreach($couriers as $s) 
                                    <option value="{{$s->id}}" {{($s->id == $cart->courier_id)?'selected="selected"':''}}>{{ucfirst($s->name)}}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Pembelian</td>
                        <td> <div class="form-group form-inline">   
                                <button class="form-control" style="width: 20px; display: initial" id="min">-</button>
                                <input type="number" name="amount_changed" value="{{$cart_detail?$cart_detail->amount:1}}" class="form-control amount_changed" style="width: 80px;  display: initial">
                                <button class="form-control" style="width: 20px;  display: initial" id="plus">+</button> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <?php
                        $total_Stock = $craft->craft_detail?$craft->craft_detail->stock:NULL;
                        $total_select = $cart_detail?$cart_detail->amount:0;
                        $total_selected = $total_Stock-$total_select;
                        ?>
                        <td><div class="stock_before">{{$total_selected}}</div></td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td> 
                            {{$craft->craft_detail?rupiahFormat((int)$craft->craft_detail->price):0}} </td>
                    </tr>
                    <!--tr>
                        <td>Biaya Kirim</td>
                        <td>{{rupiahFormat(10000)}} </td>
                    </tr-->
                    <tr>
                        <td></td>
                        <td><div class="form-group form-inline">
                                <div class="form-control amount_changed fix_amount" style="width: 20px; display: initial;">1</div>x
                                <div id="subtotal" class="form-control" style="width: 20px; display: initial">{{$craft->craft_detail?(int)$craft->craft_detail->price:NULL}}</div>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td nowrap="nowrap"><div id="subtotal_changed" style="width: 20px;">{{$craft->craft_detail?rupiahFormat($cart_detail->price*$cart_detail->amount):1}}</div></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>                       
                    </tr>
                </table>
                
                @if(Auth::check())
                <table class="table table-responsive"> 
                    <caption><h4>Alamat Penerima</h4></caption>
                    <tr>
                        <td>Nama:</td>   
                        <td>{{Auth::user()->user_detail->first_name}}</td>
                    </tr>
                    <tr>
                        <td>Last Nama:</td>   
                        <td>{{Auth::user()->user_detail->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Handphone</td>   
                        <td>{{Auth::user()->user_detail->cellphone}}</td>
                    </tr> 
                    <tr>
                        <td style="width: 150px">To </td>
                        <td> 
                            <div class="form-group">  
                                <select name="to_province_id" class="form-control example-getting-started" id="to_province_id_changed">
                                    @foreach($provinces as $p)
                                    <option data-km='{{$p->km}}' value="{{$p->id}}" {{($p->id==$cart->to_province_id)?'selected="selected"':''}}>{{ucfirst($p->name)}}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Fee </td>
                        <td> <?php
                             $fee = $cart->to_province_id?$cart->to_province->km*10000:10000;
                             ?>
                            <div class="fee">{{rupiahFormat($cart->to_province_id?$cart->to_province->km*10000:10000)}}</div>
                            <input type="hidden" id="fee" value="{{$fee}}">
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>   
                        <td><textarea class="form-control multiselect" name="address">
                            {{Auth::user()->user_detail->address}}
                            </textarea>
                        </td>
                    </tr>
                </table>
                <hr style="height: 2px; width: 100%">
                @endif 
                <hr style="height: 2px; width: 100%">
                <div class="col-md-6 form-inline"> 
                    <form class="form-horizontal submit-cart" method="POST" action="{{ route('cart.update_cart_detail',$cart_detail->id) }}">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PUT">
                        @if(Auth::check() && Auth::user()->hasRole(['customer']))
                        <input id='status' type="hidden" name="status_id" value="1"> 
                        <input class='courier_id' type="hidden" name="courier_id" value="{{$cart->courier_id}}">
                        <input id='user_id' type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input id='last_amount' type="hidden" name="amount" value="{{$cart_detail?(int)$cart_detail->amount:0}}">
                        <input id='to_province_id' type="hidden" name="to_province_id_post" value="{{$cart->to_province_id}}">
                        <input id='fee' type="hidden" name="fee" value="{{$fee}}">
                        <input id='craft_id' type="hidden" name="craft_id" value="{{$craft->id}}">
                        <input id='price' type="hidden" name="price" value="{{$craft->craft_detail?(int)$craft->craft_detail->price:0}}">
                        <input id='subtotal' type="hidden" name="subtotal" value="{{$cart_detail->subtotal}}"> 
                        <input id='last_stock' type="hidden" name="last_stock" value="{{$total_selected}}">
                        <div class="form-group form-inline">   
                            @if($cart->status_id != 2)
                            <table class="table table-striped table-check">
                                <tbody>
                                    <tr class="ordering">
                                        <th>Status :</th>
                                        <th style="text-align: center"><div class="status">{{$cart->status->name}}</div></th>
                                    </tr> 
                                </tbody>
                            </table> 
                            <br>
                            <button class="button btn-success form-control" id="update" data-status="1">Update</button>&nbsp;
                            <button class="button btn-success form-control" id="paid" data-status="2">Paid</button>  &nbsp;
                            <button class="button btn-success form-control" id="delete" data-status="3">Delete</button>                      
                            @else
                            <table class="table table-striped table-check">
                                <tbody>
                                    <tr class="ordering">
                                        <th>Status :</th>
                                        <th style="text-align: center"><div class="status">PAID</div></th>
                                    </tr> 
                                </tbody>
                            </table> 
                            @endif
                        </div>
                        @endif
                    </form>
                </div>
            </div> 
        </div> 
        <div class="row">
            <div class="col-md-6">
                <p><a class="btn btn-secondary" href="{{route('cart.index')}}" role="button">Kembali << </a></p>
            </div>
        </div>
    </div>
</div>
@endsection 
@foreach($provinces as $p)
<input type="hidden" class="fees" id="{{$p->id}}" value="{{$p->km}}">
@endforeach
@section('script')
<script type='text/javascript'>
    var fees = $("input.fees").val(); 
    var price = $("input#price").val();
    var stock_before = $("div.stock_before").text();
    var total_price = '{{$cart_detail->subtotal}}';
    var stock = '{{$craft->craft_detail?(int)$craft->craft_detail->stock:0}}'; 
    var last_total = 0; 
    $(function () {
        $a = $("input.amount_changed").val(); 
        $("input.amount_changed").bind('keyup mouseup', function () {
            $last_val = $(this).val();
            console.log($last_val);
            if ($(this).val() < 0) {
                $("input.amount_changed").val(1);
            } else if ($(this).val() == 0) {

            } else { 
                if (parseInt($last_val) <= parseInt(stock)) {
                    $("input.amount_changed").val($last_val);
                    $("div.amount_changed").text($last_val);
                    $("input#last_amount").val($last_val);
                    $("div#subtotal_changed").text(app.rupiah($last_val * price));
                    var fee = $("input#fee").val();
                    $("input#subtotal").val(($last_val * price));
                    $("input#total_price").val(($last_val * price)+parseInt(fee));
                    $("div.last_total").text(app.rupiah(($last_val * price)+parseInt(fee))); 
                    $("input#last_amount").val($("div.fix_amount").text());
                    if($(this).val() > $a){
                        var last_stock = parseInt($("div.stock_before").text())-parseInt(1);
                    }else{
                        var last_stock = parseInt($("div.stock_before").text())+parseInt(1);
                    }
                    
                    
                    $("div.stock_before").text(last_stock);
                    $("input#last_stock").val(last_stock);
                    $a = $(this).val();
                } else {
                    alert('Stok Terbatas');
                    $("input.amount_changed").val(stock);
                }
                
            }
        });
        $("body").on('click', 'button#min', function () {
            $val = $("input.amount_changed").val();
            if ($val > 1) {
                $val = $val - 1; 
                $("input.amount_changed").val($val);
                $("div.amount_changed").text($val);
                $subtotal = parseInt($("div.fix_amount").text() * parseInt(price));
                $("div#subtotal_changed").text(app.rupiah($subtotal));
                var fee = $("input#fee").val();
                $("input#subtotal").val($subtotal);
                last_total = $subtotal+parseInt(fee);
                $("input#last_amount").val($("div.fix_amount").text());
                var last_stock = parseInt($("div.stock_before").text())+parseInt(1);
                $("div.stock_before").text(last_stock);
                $("input#last_stock").val(last_stock);
                $("div.last_total").text(app.rupiah(last_total));
                $("input#total_price").val(last_total);
            } else if ($val < 0) {
                $val = 1;
                $("input.amount_changed").val($val);
                $("div.amount_changed").text($val);
            } else {

            }
            
        }).on('click', 'button#plus', function () {
            $val = $("input.amount_changed").val();
            if (parseInt($val) < parseInt(stock)) {
                $val = parseInt($val) + parseInt(1);
                $("input.amount_changed").val($val);
                $("div.amount_changed").text($val);
                $subtotal = parseInt($("div.fix_amount").text() * parseInt(price));
                $("div#subtotal_changed").text(app.rupiah($subtotal));
                var fee = $("input#fee").val();
                $("input#subtotal").val($subtotal);
                last_total = $subtotal;
                $("input#last_amount").val($("div.fix_amount").text());
                var last_stock = parseInt($("div.stock_before").text())- parseInt(1);
                $("div.stock_before").text(last_stock);
                $("input#last_stock").val(last_stock); 
                $("div.last_total").text(app.rupiah($subtotal + parseInt(fee)));
                $("input#total_price").val($subtotal + parseInt(fee));
            } else {
                console.log(parseInt($val) < parseInt(stock));
            }
            
        }).on('change', 'select#to_province_id_changed', function () {
            $val = $(this).val();
            $fee = $("input.fees#" + $val).val();
            $("div.fee").text(app.rupiah(parseInt($fee) * 10000));
            $("input#fee").val(parseInt($fee) * 10000);
            $total_price = parseInt($("input#fee").val()) + parseInt($("input#subtotal").val())
            $("input#subtotal").val();
            $("input#to_province_id").val($(this).val());
            $("input#total_price").val($total_price);
            $("div.last_total").text(app.rupiah($total_price));
        }).on('click', 'button#update,button#paid,button#delete', function (e) {
            e.preventDefault();
            $status_id = $(this).attr('data-status');
            if($status_id == 3){
                if(confirm('Are you sure to delete ?')){
                    $("input#status").val($status_id);
                    $("form.submit-cart").submit();
                }
            }else{
                $("input#status").val($status_id);
                $("form.submit-cart").submit();
            }
            
        }).on('change','select#courier_id', function(e){
            $('input.courier_id').val($(this).val());
        });
    });

</script>
@endsection