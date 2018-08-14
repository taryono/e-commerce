@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Charge <div style="text-align: right">{!!getActions('charge','create')?getActions('charge','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th> 
                                <th width="10px">From</th> 
                                <th width="10px">To</th>  
                                <th width="10px">Fee</th>  
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($charges as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>
                                <th width="10px">{{$c->from_province->name}}</th>  
                                <th width="10px">{{$c->to_province->name}}</th>
                                <th width="10px">{{$c->amount}}</th>
                                <th width="10px">{!!getActions('charge', 'edit',$c->id)?getActions('charge', 'edit', $c->id):NULL!!}&nbsp;{!!getActions('charge', 'destroy', $c->id)?getActions('charge', 'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$charges->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
