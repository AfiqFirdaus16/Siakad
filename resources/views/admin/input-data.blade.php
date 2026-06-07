@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">Input Data Akademik</h4>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <ul class="nav nav-tabs" id="dataTab" role="tablist">

                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#manual">
                        Input Manual
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#import">
                        Import CSV
                    </button>
                </li>

            </ul>

            <div class="tab-content mt-4">

                <div class="tab-pane fade show active" id="manual">

                    <form action="/input-data/store" method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nama Siswa</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Exam Score</label>
                                <input type="number" name="exam_score" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Attendance</label>
                                <input type="number" name="attendance" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Previous Score</label>
                                <input type="number" name="previous_scores" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Hours Studied</label>
                                <input type="number" name="hours_studied" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Tutoring Sessions</label>
                                <input type="number" name="tutoring_sessions" class="form-control">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Physical Activity</label>
                                <input type="number" name="physical_activity" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Sleep Hours</label>
                                <input type="number" name="sleep_hours" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Access To Resources</label>

                                <select name="access_to_resources" class="form-select" required>

                                    <option value="">
                                        -- Pilih Akses Resource --
                                    </option>

                                    <option value="High">
                                        High
                                    </option>

                                    <option value="Medium">
                                        Medium
                                    </option>

                                    <option value="Low">
                                        Low
                                    </option>

                                </select>

                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Simpan Data
                        </button>

                    </form>

                </div>

                <div class="tab-pane fade" id="import">

                    <form action="/input-data/import" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">

                            <label>
                                Upload File CSV
                            </label>

                            <input type="file" name="file" accept=".csv" class="form-control" required>

                        </div>

                        <button type="submit" class="btn btn-success">
                            Import CSV
                        </button>

                        <a href="/template-csv" class="btn btn-outline-primary">
                            Download Template
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>
@endsection
