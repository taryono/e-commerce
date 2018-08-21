@extends('layouts.app') 
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/comments/css/jquery-comments.css') }}">
<!--link rel="stylesheet" media="screen" href="{{ asset('plugins/zoom/styles/styles.css') }}" type="text/css"-->
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('plugins/zoom/styles/zoomple.css') }}">
<style type="text/css">

</style>
@endsection
@section('content') 
<!--@@include('layouts.carousel') -->
<div class="container-fluid">  
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="jumbotron">
                    <h2>
                        Assalamu'alaikum wrwb,
                    </h2>
                    <p>
                        Selamat datang diwebsite kami
                    </p>
                    <p>
                        <a class="btn btn-primary btn-large" href="#">Selengkapnya</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid"> 
    <div class="container"> 
        <div class="row"> 
            <div class="col-md-6">
                <div id="wrapper">

                    <div class="section"> 
                        <a href="/uploads/<?= $craft->craft_image->path . '/' . $craft->craft_image->name ?>" class="zoomple">
                            <img src="/uploads/<?= $craft->craft_image->path . '/' . $craft->craft_image->name ?>" alt="" width="300px" height="300px"> </a>
                    </div>
                </div> 
                <h4>{{$craft->name}}</h4>
                <table class=" table table-bordered">
                    <tr>
                        <td width="100">Kategori</td>
                        <td>{{$craft->category?$craft->category->name:NULL}} </td>
                    </tr>
                    <tr>
                        <td width="100">Supplier</td>
                        <td>{{$craft->supplier?$craft->supplier->name:NULL}} </td>
                    </tr>
                    <tr>
                        <td width="100">Harga</td>
                        <td>{{$craft->craft_detail?rupiahFormat((int)$craft->craft_detail->price):NULL}} </td>
                    </tr>
                    <tr>
                        <td width="100">Stok</td>
                        <td><div id="stock">{{$craft->craft_detail?$craft->craft_detail->stock:NULL}}</div> </td>
                    </tr>
                    <tr>
                        <td width="100">Deskripsi</td>
                        <td><div id="stock">{{$craft?$craft->description:NULL}}</div> </td>
                    </tr>
                </table> 
                <div class="row"> 
                    <div class="col-md-6">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">Testimoni</a>
                            </li> 
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="home" class="container tab-pane active">
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="comments-container" style="padding-right: 30px;"></div>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div> 
            <div class="col-md-6">
                <h4>Untuk melanjutkan pembelian silahkan @if(!Auth::check()) <a href="{{route('login',['params'=> ['redirect'=> 'product.detail','param'=>$craft->id]])}}">login</a> dan @endif isi form berikut:</h4>
                <table class="table table-responsive">
                    <tr>
                        <td style="width: 150px">Jasa Pengiriman </td>
                        <td> 
                            <div class="form-group">  
                                <select name="supplier_id" class="form-control example-getting-started" style="width: 150px;">
                                    @foreach($couriers as $s)
                                    <option value="{{$s->id}}">{{ucfirst($s->name)}}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Pembelian</td>
                        <td> <div class="form-group form-inline">   
                                <button class="form-control" style="width: 20px; display: initial" id="min">-</button>
                                <input type="number" name="amount_changed" value="1" class="form-control amount_changed" style="width: 80px;  display: initial">
                                <button class="form-control" style="width: 20px;  display: initial" id="plus">+</button> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>{{$craft->craft_detail?$craft->craft_detail->stock:NULL}} </td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td> 
                            {{$craft->craft_detail?rupiahFormat((int)$craft->craft_detail->price):0}} </td>
                    </tr>
                    <!--tr>
                        <td>Biaya Kirim</td>
                        <td>{{rupiahFormat(10000)}} </td>
                    </tr-->
                    <tr>
                        <td></td>
                        <td><div class="form-group form-inline">
                                <div class="form-control amount_changed fix_amount" style="width: 20px; display: initial;">1</div>x
                                <div id="subtotal" class="form-control" style="width: 20px; display: initial">{{$craft->craft_detail?(int)$craft->craft_detail->price:NULL}}</div>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td nowrap="nowrap"><div id="subtotal_changed" style="width: 20px;">{{$craft->craft_detail?rupiahFormat((int)$craft->craft_detail->price):NULL}}</div></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>                       
                    </tr>
                </table>
                <?php $user_id = NULL; $is_logged_in = 0;?>
                @if(Auth::check())
                    <?php 
                    $user_id = Auth::user()->id;
                     $is_logged_in = 1;
                    ?> 
                @endif
                @if(Auth::check() && Auth::user()->hasRole('customer'))
                <table class="table table-responsive"> 
                    <caption><h4>Alamat Pengiriman</h4></caption>
                    <tr>
                        <td>Nama Depan:</td>   
                        <td>{{Auth::user()->user_detail->first_name}}</td>
                    </tr>
                    <tr>
                        <td>Nama Belakang:</td>   
                        <td>{{Auth::user()->user_detail->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Handphone</td>   
                        <td>{{Auth::user()->user_detail->cellphone}}</td>
                    </tr> 
                    <tr>
                        <td style="width: 150px">Tujuan </td>
                        <td> 
                            <div class="form-group">  
                                <select name="to_province_id" class="form-control example-getting-started to_province_id" style="width: 150px;">
                                    @foreach($provinces as $p)
                                    <option value="{{$p->id}}" data-km="{{$p->km}}">{{ucfirst($p->name)}}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px">Fee </td>
                        <td> 
                            <div class="fee">{{rupiahFormat(10000)}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>   
                        <td><textarea class="form-control" name="address" style="margin-left: none;padding-left: 0px">
                            {{trim(Auth::user()->user_detail->address)}}
                            </textarea>
                        </td>
                    </tr>
                </table>
                <hr style="height: 2px; width: 100%">
                @endif
                <div class="col-md-6">
                    <form class="form-horizontal" method="POST" action="{{ route('cart.store') }}">
                        {{csrf_field()}}
                        @if(Auth::check() && Auth::user()->hasRole('customer'))
                        <input id='user_id' type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        @endif
                        <input id='last_amount' type="hidden" name="amount" value="1">
                        <input id='to_province_id' type="hidden" name="to_province_id" value="1">
                        <input id='craft_id' type="hidden" name="craft_id" value="{{$craft->id}}">
                        <input id='price' type="hidden" name="price" value="{{$craft->craft_detail?(int)$craft->craft_detail->price:0}}">
                        <input id='subtotal' type="hidden" name="subtotal" value="{{$craft->craft_detail?(int)$craft->craft_detail->price:0}}"> 
                        @if(Auth::check() && Auth::user()->hasRole('customer'))
                        <div class="form-group">   
                            <button class="button btn-success form-control" id="pay">Tambahkan ke Keranjang Belanja</button>                        
                        </div>
                        @endif
                    </form>

                </div>
            </div> 
        </div> 
        <div class="row" style="margin-bottom: 300px;">
            <div class="col-md-6">
                <p><a class="btn btn-secondary" href="{{route('welcome')}}" role="button">Kembali << </a></p>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
</div>
@foreach($provinces as $p)
<input type="hidden" class="fees" id="{{$p->id}}" value="{{$p->km}}">
@endforeach
@endsection
@section('script') 
<script src="{{ asset('js/popper.min.js') }}"></script> 
<script src="{{ asset('js/jquery.textcomplete.js') }}"></script>  
<script src="{{ asset('plugins/comments/data/comments-data.js') }}"></script> 
<script src="{{ asset('plugins/comments/js/jquery-comments.min.js') }}"></script> 
<script src="{{ asset('plugins/zoom/zoomple.js') }}"></script> 
<script type='text/javascript'>
var price = $("input#price").val();
var stock = '{{$craft->craft_detail?(int)$craft->craft_detail->stock:0}}';
var fees = $("input.fees").val(); 
$(function () {

    $("input.amount_changed").bind('keyup mouseup', function () {
        $last_val = $(this).val();
        if ($(this).val() < 0) {
            $("input.amount_changed").val(1);
        } else if ($(this).val() == 0) {

        } else {
            if (parseInt($last_val) <= parseInt(stock)) {
                $("input.amount_changed").val($last_val);
                $("div.amount_changed").text($last_val);
                $("input#last_amount").val($last_val);
                $("div#subtotal_changed").text(app.rupiah($last_val * price));
                $("input#subtotal").val($last_val * price);
                $("input#last_amount").val($("div.fix_amount").text());
            } else {
                alert('Stok Terbatas');
                $("input.amount_changed").val(stock);
            }
        }
    });
    $("body").on('click', 'button#min', function () {
        $val = $("input.amount_changed").val();
        if ($val > 1) {
            $val = $val - 1;
            console.log($val)
            $("input.amount_changed").val($val);
            $("div.amount_changed").text($val);
            $subtotal = parseInt($("div.fix_amount").text() * parseInt(price));
            $("div#subtotal_changed").text(app.rupiah($subtotal));
            $("input#subtotal").val($subtotal);
            $("input#last_amount").val($("div.fix_amount").text());
        } else if ($val < 0) {
            $val = 1;
            $("input.amount_changed").val($val);
            $("div.amount_changed").text($val);
        } else {

        }
    }).on('click', 'button#plus', function () {
        $val = $("input.amount_changed").val();
        if (parseInt($val) < parseInt(stock)) {
            $val = parseInt($val) + parseInt(1);
            $("input.amount_changed").val($val);
            $("div.amount_changed").text($val);
            $subtotal = parseInt($("div.fix_amount").text() * parseInt(price));
            $("div#subtotal_changed").text(app.rupiah($subtotal));
            $("input#subtotal").val($subtotal);
            $("input#last_amount").val($("div.fix_amount").text());
        } else {
            console.log(parseInt($val) < parseInt(stock));
        }

    }).on('change','select.to_province_id', function(e){
        $("input#to_province_id").val($(this).val());
        $val = $(this).val();
        $fee = $("input.fees#" + $val).val();
        $("div.fee").text(app.rupiah(parseInt($fee) * 10000)); 
    });

    $('.zoomple').zoomple({
        blankURL: '/plugins/zoom/images/blank.gif',
        //bgColor: '#90D5D9',
        loaderURL: '/plugins/zoom/images/loader.gif',
        offset: {x: -150, y: -150},
        zoomWidth: 300,
        zoomHeight: 300,
        roundedCorners: true
    });

});

</script>
<!-- Init jquery-comments -->
<script type="text/javascript">
    $(function () {
        var craft_id = 1;
        var login = '{{$is_logged_in}}';
        var readOnly = true;
        if(login == 1){
            readOnly = false;
        }
        /*
         var saveComment = function (data) {
         // Convert pings to human readable format
         $(data.pings).each(function (index, id) {
         var user = usersArray.filter(function (user) {
         return user.id == id
         })[0];
         data.content = data.content.replace('@' + id, '@' + user.fullname);
         });
         
         return data;
         }*/
        $('#comments-container').comments({
            profilePictureURL: '/images/slide-2.jpeg',
            currentUserId: '{{$user_id}}',
            roundProfilePictures: true,
            textareaRows: 1,
            enableAttachments: true,
            enableHashtags: true,
            enablePinging: true,
            maxRepliesVisible: 3,
            enableReplying: true,
            currentUserIsAdmin: function (success, error) {
                /*$.get('{{url("comment/getUsers")}}', function (e) {
                        var userArray = e;
                        success(userArray)
                    }
                );*/
                success(true)
            },
            created_by_current_user: true,
            readOnly: readOnly,
            /*
             getUsers: function (success, error) {
             setTimeout(function () {
             success(usersArray);
             }, 500);
             }*/
            getUsers: function (success, error) {
                $.get('{{url("comment/getUsers")}}', function (e) {
                    var userArray = e;
                    success(userArray)
                }
                );
            },
            getComments: function (success, error) {
                $.ajax({
                    type: 'get',
                    url: '{{url("comment/list_comments", $craft->id)}}',
                    success: function (e) {
                        var commentsArray = e;
                        success(commentsArray)
                    },
                    error: error
                });
            }
            /* getComments: function (success, error) {
             setTimeout(function () {
             success(commentsArray);
             }, 500);
             }*/,
            /*
             postComment: function (data, success, error) {
             setTimeout(function () {
             success(saveComment(data));
             }, 500);
             }*/
            postComment: function (commentJSON, success, error) {
                $.ajax({
                    type: 'post',
                    url: '{{route("comment.store")}}',
                    data: {comment: commentJSON, craft_id: 1},
                    success: function (comment) {
                        success(comment)
                    },
                    error: error
                });
            },
            /*
             putComment: function (data, success, error) {
             setTimeout(function () {
             success(saveComment(data));
             }, 500);
             }*/
            putComment: function (commentJSON, success, error) {
                $.ajax({
                    type: 'PUT',
                    url: '{{route("comment.update", '+commentJSON.id+')}}',
                    data: commentJSON,
                    success: function (comment) {
                        success(comment)
                    },
                    error: error
                });
            },
            deleteComment: function (commentJSON, success, error) {
                $.ajax({
                    type: 'DELETE',
                    url: '/comment/' + commentJSON.id,
                    success: success,
                    error: error
                });
            },
            /*deleteComment: function (data, success, error) {
             setTimeout(function () {
             success();
             }, 500);
             }*/
            /*upvoteComment: function (data, success, error) {
             setTimeout(function () {
             success(data);
             }, 500);
             }*/
            upvoteComment: function (commentJSON, success, error) {
                var commentURL = '/comments/' + commentJSON.id;
                var upvotesURL = commentURL + '/upvotes/';

                if (commentJSON.userHasUpvoted) {
                    $.ajax({
                        type: 'post',
                        url: upvotesURL,
                        data: {
                            comment: commentJSON.id
                        },
                        success: function () {
                            success(commentJSON)
                        },
                        error: error
                    });
                } else {
                    $.ajax({
                        type: 'delete',
                        url: upvotesURL + upvoteId,
                        success: function () {
                            success(commentJSON)
                        },
                        error: error
                    });
                }
            },
            /*
             uploadAttachments: function (dataArray, success, error) {
             setTimeout(function () {
             success(dataArray);
             }, 500);
             },*/
            uploadAttachments: function (commentArray, success, error) {
                var responses = 0;
                var successfulUploads = [];

                var serverResponded = function () {
                    responses++;

                    // Check if all requests have finished
                    if (responses == commentArray.length) {

                        // Case: all failed
                        if (successfulUploads.length == 0) {
                            error();

                            // Case: some succeeded
                        } else {
                            success(successfulUploads)
                        }
                    }
                }

                $(commentArray).each(function (index, commentJSON) {

                    // Create form data
                    var formData = new FormData();
                    $(Object.keys(commentJSON)).each(function (index, key) {
                        var value = commentJSON[key];
                        if (value)
                            formData.append(key, value);
                    });

                    $.ajax({
                        url: '/comments/',
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (commentJSON) {
                            successfulUploads.push(commentJSON);
                            serverResponded();
                        },
                        error: function (data) {
                            serverResponded();
                        },
                    });
                });
            }
        });
    });
</script>
@endsection
