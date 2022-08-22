<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ Session::get('success') }}
                        </div>
                    @endif
        </div>
        <div class="col-lg-3">
            <a href="{{ route('user-deposit') }}">
                <div class="card">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib">
                            <i class="ti-money color-success border-success"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text">My Balance</div>
                            <div class="stat-digit">{{ $account->balance }}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('user-transactions') }}">
                <div class="card">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib">
                            <i class="ti-ticket color-primary border-primary"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text">Transactions</div>
                            <div class="stat-digit">
                                @php
                                    $trans = \App\Models\Transactions::where('user_id', Auth::id())->count();
                                    echo $trans;
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="{{ route('user-card') }}">
                <div class="card">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib">
                            <i class="ti-id-badge color-pink border-pink"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text">Card Status</div>
                            <div class="stat-digit">
                                @if (is_null($card))
                                    Disabled
                                @else
                                    Active
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="">
                <div class="card">
                    <div class="stat-widget-one">
                        <div class="stat-icon dib">
                            <i class="ti-car color-danger border-danger"></i>
                        </div>
                        <div class="stat-content dib">
                            <div class="stat-text">Vehicle Class</div>
                            <div class="stat-digit">
                                @if ($vehicle->vclass == 0)
                                    Exempted
                                @else
                                    {{ $vehicle->vclass }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
