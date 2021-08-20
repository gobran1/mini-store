<div class="container">
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <a href="{{ route('main.show') }}" class="navbar-brand">
                Shopping
            </a>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="navbar-collapse collapse" id="main-nav">
            <ul class="navbar-right navbar-nav nav">
                <li>
                    <a href="{{ route('cart.show') }}">
                        <span class="glyphicon-shopping-cart"></span> Shopping cart
                    </a>
                </li>
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon-user"></span> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a href="{{ route('user.profile') }}">My Account</a>
                            </li>


                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('user.logout') }}" id="logout">Log Out</a>
                                <form action="{{ route('user.logout') }}" method="POST" id="logout-form"
                                      style="display: none">
                                    {{ csrf_field() }}
                                </form>

                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::guest())
                    <li><a href="{{ route('user.showRegisterForm') }}">Sign Up</a></li>
                    <li><a href="{{ route('user.showLoginForm') }}">Log In</a></li>
                @endif
            </ul>

        </div>

    </nav>
</div>