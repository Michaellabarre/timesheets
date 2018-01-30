<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    
    <ul class="sidebar-menu" data-widget="tree">
      

      @if (!Auth::guest())

       <li class="{{ Menu::activeMenu('home') }}">
        <a href="/">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      
      <li class="treeview {{ Menu::activeMenu('timesheets') }}">
        <a href="#">
          <i class="fa fa-clock-o"></i>
          <span>Timesheets</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Menu::activeMenu('timesheets.index') }}"><a href="{{ route('timesheets.index') }}"><i class="fa fa-list"></i> All Timesheets</a></li>
          @can('create-timesheet')
          <li class="{{ Menu::activeMenu('timesheets.create') }}">
            <a href="{{ route('timesheets.create') }}"><i class="fa fa-plus"></i>Add Timesheet</a>
          </li>
          @endcan
        </ul>
      </li>

      <li class="treeview {{ Menu::activeMenu('reports.index') }}">
        <a href="#">
          <i class="fa fa-bar-chart"></i>
          <span>Reports</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ Menu::activeMenu('reports.index') }}"><a href="{{ route('reports.index') }}"><i class="fa fa-line-chart"></i> Generate Reports</a></li>
        </ul>
      </li>

      
      <li class="treeview {{ Menu::activeMenu(['users','clients', 'jobs', 'quotes', 'tasktypes']) }}">
        <a href="#">
          <i class="fa fa-lock"></i> <span>Admin</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

            {{-- Users --}}
            <li class="treeview {{ Menu::activeMenu('users') }}">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Menu::activeMenu('users.index') }}"><a href="{{ route('users.index') }}"><i class="fa fa-list"></i> All Users</a></li>
                  @can('create-user')
                  <li class="{{ Menu::activeMenu('users.create') }}">
                    <a href="{{ url('/register') }}"><i class="fa fa-plus"></i>Add User</a>
                  </li>
                  @endcan
              </ul>
            </li>
            {{-- End Users --}}

            {{-- Clients --}}
            <li class="treeview {{ Menu::activeMenu('clients') }}">
              <a href="#">
                <i class="fa fa-vcard"></i>
                <span>Clients</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Menu::activeMenu('clients.index') }}"><a href="{{ route('clients.index') }}"><i class="fa fa-list"></i> All Clients</a></li>
                @can('create-client')
                <li class="{{ Menu::activeMenu('clients.create') }}">
                  <a href="{{ route('clients.create') }}"><i class="fa fa-plus"></i>Add Client</a>
                </li>
                @endcan
              </ul>
            </li>
            {{-- End Clients --}}

            {{-- Jobs --}}
            <li class="treeview {{ Menu::activeMenu('jobs') }}">
              <a href="#">
                <i class="fa fa-briefcase"></i>
                <span>Jobs</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Menu::activeMenu('jobs.index') }}"><a href="{{ route('jobs.index') }}"><i class="fa fa-list"></i> All Jobs</a></li>
                  @can('create-job')
                  <li class="{{ Menu::activeMenu('jobs.create') }}">
                    <a href="{{ route('jobs.create') }}"><i class="fa fa-plus"></i>Add Job</a>
                  </li>
                  @endcan
              </ul>
            </li>
            {{-- End Jobs --}}

            {{-- Quotes --}}
            <li class="treeview {{ Menu::activeMenu('quotes') }}">
              <a href="#">
                <i class="fa fa-euro"></i>
                <span>Quotes</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Menu::activeMenu('quotes.index') }}"><a href="{{ route('quotes.index') }}"><i class="fa fa-list"></i> All Quotes</a></li>
                @can('create-quote')
                  <li class="{{ Menu::activeMenu('quotes.create') }}"><a href="{{ route('quotes.create') }}"><i class="fa fa-plus"></i>Add Quote</a></li> 
                @endcan
              </ul>
            </li>
            {{-- End Quotes --}}

            {{-- Tasktypes --}}
            <li class="treeview {{ Menu::activeMenu('tasktypes') }}">
              <a href="#">
                <i class="fa fa-tags"></i>
                <span>Task Types</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="{{ Menu::activeMenu('tasktypes.index') }}"><a href="{{ route('tasktypes.index') }}"><i class="fa fa-list"></i> All Task Types</a></li>
                  @can('create-job')
                  <li class="{{ Menu::activeMenu('tasktypes.create') }}">
                    <a href="{{ route('tasktypes.create') }}"><i class="fa fa-plus"></i>Add Tasktype</a>
                  </li>
                  @endcan
              </ul>
            </li>
            {{-- End Tasktypes --}}
        </ul>
      </li>

      @endif

      @if (Auth::guest())
          <li class="{{ Menu::activeMenu('login') }}">
            <a href="{{ route('login') }}">Login</a>
          </li>
      @endif

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>