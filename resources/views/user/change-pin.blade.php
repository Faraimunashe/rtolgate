<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Change Card Pin</h4>
                </div>
                <div class="card-body">
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
                    <div class="basic-form">
                        <form action="{{ route('user-change-pin') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="number" name="old_pin" placeholder="Input Email" class="form-control input-default " required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="new_pin" placeholder="Input Phone" class="form-control input-default " required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="new_pin_again" placeholder="Input Amount" class="form-control input-default " required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit"> Change Pin </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
</x-app-layout>
