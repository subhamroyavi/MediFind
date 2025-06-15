@extends('layouts.admin_app')

@section('main-content')

<!-- Page Content -->

<div class="row">
    <div class="col-xl-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md flex-shrink-0">
                        <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                            <i class="fas fa-users"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-4">
                        <p class="text-muted text-truncate font-size-15 mb-2"> Users</p>
                        <h3 class="fs-4 flex-grow-1 mb-3">{{ $totalUsers }} </h3>

                    </div>

                </div>
                <p class="text-muted mb-0 text-truncate">
                    <span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1">
                        <i class="fa-solid fa-arrow-up"></i> {{ $activeUsers }} Active</span>
                    <span class="badge bg-subtle-danger text-danger font-size-12 fw-normal me-1">
                        <i class="fa-solid fa-arrow-down"></i> {{ $inactiveUsers }} Inactive</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md flex-shrink-0">
                        <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                            <i class="fas fa-hospital"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-4">
                        <p class="text-muted text-truncate font-size-15 mb-2"> Hospitals</p>
                        <h3 class="fs-4 flex-grow-1 mb-3">{{ $totalHospitals }} </h3>

                    </div>

                </div>
                <p class="text-muted mb-0 text-truncate">
                    <span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1">
                        <i class="fa-solid fa-arrow-up"></i> {{ $activeHospitals }} Active</span>

                    <span class="badge bg-subtle-danger text-danger font-size-12 fw-normal me-1">
                        <i class="fa-solid fa-arrow-down"></i> {{ $inactiveHospitals }} Inactive</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md flex-shrink-0">
                        <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                            <i class="fas fa-user-md"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-4">
                        <p class="text-muted text-truncate font-size-15 mb-2"> Doctors</p>
                        <h3 class="fs-4 flex-grow-1 mb-3">{{ $totalDoctors }} </h3>

                    </div>

                </div>
                <p class="text-muted mb-0 text-truncate">
                    <span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1">
                        <i class="fa-solid fa-arrow-up"></i> {{ $activeDoctors }} Active</span>
                    <span class="badge bg-subtle-danger text-danger font-size-12 fw-normal me-1">
                        <i class="fa-solid fa-arrow-down"></i> {{ $inactiveDoctors }} Inactive</span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md flex-shrink-0">
                        <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                            <i class="fas fa-ambulance"></i>
                        </span>
                    </div>
                    <div class="flex-grow-1 overflow-hidden ms-4">
                        <p class="text-muted text-truncate font-size-15 mb-2"> Ambulances</p>
                        <h3 class="fs-4 flex-grow-1 mb-3">{{ $totalAmbulances }} </h3>

                    </div>

                </div>
                <p class="text-muted mb-0 text-truncate">
                    <span class="badge bg-subtle-success text-success font-size-12 fw-normal me-1">
                        <i class="fa-solid fa-arrow-up"></i> {{ $activeAmbulances }} Active</span>
                    <span class="badge bg-subtle-danger text-danger font-size-12 fw-normal me-1">
                        <i class="fa-solid fa-arrow-down"></i> {{ $inactiveAmbulances }} Inactive</span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- END ROW -->
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex pb-1">
                <h4 class="card-title mb-0 flex-grow-1">Live Users By Country</h4>

            </div>
            <div class="card-body p-0"> <!-- Added p-0 to remove padding -->
                <div id="world-map-markers" style="height: 400px; width: 100%; overflow: hidden;">
                    <img src="https://imgs.search.brave.com/9WYayR5awDkBG_YbWO3BSxDpEg4kWsaLNmga0hCDfDY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy80/LzQxL1NpbXBsZV93/b3JsZF9tYXAuc3Zn"
                        alt="World Map"
                        style="width: 100%; height: 100%; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
</div>


@endsection