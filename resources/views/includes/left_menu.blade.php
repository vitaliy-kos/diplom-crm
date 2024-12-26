<div class="iq-sidebar sidebar-default">

    <div class="iq-sidebar-logo d-flex align-items-end justify-content-center">

        <a href="/" class="header-logo">
            <img src="/assets/images/develop.svg"
                 class="img-fluid rounded-normal light-logo" alt="logo">
            <img src="/assets/images/develop.svg"
                 class="img-fluid rounded-normal d-none sidebar-light-img" alt="logo">
            <span>CRM</span>
        </a>

        <div class="side-menu-bt-sidebar-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-light wrapper-menu" width="30" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>

    </div>

    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="side-menu">

                <!-- Рабочий стол -->
                <li class="pt-3 pb-2 {{ Route::is('crm.index') ? 'active' : '' }}">
                    <a href="{{ route('crm.index') }}" class="svg-icon">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </i>
                        <span class="text-uppercase small font-weight-bold">Рабочий стол</span>
                        <p class="mb-0 w-10 badge badge-pill badge-primary">0</p>
                    </a>
                </li>

                <!-- Заказы -->
                <li class="pb-2">

                    <a href="#orders" class="svg-icon collapsed" data-toggle="collapse" aria-expanded="true">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/>
                            </svg>
                        </i>
                        <span class="text-uppercase small font-weight-bold">Заказы</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active"
                             width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <ul id="orders" class="submenu collapse show">

                        <li class="sidebar-layout {{ Route::is('crm.order.index') && Route::getCurrentRoute()->parameter('filter') == '' ? 'active' : '' }}">
                            <a href="{{ route('crm.order.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </i>
                                <span class="ml-2">Все заказы</span>
                            </a>
                        </li>

                        @foreach ($statuses as $menu_status)
                            <li class="sidebar-layout {{ Route::is('crm.order.index') && Route::getCurrentRoute()->parameter('filter') == $menu_status['id'] ? 'active' : '' }}">
                                <a href="{{ route('crm.order.index', $menu_status['id']) }}" class="svg-icon">
                                    <i class="">
                                        {!! $menu_status['icon'] !!}
                                    </i>
                                    <span class="ml-2">{{ $menu_status['menu_name'] }}</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="sidebar-layout {{ Route::is('crm.order.create') ? 'active' : '' }}">
                            <a href="{{ route('crm.order.create') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                                    </svg>
                                </i>
                                <span class="ml-2">Создать заказ</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="pb-2">

                    <a href="#finance" class="svg-icon collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                        </i>
                        <span class="text-uppercase small font-weight-bold">Финансы</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active"
                             width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <ul id="finance" class="submenu collapse">

{{--                        <li class="sidebar-layout {{ Route::is('city.*') ? 'active' : '' }}">--}}
{{--                            <a href="/admin-sale?section=incomes&filter=all" class="svg-icon">--}}
{{--                                <i class="">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                              d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>--}}
{{--                                    </svg>--}}
{{--                                </i><span class="ml-2">Приходы ЗАКАЗЫ</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

                        <li class="sidebar-layout {{ Route::is('crm.income.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.income.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>
                                    </svg>
                                </i><span class="ml-2">Приходы ПРОЧИЕ</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.expense.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.expense.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181"/>
                                    </svg>
                                </i><span class="ml-2">Расходы ПРОЧИЕ</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Статистика и вынести в финансы -->
{{--                <li class="pb-2">--}}

{{--                    <a href="#analitics" class="svg-icon collapsed" data-toggle="collapse" aria-expanded="false">--}}
{{--                        <i class="">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                      d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>--}}
{{--                            </svg>--}}
{{--                        </i>--}}
{{--                        <span class="text-uppercase small font-weight-bold">Аналитика</span>--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active"--}}
{{--                             width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M9 5l7 7-7 7"></path>--}}
{{--                        </svg>--}}
{{--                    </a>--}}

{{--                    <ul id="analitics" class="submenu collapse">--}}

{{--                        <li class="sidebar-layout {{ Route::is('city.*') ? 'active' : '' }}">--}}
{{--                            <a href="/admin-sale?section=stat_daily&filter=all" class="svg-icon">--}}
{{--                                <i class="">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                              d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z"/>--}}
{{--                                    </svg>--}}
{{--                                </i><span class="ml-2">По дням</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="sidebar-layout {{ Route::is('city.*') ? 'active' : '' }}">--}}
{{--                            <a href="/admin-sale?section=stat_month&filter=all" class="svg-icon">--}}
{{--                                <i class="">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                              d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z"/>--}}
{{--                                    </svg>--}}
{{--                                </i><span class="ml-2">По месяцам</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}

                <!-- Клиенты -->
                <li class="pb-2">

                    <a href="#clients" class="svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </i>
                        <span class="text-uppercase small font-weight-bold">Клиенты</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active"
                                width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <ul id="clients" class="submenu collapse">
                        
                        <li class="sidebar-layout {{ Route::is('crm.client.index') && !Route::getCurrentRoute()->parameter('filter') ? 'active' : '' }}">
                            <a href="{{ route('crm.client.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                    </svg>
                                </i>
                                <span class="ml-2">Активные</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.client.index') && Route::getCurrentRoute()->parameter('filter') == 'spam' ? 'active' : '' }}">
                            <a href="{{ route('crm.client.index', 'spam') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                </i>
                                <span class="ml-2">Спам</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.client.create') ? 'active' : '' }}">
                            <a href="{{ route('crm.client.create') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"/>
                                    </svg>
                                </i>
                                <span class="ml-2">Создать</span>
                            </a>
                        </li>

                    </ul>
                </li>



                <!-- Обращения -->
                <li class="pb-2">

                <a href="#requests" class="svg-icon collapsed" data-toggle="collapse" aria-expanded="false">
                    <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                        </svg>
                    </i>
                    <span class="text-uppercase small font-weight-bold">Обращения</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active" width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <ul id="requests" class="submenu collapse">

                        <li class="sidebar-layout {{ Route::is('crm.clientRequest.index') && !Route::getCurrentRoute()->parameter('filter') ? 'active' : '' }}">
                            <a href="{{ route('crm.clientRequest.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                                    </svg>
                                </i>
                                <span class="ml-2">Все обращения</span>
                            </a>
                        </li>
                        <li class="sidebar-layout {{ Route::is('crm.clientRequest.index') && Route::getCurrentRoute()->parameter('filter') == 'call' ? 'active' : '' }}">
                            <a href="{{ route('crm.clientRequest.index', 'call') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 00-.38 1.21 12.035 12.035 0 007.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 011.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 01-2.25 2.25h-2.25z"/>
                                    </svg>
                                </i>
                                <span class="ml-2">Звонки</span>
                            </a>
                        </li>
                        <li class="sidebar-layout {{ Route::is('crm.clientRequest.index') && Route::getCurrentRoute()->parameter('filter') == 'text' ? 'active' : '' }}">
                            <a href="{{ route('crm.clientRequest.index', 'text') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                                    </svg>
                                </i>
                                <span class="ml-2">Текстовые заявки</span>
                            </a>
                        </li>
                           
                    </ul>
                </li>

                <!-- Параметры системы -->
                <li class="pb-2">

                    <a href="#data" class="svg-icon collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/>
                            </svg>
                        </i>
                        <span class="text-uppercase small font-weight-bold">Параметры системы</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active"
                             width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <ul id="data" class="submenu collapse">

                        <li class="sidebar-layout {{ Route::is('crm.service.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.service.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"/>
                                    </svg>
                                </i><span class="ml-2">Услуги</span>
                            </a>
                        </li>

                        <!-- <li class="sidebar-layout {{ Route::is('crm.status.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.status.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/>
                                    </svg>
                                </i><span class="ml-2">Статусы заказов</span>
                            </a>
                        </li> -->

                        <li class="sidebar-layout {{ Route::is('crm.city.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.city.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                                    </svg>
                                </i><span class="ml-2">Города</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.brand.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.brand.index') }}" class="svg-icon">
                                <i class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 18V8.5C4 7.30653 4.47411 6.16193 5.31802 5.31802C6.16193 4.47411 7.30653 4 8.5 4H15.5C16.0909 4 16.6761 4.1164 17.2221 4.34254C17.768 4.56869 18.2641 4.90016 18.682 5.31802C19.0998 5.73588 19.4313 6.23196 19.6575 6.77792C19.8836 7.32389 20 7.90905 20 8.5V15.5C20 16.0909 19.8836 16.6761 19.6575 17.2221C19.4313 17.768 19.0998 18.2641 18.682 18.682C18.2641 19.0998 17.768 19.4313 17.2221 19.6575C16.6761 19.8836 16.0909 20 15.5 20H6C5.46957 20 4.96086 19.7893 4.58579 19.4142C4.21071 19.0391 4 18.5304 4 18Z" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8 12H11.5C12.0304 12 12.5391 12.2107 12.9142 12.5858C13.2893 12.9609 13.5 13.4696 13.5 14C13.5 14.5304 13.2893 15.0391 12.9142 15.4142C12.5391 15.7893 12.0304 16 11.5 16H8V9C8 8.73478 8.10536 8.48043 8.29289 8.29289C8.48043 8.10536 8.73478 8 9 8H10.5C11.0304 8 11.5391 8.21071 11.9142 8.58579C12.2893 8.96086 12.5 9.46957 12.5 10C12.5 10.5304 12.2893 11.0391 11.9142 11.4142C11.5391 11.7893 11.0304 12 10.5 12H9M16 16H16.01" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </i><span class="ml-2">Бренды</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.expenseType.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.expenseType.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181"/>
                                    </svg>
                                </i><span class="ml-2">Типы расходов</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.incomeType.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.incomeType.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/>
                                    </svg>
                                </i><span class="ml-2">Типы приходов</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.site.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.site.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                    </svg>
                                </i><span class="ml-2">Сайты</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.phone.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.phone.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                    </svg>
                                </i><span class="ml-2">Номера телефонов</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.technicsType.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.technicsType.index') }}" class="svg-icon">
                                <i class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.83 11.17C15.5787 11.9216 15.999 12.9392 15.999 14C15.999 15.0608 15.5787 16.0784 14.83 16.83C14.0784 17.5787 13.0608 17.999 12 17.999C10.9392 17.999 9.92157 17.5787 9.17 16.83L14.83 11.17ZM6 2H18C18.5304 2 19.0391 2.21071 19.4142 2.58579C19.7893 2.96086 20 3.46957 20 4V20C20 20.5304 19.7893 21.0391 19.4142 21.4142C19.0391 21.7893 18.5304 22 18 22H6C5.46957 22 4.96086 21.7893 4.58579 21.4142C4.21071 21.0391 4 20.5304 4 20V4C4 3.46957 4.21071 2.96086 4.58579 2.58579C4.96086 2.21071 5.46957 2 6 2ZM7 4C6.73478 4 6.48043 4.10536 6.29289 4.29289C6.10536 4.48043 6 4.73478 6 5C6 5.26522 6.10536 5.51957 6.29289 5.70711C6.48043 5.89464 6.73478 6 7 6C7.26522 6 7.51957 5.89464 7.70711 5.70711C7.89464 5.51957 8 5.26522 8 5C8 4.73478 7.89464 4.48043 7.70711 4.29289C7.51957 4.10536 7.26522 4 7 4ZM10 4C9.73478 4 9.48043 4.10536 9.29289 4.29289C9.10536 4.48043 9 4.73478 9 5C9 5.26522 9.10536 5.51957 9.29289 5.70711C9.48043 5.89464 9.73478 6 10 6C10.2652 6 10.5196 5.89464 10.7071 5.70711C10.8946 5.51957 11 5.26522 11 5C11 4.73478 10.8946 4.48043 10.7071 4.29289C10.5196 4.10536 10.2652 4 10 4ZM12 8C10.4087 8 8.88258 8.63214 7.75736 9.75736C6.63214 10.8826 6 12.4087 6 14C6 15.5913 6.63214 17.1174 7.75736 18.2426C8.88258 19.3679 10.4087 20 12 20C13.5913 20 15.1174 19.3679 16.2426 18.2426C17.3679 17.1174 18 15.5913 18 14C18 12.4087 17.3679 10.8826 16.2426 9.75736C15.1174 8.63214 13.5913 8 12 8Z"/>
                                    </svg>
                                </i><span class="ml-2">Типы техники</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.brokenType.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.brokenType.index') }}" class="svg-icon">
                                <i class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_8958_2)">
                                            <path d="M7.34892 0.761627L8.37229 7.74619L4.47393 4.07831L6.39328 9.972L2.88867 9.6473L4.73226 12.84H8.10117L7.56154 11.0246L8.8799 11.7387L8.93475 9.43135L11.0224 11.8486L11.6817 8.16797L12.5057 11.0245L15.1975 9.15675L14.3735 11.9035L16.9554 10.8598L15.5064 12.8401H19.2955L21.0379 9.88092L18.6351 10.2018L19.599 6.21703L16.2769 8.50946L18.5442 3.26686L14.0794 5.67966L13.5044 0.949596L11.0868 5.86224L9.56193 1.76021L8.69395 2.61239L7.34897 0.761674L7.34892 0.761627ZM10.0316 12.9308L7.77857 14.5664L8.73858 15.8567L2.78362 16.6406L3.17831 19.7591L3.15459 19.8992L0.900513 20.8426V23.0484H2.51395L4.72176 20.8825L3.84623 17.3843L6.01856 17.0983L6.17597 19.6733L6.25495 19.7085L8.11518 21.2467L7.26595 23.0484H9.80587L10.0781 20.2633L7.01475 19.0357L6.88945 16.9836L10.3315 16.5305L9.01045 14.7546L11.5226 12.9307H10.0315L10.0316 12.9308ZM12.8499 12.9308L15.1806 15.6701L11.6823 17.3393L11.4782 17.3497L13.9432 20.2998L12.5011 23.0484H15.8776L15.7691 19.6077L13.2553 17.5594L16.0072 16.2462L19.4486 17.0554L17.3332 20.4404L19.2552 23.0237L19.2641 23.0484H22.5377L18.8576 20.4646L19.5349 18.7949L23.1846 20.2363V18.6142L19.9532 17.901L20.8397 16.4825L16.0675 15.3606L14.0002 12.9308H12.8498L12.8499 12.9308Z"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_8958_2">
                                                <rect width="24" height="24" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </i><span class="ml-2">Виды поломок</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.sparePart.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.sparePart.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-2.25-1.313M21 7.5v2.25m0-2.25-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3 2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75 2.25-1.313M12 21.75V19.5m0 2.25-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-2.25 1.313m-13.5 0L3 16.5v-2.25" />
                                    </svg>
                                </i><span class="ml-2">Запчасти</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.metroStation.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.metroStation.index') }}" class="svg-icon">
                                <i class="">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 16.01L14.01 15.999M10 16.01L10.01 15.999M22 12V15C22 16.3261 21.4732 17.5979 20.5355 18.5355C19.5979 19.4732 18.3261 20 17 20H7C5.67392 20 4.40215 19.4732 3.46447 18.5355C2.52678 17.5979 2 16.3261 2 15V12C2 6.477 6.477 2 12 2C17.523 2 22 6.477 22 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M18 12V15C18 16.3261 17.4732 17.5979 16.5355 18.5355C15.5979 19.4732 14.3261 20 13 20H11C9.67392 20 8.40215 19.4732 7.46447 18.5355C6.52678 17.5979 6 16.3261 6 15V12C6 10.6739 6.52678 9.40215 7.46447 8.46447C8.40215 7.52678 9.67392 7 11 7H13C14.3261 7 15.5979 7.52678 16.5355 8.46447C17.4732 9.40215 18 10.6739 18 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10.5 20L8.5 22.5M13.5 20L15.5 22.5M16.5 20L18.5 22.5M7.5 20L5.5 22.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                        <path d="M11.786 10H12.214C13.2 10 14 10.8 14 11.786C14 11.8141 13.9945 11.8419 13.9837 11.8679C13.973 11.8939 13.9572 11.9174 13.9373 11.9373C13.9174 11.9572 13.8939 11.973 13.8679 11.9837C13.8419 11.9945 13.8141 12 13.786 12H10.214C10.1572 12 10.1028 11.9775 10.0627 11.9373C10.0225 11.8972 10 11.8428 10 11.786C10 10.8 10.8 10 11.786 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </i><span class="ml-2">Станции метро</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <!-- Настройки CRM-->
                <li class="pb-2">

                    <a href="#settings" class="svg-icon collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </i>
                        <span class="text-uppercase small font-weight-bold">Настройки CRM</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active"
                             width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <ul id="settings" class="submenu collapse">

                        <li class="sidebar-layout {{ Route::is('crm.setting.index') ? 'active' : '' }}">
                            <a href="{{ route('crm.setting.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                    </svg>
                                </i><span class="ml-2">Основные</span>
                            </a>
                        </li>

                        <li class="sidebar-layout {{ Route::is('crm.user.*') ? 'active' : '' }}">
                            <a href="{{ route('crm.user.index') }}" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                                    </svg>
                                </i><span class="ml-2">Пользователи</span>
                            </a>
                        </li>


                    </ul>
                </li>


            </ul>
        </nav>
        <div class="pt-5 pb-5"></div>
    </div>

</div>
