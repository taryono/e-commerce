@extends('layouts.app') 
@section('styles')  
<link rel="stylesheet" href="{{ asset('plugins/editable/bootstrap3-editable/css/bootstrap-editable.css')}}"> 
@stop
@section('content')
<div class="container-fluid">  
    <div class="row">
        <div class="col-md-12"> 
            <div class="jumbotron">
                <h2>
                    Assalamu'alaikum wrwb,
                </h2>
                
                <p>
                    @if(Auth::check() && Auth::user()->hasRole('administrator'))
                    <a href="#" id="content" data-name="content" data-type="textarea" data-pk="{{$about->id}}" data-url="{{route('about.update', $about->id)}}" data-title="Content">{{$about->content}}</a>
                    @else 
                        {!!$about->content!!} 
                    @endif
                    
                </p> 
            </div>
        </div>
    </div>
</div>

@section('script')
 <script src="{{ asset('plugins/editable/bootstrap3-editable/js/bootstrap-editable.min.js')}}" type="text/javascript"></script>
    <script>
            $(function(){
                $.fn.editable.defaults.mode = 'inline';
                $.fn.editable.defaults.ajaxOptions = {type: "PUT"};
                $("a#content").editable();
            });
        </script>
@endsection       
@endsection