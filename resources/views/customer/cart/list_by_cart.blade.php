<table class="table table-striped">
    <thead class="thead-dark">
        <tr class="ordering"> 
            <th>No</th>     
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Jumlah Barang</th>
            <th>Subtotal</th>
            <th>Tanggal Pembayaran</th>
            <th>Aksi</th>
        </tr> 
    </thead>
    <tbody> 
        @foreach($cart_details as $key => $c)
        <tr class="ordering">
            <th>{{++$key}}</th>  
            <th>{{$c->craft->name}}</th> 
            <th>{{rupiahFormat($c->price)}}</th> 
            <th>{{$c->amount}}</th> 
            <th>{{rupiahFormat($c->subtotal)}}</th>
            <th>{{($c->cart->payment_date)?date('d-m-Y H:i:s', strtotime($c->cart->payment_date)):'NULL'}}</th> 
            <th>
                @if($c->status_id != 2)
                <a href="{{route("cart.update_cart",$c->id)}}">Edit</a>&nbsp;<a href="{{route("cart.delete_cart",$c->id)}}" class="delete">Hapus</a>
                @endif
            </th> 
        </tr>
        @endforeach
    </tbody>
</table> 