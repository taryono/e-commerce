@if($carts->count()>0)
<div class="form-group"> 
    <label for="cart" class="col-md-3 control-label"><h4>List Belanja</h4></label>
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
                    <th width="10px">{{++$key}}</th>
                    <th width="10px">{{$c->user?$c->user->name:NULL}}</th>  
                    <th width="10px">{{$c->user?$c->to_province->name:NULL}}</th>
                    <th width="10px"><input type="checkbox" name="cart_ids[]" value="{{$c->id}}"></th> 
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div> 
</div> 
<div class="form-group"> 
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
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