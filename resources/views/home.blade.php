@extends('layouts.app')

@section('content')
<div class="container">
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <div class="row">
                    <!-- Surveys Tile -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ url('surveys') }}" class="text-decoration-none">
                            <div class="border border-2 bg-white mb-4 shadow">
                                <span class="text-muted ms-2 mt-2">Surveys</span>
                                <div class="d-flex justify-content-between p-3">
                                    <div>
                                        <h2>{{ $survey_count }}</h2>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-up text-primary"></i>
                                        <span class="text-muted small border-rounded">80%</span>
                                    </div>
                                </div>
                                <span class="d-block mt-auto w-100 border border-2 border-primary"></span>
                            </div>
                        </a>
                    </div>

                    <!-- Questionaires Tile -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ url('questionaires') }}" class="text-decoration-none">
                            <div class="border border-2 bg-white mb-4 shadow">
                                <span class="text-muted ms-2 mt-2">Questionaires</span>
                                <div class="d-flex justify-content-between p-3">
                                    <div>
                                        <h2>{{ $questionaire_count }}</h2>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-up text-success"></i>
                                        <span class="text-muted small border-rounded">12%</span>
                                    </div>
                                </div>
                                <span class="d-block mt-auto w-100 border border-2 border-success"></span>
                            </div>
                        </a>
                    </div>

                    <!-- Staff Tile -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ url('staff') }}" class="text-decoration-none">
                            <div class="border border-2 bg-white mb-4 shadow">
                                <span class="text-muted ms-2 mt-2">Staff</span>
                                <div class="d-flex justify-content-between p-3">
                                    <div>
                                        <h2>{{ $staff_count }}</h2>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-up text-warning"></i>
                                        <span class="text-muted small border-rounded">10%</span>
                                    </div>
                                </div>
                                <span class="d-block mt-auto w-100 border border-2 border-warning"></span>
                            </div>
                        </a>
                    </div>

                    <!-- Audiences Reached Tile -->
                    <div class="col-xl-3 col-md-6">
                        <a href="{{ url('answers') }}" class="text-decoration-none">
                            <div class="border border-2 bg-white mb-4 shadow">
                                <span class="text-muted ms-2 mt-2">Audiences Reached</span>
                                <div class="d-flex justify-content-between p-3">
                                    <div>
                                        <h2>{{ $responses }}</h2>
                                    </div>
                                    <div>
                                        <i class="fas fa-chevron-up text-danger"></i>
                                        <span class="text-muted small border-rounded">30%</span>
                                    </div>
                                </div>
                                <span class="d-block mt-auto w-100 border border-2 border-danger"></span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Rest of the dashboard (charts and audit trail) remains unchanged -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Survey Completes
                            </div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Monthly Responses
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Functionary Audit Trail
                    </div>
                    <div class="card-body">
                        @if (count($audit_trail) > 0)
                            <table class="table" id="datatablesSimple">
                                <thead>
                                    <th>#</th>
                                    <th>ACTION</th>
                                    <th>USER</th>
                                    <th>DATE/ TIME</th>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($audit_trail as $record)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $record->action }}</td>
                                            <td>{{ $record->user->FirstName }} {{ $record->user->SecondName }}</td>
                                            <td>{{ $record->created_at->setTimezone('Africa/Nairobi') }}</td>
                                        </tr>
                                        @php
                                            ++$counter;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-danger">
                                <p>No Audit Record in the System</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        ·
                        <a href="#">Terms & Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection