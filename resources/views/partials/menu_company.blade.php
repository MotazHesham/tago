<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            @if($company = auth()->user()->company_owner)
                {{ $company->company_name }}
            @else
                {{ trans('panel.site_title') }}
            @endif
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("company.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        
        <li class="c-sidebar-nav-item">
            <a href="{{ route("company.customers.index") }}" class="c-sidebar-nav-link {{ request()->is("company/customers") || request()->is("company/customers/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                </i>
                الموظفين
            </a>
        </li>  
        <li class="c-sidebar-nav-item">
            <a href="{{ route("company.customers.edit_all_users") }}" class="c-sidebar-nav-link {{ request()->is("company/edit_all_users") || request()->is("company/edit_all_users/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-edit c-sidebar-nav-icon">

                </i>
                تعديل البيانات
            </a>
        </li>   
        <li class="c-sidebar-nav-item">
            <a href="{{ route("company.user-links.edit_all_links") }}" class="c-sidebar-nav-link {{ request()->is("company/edit_all_links") || request()->is("company/edit_all_links/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-link c-sidebar-nav-icon">

                </i>
                تعديل الروابط
            </a>
        </li>   
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ request()->is('company.profile/password') || request()->is('company.profile/password/*') ? 'c-active' : '' }}" href="{{ route('company.profile.password.edit') }}">
                <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                </i>
                {{ trans('global.change_password') }}
            </a>
        </li>  
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>