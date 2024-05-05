@extends('dashboard.master')

@section('title', 'Bandwith')

@section('content')

<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">Menu</div>
                    <h2 class="page-title">Bandwidth</h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('create-bandwidth') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Create
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex justify-content-between">
                                <div class="text-muted">
                                    <div class="d-inline-block me-2">
                                        Search:
                                        <input type="text" class="form-control form-control-sm" aria-label="Search invoice" id="cari" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table id="tables" class="table table-striped table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Target IP</th>
                                        <th>Limit (UPLOAD/DOWNLOAD)</th>
                                        <th>Priority</th>
                                        <th>info</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ Illuminate\Support\Str::limit($item['target'], 50, '...') }}</td>
                                        <td>{{ $item['max-limit'] }}</td>
                                        <td>{{ $item['priority'] }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal-simple" data-id="{{ $item['id'] }}" data-name="{{ $item['name'] }}" data-target="{{ $item['target'] }}" data-priority="{{ $item['priority'] }}" data-queue-type="{{ $item['queue'] }}" data-max-limit="{{ $item['max-limit'] }}" data-burst-limit="{{ $item['burst-limit'] }}" data-burst-threshold="{{ $item['burst-threshold'] }}" data-burst-time="{{ $item['burst-time'] }}" data-limit-at="{{ $item['limit-at'] }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-square-rounded">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 9h.01" />
                                                    <path d="M11 12h1v4h1" />
                                                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('edit-bandwidth', $item['id']) }}">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('delete-bandwidth', $item['id']) }}" type="button" onclick="return confirm('Apakah anda yakin menghapus secret {{ $item['name'] }} ?')">
                                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="overflow-auto">
                    <p><strong>Name:</strong> <span id="modal-name"></span></p>
                    <p><strong>Target:</strong> <span id="modal-target"></span></p>
                    <p><strong>Max Limit:</strong> <span id="modal-max-limit"></span></p>
                    <p><strong>Burst Limit:</strong> <span id="modal-burst-limit"></span></p>
                    <p><strong>Burst Threshold:</strong> <span id="modal-burst-threshold"></span></p>
                    <p><strong>Burst Time:</strong> <span id="modal-burst-time"></span></p>
                    <p><strong>Limit At:</strong> <span id="modal-limit-at"></span></p>
                    <p><strong>Priority:</strong> <span id="modal-priority"></span></p>
                    <p><strong>Queue Type:</strong> <span id="modal-queue-type"></span></p>
                    <!-- Tambahkan elemen-elemen lain sesuai kebutuhan -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(element) {
        element.addEventListener('click', function(event) {
            var name = event.currentTarget.getAttribute('data-name');
            var target = event.currentTarget.getAttribute('data-target');
            var maxLimit = event.currentTarget.getAttribute('data-max-limit');
            var priority = event.currentTarget.getAttribute('data-priority');
            var queueType = event.currentTarget.getAttribute('data-queue-type');
            var burtLimit = event.currentTarget.getAttribute('data-burst-limit');
            var burtThreshold = event.currentTarget.getAttribute('data-burst-threshold');
            var burstTime = event.currentTarget.getAttribute('data-burst-time');
            var limitAt = event.currentTarget.getAttribute('data-limit-at');
            
            // Pastikan teks target tidak melebihi batas modal
            // var targetText = target.length > 50 ? target.substr(0, 50) + '...' : target;
            
            // Masukkan data ke dalam elemen modal
            document.getElementById('modal-title').textContent = "Details Bandwith"; // Judul modal (opsional)
            document.getElementById('modal-name').textContent = name;
            // document.getElementById('modal-target').textContent = targetText;
            document.getElementById('modal-target').textContent = target;
            document.getElementById('modal-max-limit').textContent = maxLimit;
            document.getElementById('modal-priority').textContent = priority;
            document.getElementById('modal-queue-type').textContent = queueType;
            document.getElementById('modal-burst-limit').textContent = burstTime;
            document.getElementById('modal-burst-threshold').textContent = burtThreshold;
            document.getElementById('modal-burst-time').textContent = burstTime;
            document.getElementById('modal-limit-at').textContent = limitAt;
            
            // Tampilkan modal
            modalSimple.show();
        });
    });
</script>

<script src="{{ asset('template') }}/dist/js/search.js" defer></script>


@endsection


