<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('home') }}">
            <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt"></i>
            Dashboard
        </a>
    </li>
    @can('user-list')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
                <i class="c-sidebar-nav-icon fas fa-fw fa-user-alt"></i>
                Users
            </a>
        </li>
    @endcan
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('clients.index') }}">
            <i class="c-sidebar-nav-icon fas fa-fw fa-address-card"></i>
            Clients
        </a>
    </li>
    @can('project-list')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('projects.index') }}">
            <i class="c-sidebar-nav-icon fas fa-fw fa-copy"></i>
            Projects
        </a>
    </li>
    @endcan
    @can('task-list')
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('tasks.index') }}">
            <i class="c-sidebar-nav-icon fas fa-fw fa-tasks"></i>
            Tasks
        </a>
    </li>
    @endcan

    @can('role-list')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('roles.index') }}">
                <i class="c-sidebar-nav-icon fas fa-fw fa-user-cog"></i>
                Roles
            </a>
        </li>
    @endcan
    <li class="c-sidebar-nav-divider"></li>
    <li class="c-sidebar-nav-item mt-auto"></li>
    <li class="c-sidebar-nav-item"><a href="#" class="c-sidebar-nav-link"
            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt"></i>
            Logout</a>
    </li>
</ul>
