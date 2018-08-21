@extends('layouts.app')
 
@section('content')
<div class="container">
    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Role : {{$role->name}}</div>
                    <div class="alert alert-success">Untuk Mengubah Hak Akses User Berdasarkan Role</div>
                    <div class="panel-body">
                        <table class="table table-striped table-check">
                            <thead>
                                <tr class="ordering"> 
                                    <th width="10px">No</th>
                                    <th width="10px">Route</th> 
                                    <th width="10px">Url</th> 
                                    <th width="10px">Title</th> 
                                    <th width="10px">Aksi</th>
                                </tr> 
                            </thead>
                            <tbody> 
                                <tr class="ordering"> 
                                    <th colspan="4"></th>
                                    <td width="10px">List | View | Create | Edit | Delete</td>  
                                </tr>
                                @foreach($menus as $key => $m)
                                <tr class="ordering">
                                    <th width="10px">{{++$key}}</th>
                                    <th width="10px"><a href="">{{$m->name}}</a></th>
                                     <th width="10px">{{$m->route}}</th>  
                                    <th width="10px">{{$m->title}}</th>
                                    <th><input name="index" data-field="index" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'index')}}>
                                        <input name="show" data-field="show" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'show')}}>
                                        <input name="create" data-field="create" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'create')}}>
                                        <input name="edit" data-field="edit" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'edit')}}>
                                        <input name="destroy" data-field="destroy" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'destroy')}}>
                                    </th> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table> 
                        <div class="table-list-footer">
                            <span class="result-count">{{$menus->links()}}</span> 
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
@endsection
 
@section('script')
<script src="{{ asset('js/bootstrap-switch.js') }}"></script> 
<script>
$("[name='index'],[name='show'],[name='create'],[name='edit'],[name='destroy']").bootstrapSwitch({
  on: 'On',
  off: 'Off ',
  onLabel: '&nbsp;&nbsp;&nbsp;',
  offLabel: '&nbsp;&nbsp;&nbsp;',
  same: false,//same labels for on/off states
  size: 'xs',
  onClass: 'primary',
  offClass: 'default'
});

$("[name='index'],[name='show'],[name='create'],[name='edit'],[name='destroy']").change(function() { 
    if($(this).is(':checked')) {
      var status = 1;
    } else {
      var status = 0;
    }
    console.log(status, $(this).data('role_id'),$(this).data('menu_id'));
    $.post('/acl/'+$(this).data('role_id'), {_token: '{{csrf_token()}}', role_id: $(this).data('role_id'), menu_id: $(this).data('menu_id'), status:status, field:$(this).data('field'),_method:'PUT'}, function (response) {
        console.log(response);
    });

});

</script>
@endsection