<div class="form-group">  
    <div class="col-md-8">
        <table class="table table-striped table-check">
            <thead>
                <tr class="ordering"> 
                    <th>No</th> 
                    <th>Nama</th>   
                    <th>Tujuan</th>
                    <th>Status</th> 
                </tr> 
            </thead>
            <tbody> 
                @foreach($shipping_details as $key => $d)
                <tr class="ordering">
                    <td  width="10px">{{++$key}}</td>
                    <td>{{$d->cart->user?$d->cart->user->name:NULL}}</td>  
                    <td>{{$d->cart->user?$d->cart->to_province->name:NULL}}</td>
                    <td>{{$d->status?$d->status->name:"Belum Terkirim"}}</td> 
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div> 
</div>    