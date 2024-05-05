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
                <h2 class="page-title">Bandwith</h2>
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
                    <form action="{{ route('update-bandwidth') }}" method="POST">
                        @csrf
                        <div class="row card-body">
                            <div class="col-6" id="col1">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input hidden value="{{ $id }}" name="id">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data['name'] }}" placeholder="Enter name" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Priority</label>
                                    <select name="priority" class="form-select">
                                        <option value="{{ $priority }}" selected>{{ $priority_number }}</option>
                                        <option value="0/0">0</option>
                                        <option value="1/1">1</option>
                                        <option value="2/2">2</option>
                                        <option value="3/3">3</option>
                                        <option value="4/4">4</option>
                                        <option value="5/5">5</option>
                                        <option value="6/6">6</option>
                                        <option value="7/7">7</option>
                                        <option value="8/8">8</option>
                                    </select>                                    
                                </div>
                            </div>
                            <div class="col-6" id="col2">
                                <div class="mb-3">
                                    <label class="form-label">IP Target</label>
                                    <div class="input-group input-group-flat mb-3" id="form">
                                        <textarea name="target" class="form-control @error('target') is-invalid @enderror" style="resize: none" rows="6"  placeholder="exp 192.168.1.0/24,10.10.10.0/30,10.100.101.2 " >{{ $data['target'] }}</textarea>
                                        @error('target')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-1">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Limit</label>
                                            <input type="text" class="form-control" name="max-limit" value="{{ $data['max-limit'] }}" placeholder="20M/50M (Upload/Download)" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Queu Type</label>
                                            <select name="queue" class="form-select">
                                                @foreach ($dataqueuetype as $item)
                                                <option value="{{ $item['name'] }}/{{ $item['name'] }}" 
                                                @if($queue_type == $item['name']) selected @endif>{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-1">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Burst Limit</label>
                                            <input type="text" class="form-control" name="burst-limit"  value="{{ $data['burst-limit'] }}" placeholder="40M/100M (Upload/Download)" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Burst Threshold</label>
                                            <input type="text" class="form-control" name="burst-threshold"  value="{{ $data['burst-threshold'] }}" placeholder="10M/10M (Upload/Download)" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-1">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Burst Time</label>
                                            <input type="text" class="form-control" name="burst-time"  value="{{ $data['burst-time'] }}" placeholder="30/30 (Alokasi waktu Burst)" />
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Limit At</label>
                                            <input type="text" class="form-control" name="limit-at" value="{{ $data['limit-at'] }}" placeholder="2M/2M (Upload/Download)" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-12 mt-3">
                            <div class="col-6 col-sm-4 col-md-2 col-xl py-3 float-end">
                                <button type="submit" class="btn btn-outline-primary w-100"> Update </button>
                            </div>
                        </div>
                        <span>
                            <p>
                                <li><b>Max Limit:</b> Batas maksimum kecepatan atau alokasi bandwidth untuk pengguna atau layanan dalam jaringan.</li>
                                <li><b>Burst Limit:</b> Batas maksimum kecepatan atau alokasi bandwidth dalam periode burst untuk pengiriman data dengan kecepatan tinggi sebelum kembali ke batas normal.</li>
                                <li><b>Burst Threshold:</b> Jumlah data yang dapat dikirimkan sebelum burst limit diaktifkan dan diterapkan.</li>
                                <li><b>Burst Time:</b> Durasi di mana pengguna atau layanan dapat mengirimkan data dengan kecepatan tinggi sebelum kembali ke batas normal setelah periode waktu tertentu.</li>
                                <li><b>Limit At:</b> Kecepatan atau alokasi bandwidth yang tetap diberikan kepada pengguna atau layanan dalam jaringan tanpa memperhatikan burst limit atau periode burst.</li>
                            </p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function convertToMegaBit(limit) {
        var parts = limit.split('/');
        var upload = parts[0] / 1000000;
        var download = parts[1] / 1000000;
        return upload + 'M/' + download + 'M';
    }
    
    var limitValue = "{{ $data['max-limit'] }}";
    var convertedLimit = convertToMegaBit(limitValue);
    document.querySelector("input[name='max-limit']").value = convertedLimit;

    var limitValue = "{{ $data['burst-limit'] }}";
    var convertedLimit = convertToMegaBit(limitValue);
    document.querySelector("input[name='burst-limit']").value = convertedLimit;

    var limitValue = "{{ $data['burst-threshold'] }}";
    var convertedLimit = convertToMegaBit(limitValue);
    document.querySelector("input[name='burst-threshold']").value = convertedLimit;

    var limitValue = "{{ $data['limit-at'] }}";
    var convertedLimit = convertToMegaBit(limitValue);
    document.querySelector("input[name='limit-at']").value = convertedLimit;
</script>

@endsection



