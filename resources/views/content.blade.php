<div class="container marketing" style="padding-top: 10px;"> 
    <div class="row">
        <div class="col-md-12"> 
            <div class="jumbotron">
                <h2>
                    Assalamu'alaikum wrwb,
                </h2>
                <p>
                    {{$about->content}} 
                </p>
                <!--p>
                    <a class="btn btn-primary btn-large" href="#">Selengkapnya</a>
                </p-->
            </div>
        </div>
    </div>
</div>
<div class="container marketing search-content" style="padding-top: 10px;"> 
    <!-- Three columns of text below the carousel --> 
    @if($crafts->count() > 0) 
    @foreach($crafts->chunk(round(3)) as $chunks)
    <div class="row">
        @foreach($chunks as $craft) 
        <div class="col-lg-4"> 
            <img class="rounded-circle" src="/uploads/<?= $craft->craft_image->path . '/' . $craft->craft_image->name ?>" alt="Generic placeholder image" width="140" height="140">
            <h4>{{$craft->name}}</h4> 
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
