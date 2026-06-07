@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">

        <div class="card-header">

            <div class="row align-items-center">

                <div class="col-md-6">
                    <h5 class="mb-0">
                        Data Akademik Siswa
                    </h5>
                </div>

                <div class="col-md-6">
                    <form action="/data-akademik" method="GET">

                        <div class="input-group">

                            <input type="text" name="search" class="form-control"
                                placeholder="Cari berdasarkan NISN atau Nama Siswa..." value="{{ request('search') }}">

                            <button type="submit" class="btn btn-primary">
                                Cari
                            </button>

                            @if (request('search'))
                                <a href="/data-akademik" class="btn btn-danger">
                                    Reset
                                </a>
                            @endif

                        </div>

                    </form>
                </div>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead class="table-primary">

                        <tr>

                            <th>User ID</th>
                            <th>NISN</th>
                            <th>Nama</th>

                            <th>Exam Score</th>
                            <th>Attendance</th>
                            <th>Previous Score</th>

                            <th>Hours Studied</th>
                            <th>Tutoring</th>
                            <th>Physical Activity</th>
                            <th>Sleep Hours</th>
                            <th>Access Resource</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($students as $row)
                            <tr>
                                <td>{{ $row->user_id }}</td>

                                <td>{{ $row->NISN }}</td>

                                <td>{{ $row->name ?? '-' }}</td>

                                <td>{{ $row->Exam_Score ?? '-' }}</td>
                                <td>{{ $row->Attendance ?? '-' }}</td>
                                <td>{{ $row->Previous_Scores ?? '-' }}</td>
                                <td>{{ $row->Hours_Studied ?? '-' }}</td>
                                <td>{{ $row->Tutoring_Sessions ?? '-' }}</td>
                                <td>{{ $row->Physical_Activity ?? '-' }}</td>
                                <td>{{ $row->Sleep_Hours ?? '-' }}</td>
                                <td>{{ $row->Access_to_Resources ?? '-' }}</td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="11" class="text-center">
                                    Data tidak ditemukan
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
@endsection
