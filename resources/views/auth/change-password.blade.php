@extends('dashboard.master')

@section('title', 'Setting')

@section('content')


<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Menu</div>
                <h2 class="page-title">Change Password</h2>
            </div>
            <!-- Page title actions -->
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('updatePassword') }}" method="POST">
                        @csrf
                        <div class="row card-body">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Input Current Password" />
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Input New Password" />
                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="new_password_confirmation" placeholder="Input Confirm Password" />
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="col-6 col-sm-4 col-md-2 col-xl py-3 float-end">
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-outline-primary w-100">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

