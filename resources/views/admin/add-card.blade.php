<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Add Card To {{ $user->name }}</h4>
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
                        <form action="{{ route('admin-add-card') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}" required>
                            <div class="form-group">
                                <input type="text" name="rfid" placeholder="Scan RFID Card" class="form-control input-default" autofocus required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="pin" placeholder="First Pin" class="form-control input-default" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit"> Add Card </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
