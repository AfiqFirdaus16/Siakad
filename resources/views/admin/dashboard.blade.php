@extends('layouts.app')

@section('content')
    <div class="row mt-4">

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    Distribusi Previous Scores
                </div>
                <div class="card-body">
                    <div style="height:300px;">
                        <canvas id="examChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    Distribusi Attendance
                </div>
                <div class="card-body">
                    <div style="height:300px;">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    Distribusi Hours Studied
                </div>
                <div class="card-body">
                    <div style="height:300px;">
                        <canvas id="studyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = ['0-20', '21-40', '41-60', '61-80', '81-100'];

        new Chart(document.getElementById('attendanceChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Attendance',
                    data: @json($attendanceDistribution)
                }]
            }
        });

        new Chart(document.getElementById('studyChart'), {
            type: 'pie',
            data: {
                labels: ['0-5', '6-10', '11-15', '16-20', '>20'],
                datasets: [{
                    data: @json($studyDistribution)
                }]
            }
        });

        new Chart(document.getElementById('scoreChart'), {
            type: 'pie',
            data: {
                labels: ['0-20', '21-40', '41-60', '61-80', '81-100'],
                datasets: [{
                    data: @json($scoreDistribution)
                }]
            }
        });

    </script>
@endsection
