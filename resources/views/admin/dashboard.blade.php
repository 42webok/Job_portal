
@extends('admin.layout.app')
@php
   if (!function_exists('formatMonthlyData')) {
    function formatMonthlyData($data) {
        $result = [];

        for ($i = 1; $i <= 12; $i++) {
            $result[] = $data[$i] ?? 0;
        }

        return $result;
    }
  }

    $chart_jobs = formatMonthlyData($chart_jobs);
    $chart_jobs_applications = formatMonthlyData($chart_jobs_applications);
    $chart_users = formatMonthlyData($chart_users);

@endphp
<script>
  let chartJobs = @json($chart_jobs);
  let chartJobsApplications = @json($chart_jobs_applications);
  let chartUsers = @json($chart_users);
</script>

@section('title', 'Admin | Dashboard')
<style>
  .card .card-body {
    padding: 0.9rem 2.5rem !important;
}
</style>
@section('content')
 <div class="content-wrapper">
          
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Users <i class="fa fa-users mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $total_users }}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Jobs <i class="fa fa-handshake-o mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $total_jobs }}</h2>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{ asset('admin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Categories <i class="mdi mdi-diamond mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5">{{ $total_categories }}</h2>
                   
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-start">Visit And Sales Statistics</h4>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Traffic Sources</h4>
                    <div class="doughnutjs-wrapper d-flex justify-content-center">
                      <canvas id="traffic-chart"></canvas>
                    </div>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Jobs</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Title </th>
                            <th> User </th>
                            <th> Category </th>
                            <th> Salary </th>
                            <th> Company </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                         @forelse($recent_jobs as $recent_jobs)
                           <tr>
                            <td>
                              {{ $recent_jobs->title  }}
                            </td>
                            <td> {{ $recent_jobs->user->name }} </td>
                            <td>
                               {{  $recent_jobs->category->name }}
                            </td>
                            <td>  {{ $recent_jobs->salary }} </td>
                            <td>  {{ $recent_jobs->company_name }} </td>
                            <td>  <span class="badge {{ $recent_jobs->status == 1 ? 'bg-success' : 'bg-danger' }}">{{ $recent_jobs->status == 1 ? 'Active' : 'Inactive' }}</span> </td>
                          </tr>


                         @empty
                            <tr>
                              <td colspan="5" class="text-center">No recent jobs found.</td>
                            </tr>
                         @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

              <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Recent Users</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Mobile </th>
                            <th> Designation </th>
                            <th> Is Public </th>
                          </tr>
                        </thead>
                        <tbody>
                         @forelse($recent_users as $recent_users)
                           <tr>
                            <td>
                              {{ $recent_users->name  }}
                            </td>
                            <td> {{ $recent_users->email }} </td>
                            <td> {{ $recent_users->mobile }} </td>
                            <td> {{ $recent_users->designation }} </td>
                            <td> <span class="badge {{ $recent_users->is_public_profile == 1 ? 'bg-success' : 'bg-danger' }}">{{ $recent_users->is_public_profile == 1 ? 'Yes' : 'No' }}</span> </td>
                          </tr>


                         @empty
                            <tr>
                              <td colspan="5" class="text-center">No recent users found.</td>
                            </tr>
                         @endforelse
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
@endsection
