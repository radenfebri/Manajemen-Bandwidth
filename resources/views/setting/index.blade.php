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
                <h2 class="page-title">Settings</h2>
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
                    <form action="{{ route('update-mikrotik', $id) }}" method="POST">
                        @csrf
                        <div class="row card-body">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">IP Address</label>
                                    <input type="text" value="{{ $ip }}" class="form-control @error('ip') is-invalid @enderror" name="ip" placeholder="Input IP address" />
                                    @error('ip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">User</label>
                                    <input type="text" value="{{ $user }}" class="form-control @error('user') is-invalid @enderror" name="user" placeholder="Input User" />
                                    @error('user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="text" value="{{ $pass }}" class="form-control" name="password" placeholder="Input Password" />
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
                <div class="card mt-5">
                    <div class="row card-body">
                        <label class="row">
                            <span class="col">Setting Enable / Disable halaman register</span>
                            <span class="col-auto">
                                <label class="form-check form-check-single form-switch">
                                    <input class="form-check-input" type="checkbox" id="registerCheckbox" {{ $register == 1 ? 'checked' : '' }}>
                                </label>
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const registerCheckbox = document.getElementById('registerCheckbox');
    registerCheckbox.addEventListener('change', function() {
        const value = this.checked ? 1 : 0;
        
        const url = '{{ route("disable-enable.register") }}';
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ registerCheckbox: value })
        })
        .then(response => {
            if (response.ok) {
            } else {
            }
        })
        .catch(error => {
        });
    });
</script>



@endsection

