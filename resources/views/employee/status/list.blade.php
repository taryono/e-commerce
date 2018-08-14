@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Status <div style="text-align: right">{!!getActions('status','create')?getActions('status','create'):NULL!!}</div></div>

                <div class="panel-body">
                    <table class="table table-striped table-check">
                        <thead>
                            <tr class="ordering"> 
                                <th width="10px">No</th>  
                                <th width="10px">Nama</th>  
                                <th width="10px">Aksi</th>  
                            </tr> 
                        </thead>
                        <tbody> 
                            @foreach($statutes as $key => $c)
                            <tr class="ordering">
                                <th width="10px">{{++$key}}</th>  
                                <th width="10px">{{$c->name}}</th>
                                <th width="10px">{!!getActions('status', 'edit',$c->id)?getActions('status', 'edit', $c->id):NULL!!}&nbsp;{!!getActions('status', 'destroy', $c->id)?getActions('status', 'destroy', $c->id):NULL!!}</th> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                    <div class="table-list-footer">
                        <span class="result-count">{{$statutes->links()}}</span> 
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div> 
@endsection
