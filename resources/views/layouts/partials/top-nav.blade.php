<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ route('home') }}">
                @guest
                    {{ config('app.name', 'Laravel') }}
                @else
                    {{ auth()->user()->name }}
                @endguest
            </a>
        </div>
        <div class="nav navbar-nav" style="margin: 0;">
            @auth
            <a href="{{ route('home') }}" class="xs-navbar" title="{{ __('transaction.current_balance') }}">
                <img src="{{ asset('images/icons8-coins-16.png') }}" alt=""> {{ format_number(balance(date('Y-m-d'))) }}
            </a>
            @include ('layouts.partials.lang_switcher')
            @endauth
        </div>

        <!-- Right Side Of Navbar -->
        <div class="nav navbar-nav navbar-right" style="margin: 0;">
            <!-- Authentication Links -->
            @guest
                {{ link_to_route('login', __('auth.login'), [], ['class' => 'xs-navbar']) }}
                {{ link_to_route('register', __('auth.register'), [], ['class' => 'xs-navbar']) }}
            @else
                <a class="xs-navbar" href="{{ route('transactions.index') }}" title="{{ __('transaction.transaction') }}">
                    <span class="glyphicon glyphicon-retweet" aria-hidden="true"></span>&nbsp;
                    <span class="hidden-xs">{{ __('transaction.transaction') }}</span>
                </a>
                <a class="xs-navbar" href="{{ route('loans.index') }}" title="{{ __('loan.loan') }}">
                    <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>&nbsp;
                    <span class="hidden-xs">{{ __('loan.loan') }}</span>
                </a>
                <a class="xs-navbar" href="{{ route('reports.index') }}" title="{{ __('report.report') }}">
                    <span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span>&nbsp;
                    <span class="hidden-xs">{{ __('report.report') }}</span>
                </a>
                <a class="xs-navbar" href="{{ route('profile.show') }}" title="{{ __('settings.settings') }}">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp;
                    <span class="hidden-xs">{{ __('settings.settings') }}</span>
                </a>
                <a class="xs-navbar" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    <input type="submit" value="{{ __('auth.logout') }}" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endguest
        </div>
    </div>
</nav>
