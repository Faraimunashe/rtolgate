<x-app-layout>
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Hello, <span>Welcome Tolgate Dashboard</span></h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Home</li>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Reg Number</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accounts as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->regnum }}</td>
                                            <td>{{ $item->vname }}</td>
                                            <td>{{ $item->vclass }}</td>
                                            <td>{{ $item->balance }}</td>
                                            <td>
                                                <a href="{{ route('admin-card', $item->id) }}" class="btn btn-primary btn-flat btn-addon m-b-10 m-l-5">
                                                    <i class="ti-plus"></i>
                                                    Card
                                                </a>
                                                @if ($item->vclass == 0)
                                                    <a href="{{ route('admin-romove-exempt', $item->id) }}" class="btn btn-danger btn-flat btn-addon m-b-10 m-l-5">
                                                        <i class="ti-close"></i>
                                                        Exempt
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin-exempt', $item->id) }}" class="btn btn-success btn-flat btn-addon m-b-10 m-l-5">
                                                        <i class="ti-plus"></i>
                                                        Exempt
                                                    </a>
                                                @endif
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
