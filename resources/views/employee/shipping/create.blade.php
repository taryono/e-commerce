@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Pengiriman</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('shipping.store') }}">
                        {{ csrf_field() }} 
                        
                        <div class="form-group">
                            <label for="courier_id" class="col-md-3 control-label">Kurir</label>
                            <div class="col-md-7">
                                <select name="courier_id" class="form-control example-getting-started" id="courier_id">
                                    <option value="">-- Pilih Kurir --</option>
                                    @foreach($couriers as $s)
                                    <option value="{{$s->id}}"> {{$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="form-group{{ $errors->has('send_date') ? ' has-error' : '' }}">
                            <label for="send_date" class="col-md-3 control-label">Tanggal Kirim</label>

                            <div class="col-md-7">
                                <input id="send_date" type="date" class="form-control" name="send_date" value="{{ old('send_date') }}" required autofocus>
                                @if ($errors->has('send_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('send_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="list-cart"></div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$(function(){
    $("body").on('change','select#courier_id', function(e){
        $.post('{{route("shipping.listCart")}}',{courier_id:$(this).val()}, function(r){
             $("div.list-cart").html(r);
        });
    });
});
</script>
@endsection