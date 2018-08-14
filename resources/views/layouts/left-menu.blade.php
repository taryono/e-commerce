 @if(Auth::user()->menus)
    @foreach(json_decode(Auth::user()->menus) as $menu) 
    @if($menu->nav_type == "top-left")
        <li><a href="{{ route($menu->route) }}">{{ucfirst($menu->name)}}</a></li>
    @endif 
    @endforeach
@endif 