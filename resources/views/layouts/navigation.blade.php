<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        <span>Tolgate App</span>
                    </a>
                </div>
                <li class="label">Main</li>
                @if (Auth::user()->hasRole('admin'))
                    <li>
                        <a href="{{ route('admin-dashboard') }}">
                            <i class="ti-dashboard"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-transactions') }}">
                            <i class="ti-ticket"></i>
                            Transactions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin-prices') }}">
                            <i class="ti-money"></i>
                            Prices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('scan') }}">
                            <i class="ti-harddrive"></i>
                            Scanning
                        </a>
                    </li>
                @elseif (Auth::user()->hasRole('user'))
                    <li>
                        <a href="{{ route('user-dashboard') }}">
                            <i class="ti-dashboard"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user-transactions') }}">
                            <i class="ti-ticket"></i>
                            Transactions
                        </a>
                    </li>
                @endif
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="ti-lock"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
