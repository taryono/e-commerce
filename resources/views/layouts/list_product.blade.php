<!--@@include('layouts.carousel') -->
<div class="container-fluid"> 
    <div class="container">
        @if($products)
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3">
                <img alt="Bootstrap Image Preview" src="{{asset('images/harley (2).jpeg')}}" width="100" height="80" />
                <h2>
                    {{$product->name}}
                </h2>
                <p>
                    {{$product->description}}
                </p>
                <p>
                    <a class="btn" href="#">View details »</a>
                </p>
            </div>
            @endforeach
        </div>
        @else
        <div class="row"> 
            <div class="col-md-3"> 
                <h2>
                    Product Not Found
                </h2> 
            </div> 
        </div>
        
        @endif
    </div>
</div>