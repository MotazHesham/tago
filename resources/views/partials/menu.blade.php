<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/user-links*") ? "c-show" : "" }} {{ request()->is("admin/user-alerts*") ? "c-show" : "" }} {{ request()->is("admin/connections*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items"> 
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan 
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan 
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.customers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/customers") || request()->is("admin/customers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    العملاء
                </a>
            </li>
        @endcan 
        @can('product_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/products*") ? "c-show" : "" }} {{ request()->is("admin/orders*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-box c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.product.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-gift c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.order.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_question_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqQuestion.title') }}
                </a>
            </li>
        @endcan
        @can('menu_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/menu-themes*") ? "c-show" : "" }} {{ request()->is("admin/menu-packages*") ? "c-show" : "" }} {{ request()->is("admin/menu-clients*") ? "c-show" : "" }} {{ request()->is("admin/menu-client-packages*") ? "c-show" : "" }} {{ request()->is("admin/menu-client-lists*") ? "c-show" : "" }} {{ request()->is("admin/menu-categories*") ? "c-show" : "" }} {{ request()->is("admin/menu-products*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-utensils c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.menuManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('menu_theme_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.menu-themes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu-themes") || request()->is("admin/menu-themes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-paint-brush c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.menuTheme.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('menu_package_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.menu-packages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu-packages") || request()->is("admin/menu-packages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cubes c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.menuPackage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('menu_client_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.menu-clients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu-clients") || request()->is("admin/menu-clients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-tie c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.menuClient.title') }}
                            </a>
                        </li>
                    @endcan
                    {{-- @can('menu_client_package_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.menu-client-packages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu-client-packages") || request()->is("admin/menu-client-packages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cube c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.menuClientPackage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('menu_client_list_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.menu-client-lists.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu-client-lists") || request()->is("admin/menu-client-lists/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-list-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.menuClientList.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('menu_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.menu-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu-categories") || request()->is("admin/menu-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.menuCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('menu_product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.menu-products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/menu-products") || request()->is("admin/menu-products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-product-hunt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.menuProduct.title') }}
                            </a>
                        </li>
                    @endcan --}}
                </ul>
            </li>
        @endcan
        @can('templates_mangment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/templates*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.templatesMangment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('template_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.templates.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/templates") || request()->is("admin/templates/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-images c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.template.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('general_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/link-categories*") ? "c-show" : "" }} {{ request()->is("admin/main-links*") ? "c-show" : "" }} {{ request()->is("admin/reviews*") ? "c-show" : "" }} {{ request()->is("admin/settings*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.generalSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('link_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.link-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/link-categories") || request()->is("admin/link-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-braille c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.linkCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('main_link_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.main-links.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/main-links") || request()->is("admin/main-links/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-link c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.mainLink.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('review_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reviews.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reviews") || request()->is("admin/reviews/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-star-half-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.review.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('setting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.setting.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe-africa c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tutorial_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tutorials.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tutorials") || request()->is("admin/tutorials/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-youtube c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tutorial.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('subscribe_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.subscribes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/subscribes") || request()->is("admin/subscribes/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-envelope c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.subscribe.title') }}
                </a>
            </li>
        @endcan
        @can('contactu_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.contactus.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contactus") || request()->is("admin/contactus/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contactu.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>