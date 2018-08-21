 @foreach(groups() as $key => $group) 
    
    @if($group) 
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ ucfirst($group->name) }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                @foreach(groupMenu($group->id) as $menu)  
                    @if($menu->nav_type == "top-right" && $menu->type == "index") 
                        @if($menu->group_menu_id && $menu->group_menu_id == $group->id)
                        <li><a href="{{ route($menu->route) }}">{{($menu->controller && $menu->controller->text)?ucfirst($menu->controller->text):ucfirst($menu->name)}}</a></li>
                        @endif
                    @endif 
                @endforeach 
            </ul>
        </li>  
    @endif
@endforeach