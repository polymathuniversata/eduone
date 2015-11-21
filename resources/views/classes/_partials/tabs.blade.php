<ul class="nav nav-tabs">
    <li role="presentation" class="{{$active === 1 ? 'active' : '' }}"><a href='{!! url("/classes/$class->id") !!}' aria-controls="basic"><i class="glyphicon glyphicon-list-alt"></i> Basic Info</a></li>
    <li role="presentation" class="{{$active === 2 ? 'active' : '' }}"><a href='{!! url("/classes/$class->id") !!}/members' aria-controls="members"><i class="fa fa-users"></i> Members 
	<span class="badge">{{$class->users_count}}</span>
    </a></li>
    <li role="presentation" class="{{$active === 3 ? 'active' : '' }}"><a href='{!! url("/classes/$class->id") !!}/subjects' aria-controls="subjects"><i class="fa fa-book"></i> Subjects
	<span class="badge">{{$class->subjects->count()}}</span>
    </a></li>
</ul>