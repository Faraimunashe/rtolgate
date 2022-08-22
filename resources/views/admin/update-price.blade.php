<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Update Price</h4>
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
                        <form action="{{ route('admin-update-price') }}" method="POST">
                            @csrf
                            <input type="hidden" name="price_id" value="{{ $price->id }}" required>
                            <div class="form-group">
                                <input type="text" name="class" value="{{ $price->class }}" class="form-control input-default" readonly required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="amount" value="{{ $price->amount }}" class="form-control input-default" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit"> Update Price </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
