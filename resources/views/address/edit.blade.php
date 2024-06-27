@extends('dashboard.master')

@section('title', 'Bandwith')

@section('content')

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">Update</div>
                <h2 class="page-title">Address List</h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('bandwidth') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">      
                    <form action="{{ route('update-address') }}" method="POST">
                        @csrf
                        <div class="row card-body">
                            <div class="col-6" id="col1">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input hidden value="{{ $id }}" name="id">
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $address }}" placeholder="192.168.100.1/24" />
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6" id="col2">
                                <div class="mb-3">
                                    <label class="form-label">Interfaces</label>
                                    <div class="input-group input-group-flat mb-3" id="form">
                                        <select name="interface" class="form-select">
                                            @foreach ($interfaces as $item)
                                                @php
                                                    $interfaceName = isset($item['name']) ? $item['name'] : '';
                                                    $isSelected = ($interfaceName == old('interface', $interface)) ? 'selected' : '';
                                                @endphp
                                                <option value="{{ $interfaceName }}" {{ $isSelected }}>{{ $interfaceName }}</option>
                                            @endforeach
                                        </select>
                                        @error('interface')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-12 mt-3">
                            <div class="col-6 col-sm-4 col-md-2 col-xl py-3 float-end">
                                <button type="submit" class="btn btn-outline-primary w-100"> Update </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



