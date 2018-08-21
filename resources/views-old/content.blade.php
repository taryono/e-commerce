<div class="container marketing" style="padding-top: 10px;"> 
    <div class="row">
        <div class="col-md-12"> 
            <div class="jumbotron"> 
                <p>
                    Promo Setiap Hari
                </p> 
            </div>
        </div>
    </div>
</div>
<div class="container marketing" style="padding-top: 10px;"> 
    <!-- Three columns of text below the carousel --> 
    @if($crafts->count() > 0) 
       @foreach($crafts->chunk(round(3)) as $chunks)
       <div class="row">
        @foreach($chunks as $craft) 
			<div class="col-lg-4"> 
				<img class="rounded-circle" src="/uploads/<?=$craft->craft_image->path.'/'.$craft->craft_image->name ?>" alt="Generic placeholder image" width="140" height="140">
				<h4>{{$craft->name}}</h4>
				<table class="table table-striped">
					<tr class="table-success">
						<th width="100">Kategori</th>
						<th>{{$craft->category?$craft->category->name:NULL}} </th>
					</tr>
					<tr>
						<td width="100">Supplier</td>
						<td>{{$craft->supplier?$craft->supplier->name:NULL}} </td>
					</tr>
					<tr>
						<td width="100">Harga</td>
						<td>{{$craft->craft_detail?rupiahFormat($craft->craft_detail->price):NULL}} </td>
					</tr>
					<tr>
						<td width="100">Stok</td>
						<td>{{$craft->craft_detail?$craft->craft_detail->stock:NULL}} PCS</td>
					</tr>
				</table>
				<p><a class="btn btn-secondary" href="{{route('product.detail',$craft->id)}}" role="button">Lihat Detail »</a></p>
			</div> 
            @endforeach
        </div><!-- /.row -->
        @endforeach
    @else
    <div class="row"> 
        <div class="col-lg-12">
            Produk tidak ditemukan...
        </div>   
    </div>
    <p><a class="btn btn-secondary" href="{{route('product.index')}}" role="button">Kembali << </a></p>
    @endif
    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

</div><!-- /.container --> 