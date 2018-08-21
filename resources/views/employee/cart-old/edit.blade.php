@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Cart</div> 
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('cart.update', $cart->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                         
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button> 
                                &nbsp;
                                <button type="button" class="btn btn-primary" onclick="window.location.href = '{{route("craft.index")}}'">
                                    Cancel
                                </button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
