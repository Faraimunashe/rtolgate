<x-app-layout>
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Prices</h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Prices</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>

    <section id="main-content">
        <div class="row">
            <div class="col-md-12">
                <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="bootstrap-data-table-panel">
                        <div class="table-responsive">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Class</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($prices as $item)
                                        <tr>
                                            <td>
                                                @php
                                                    $count++;
                                                    echo $count;
                                                @endphp
                                            </td>
                                            <td>{{ $item->class }}</td>
                                            <td>
                                                @if ($item->class == 0)
                                                    Exempted
                                                @elseif ($item->class == 1)
                                                    Motor Cycles
                                                @elseif ($item->class == 2)
                                                    Light Motor Vehicles
                                                @elseif ($item->class == 3)
                                                    Minibuses
                                                @elseif ($item->class == 4)
                                                    Buses
                                                @elseif ($item->class == 5)
                                                    Heavy Vehicles
                                                @elseif ($item->class == 6)
                                                    Haulage Trucks
                                                @endif
                                            </td>
                                            <td>{{ $item->amount }}</td>
                                            <td>
                                                <a href="{{ route('admin-price', $item->id) }}" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                                    <i class="ti-pencil-alt"></i>
                                                    Update
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>
            <!-- /# column -->
        </div>
        <!-- /# row -->
    </section>
</x-app-layout>
