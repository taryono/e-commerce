@if($shipping_details->count()>0)
<div class="form-group"> 
    <label for="cart" class="col-md-3 control-label"><h4>List Belanja</h4></label>
    <div class="col-md-7">
        <table class="table table-striped table-check">
            <thead>
                <tr class="ordering"> 
                    <th width="10px">No</th> 
                    <th width="10px">Nama</th>   
                    <th width="10px">Tujuan</th>  
                </tr> 
            </thead>
            <tbody> 
                @foreach($shipping_details as $key => $c)
                <tr class="ordering">
                    <th width="10px">{{++$key}}</th>
                    <th width="10px">{{$c->cart?$c->cart->user->name:NULL}}</th>  
                    <th width="10px">{{$c->cart?$c->cart->to_province->name:NULL}}</th>
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div> 
</div>
@endif 