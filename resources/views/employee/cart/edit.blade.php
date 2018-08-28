@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Keranjang Belanja</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('cart.update', $cart->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" class="form-control" name="_method" value="PUT">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama</label> 
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{ $cart->user->user_detail->first_name }} {{ $cart->user->user_detail->last_name }}" disabled>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('to_province_id') ? ' has-error' : '' }}">
                            <label for="to_province_id" class="col-md-4 control-label">Tujuan</label> 
                            <div class="col-md-6">
                                <input id="to_province_id" type="text" class="form-control" name="to_province_id" value="{{ $cart->to_province->name }}" disabled>

                                @if ($errors->has('to_province_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('to_province_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('subtotal') ? ' has-error' : '' }}">
                            <label for="subtotal" class="col-md-4 control-label">Subtotal</label> 
                            <div class="col-md-6">
                                <input id="subtotal" type="text" class="form-control" name="subtotal" value="{{ rupiahFormat($cart->subtotal) }}" disabled>

                                @if ($errors->has('subtotal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subtotal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                            <label for="total" class="col-md-4 control-label">Total</label> 
                            <div class="col-md-6">
                                <input id="total" type="text" class="form-control" name="total" value="{{ rupiahFormat($cart->total) }}" disabled>

                                @if ($errors->has('total'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('total') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('fee') ? ' has-error' : '' }}">
                            <label for="fee" class="col-md-4 control-label">Fee</label> 
                            <div class="col-md-6">
                                <input id="fee" type="text" class="form-control" name="fee" value="{{ rupiahFormat($cart->fee) }}" disabled>

                                @if ($errors->has('fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('courier_id') ? ' has-error' : '' }}">
                            <label for="courier_id" class="col-md-4 control-label">Jasa Pengiriman</label> 
                            <div class="col-md-6"> 
                                <select id="courier_id" name="courier_id" class="form-control example-getting-started">
                                    @foreach($couriers as $s)
                                    <option value="{{$s->id}}">{{ucfirst($s->name)}}</option>
                                    @endforeach
                                </select> 
                            </div> 
                        </div>
                        <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                            <label for="status_id" class="col-md-4 control-label">Status Pembayaran</label> 
                            <div class="col-md-6">
                                
                                <select name="status_id" class="form-control">
                                    <option value="1">Belum Bayar</option>
                                    <option value="2">Lunas</option>
                                </select>
                                @if ($errors->has('status_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('payment_date') ? ' has-error' : '' }}">
                            <label for="payment_date" class="col-md-4 control-label">Tanggal Pembayaran</label> 
                            <div class="col-md-6">
                                <input id="payment_date" type="date" class="form-control datepicker" name="payment_date" value="{{ $cart->payment_date }}">

                                @if ($errors->has('payment_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('payment_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                &nbsp; <button type="button" onclick="window.location.href='{{route("cart.index")}}'" class="btn btn-primary">
                                    Batal
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
