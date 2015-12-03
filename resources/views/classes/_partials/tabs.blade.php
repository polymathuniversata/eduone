<ul class="nav nav-tabs">
	<li role="presentation" class="{{$request->tab === 'info' ? 'active' : '' }}"><a href='{!! url("/classes/$class->id/?tab=info") !!}' aria-controls="basic"><i class="glyphicon glyphicon-list-alt"></i> Basic Info</a></li>

	<li role="presentation" class="{{$request->tab === 'members' ? 'active' : '' }}"><a href='{!! url("/classes/$class->id") !!}?tab=members' aria-controls="members"><i class="fa fa-users"></i> Members 
	<span class="badge">{{$class->users_count}}</span>
    </a></li>
    
    @if ($class->users_count > 0)
    <li role="presentation" class="{{$request->tab === 'subjects' ? 'active' : '' }}"><a href='{!! url("/classes/$class->id") !!}?tab=subjects' aria-controls="subjects"><i class="fa fa-book"></i> Subjects
	<span class="badge">{{$class->subjects->count()}}</span>
    </a></li>
    @endif

	@if ($class->users_count > 0)
    <li role="presentation" class="{{$request->tab === 'schedules' ? 'active' : '' }}"><a href='{!! url("/classes/$class->id") !!}?tab=schedules' aria-controls="schedules"><i class="fa fa-calendar"></i> Schedules
    </a></li>
    @endif

</ul>