@if($carts->count()>0)
<?php
$cart_ids = [];
if($shipping_details && $shipping_details->count() > 0){
    foreach($shipping_details as $detail){
        $cart_ids[$detail->cart_id] = $detail->cart_id;
    }    
}

?>

<div class="form-group"> 
    <label for="cart" class="col-md-3 control-label"><h4 style="font-weight: bold">List Belanja</h4></label>
    <div class="col-md-7">
        <table class="table table-striped table-check">
            <thead>
                <tr class="ordering"> 
                    <th width="10px">No</th> 
                    <th width="10px">Nama</th>   
                    <th width="10px">Tujuan</th>
                    <th width="10px">Pilih</th>  
                </tr> 
            </thead>
            <tbody> 
                @foreach($carts as $key => $c)
                <tr class="ordering">
                    <td width="10px">{{++$key}}</td>
                    <td width="10px">{{$c->user?$c->user->name:NULL}}</td>  
                    <td width="10px">{{$c->user?$c->to_province->name:NULL}}</td>
                    <td width="10px"><input class="checked_ids" type="checkbox" name="cart_ids[]" value="{{$c->id}}" {{(array_key_exists($c->id,$cart_ids))?'checked="checked"':''}}></td> 
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div> 
</div> 
<div class="form-group"> 
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary submit-shipping"  disabled="disabled">
            Submit
        </button>
        &nbsp; <button type="button" onclick="window.location.href ='{{route("shipping.index")}}'" class="btn btn-primary">
            Batal
        </button> 
    </div> 
</div>
@else
<div class="form-group"> 
    <label for="cart" class="col-md-3 control-label"></label>
    <div class="col-md-7"><h4>List Belanja Kosong...</h4></div>
</div>
@endif 
