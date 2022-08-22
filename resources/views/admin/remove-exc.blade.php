<x-app-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-title">
                    <h4>Remove {{ $veh->regnum }} {{ $veh->name }} Exemption</h4>
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
                        <form action="{{ route('admin-delete-exempt') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}" required>
                            <div class="form-group">
                                <select name="vclass" class="form-control input-default" required>
                                    <option selected disabled>Select Tolgate Class</option>
                                    <option value="1">Motor Cycles</option>
                                    <option value="2">Light Motor Vehicles</option>
                                    <option value="3">Minibuses</option>
                                    <option value="4">Buses</option>
                                    <option value="5">Heavy Vehicles</option>
                                    <option value="6">Haulage Trucks</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="submit"> Remove Exemption </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
