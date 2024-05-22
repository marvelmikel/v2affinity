@extends('voyager::master')

@section('page_title', 'Logs')

@section('page_header')
<h1 class="page-title">
    <i class="voyager-logbook"></i> Logs
</h1>
@stop

@section('content')
@if(Auth::user()->role_id === 1)
<!-- Admin Logs -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <table id="dataTable" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Company</th>
                                <th>Role</th>
                                <th>Name</th>
                                <th>Activity</th>
                                <th>IP Address</th>
                                <th>User Browser</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companyUserLogs as $log)
                            <tr role="row">
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->user->company->company_name ?? 'No Company' }}</td>
                                <td>{{ $log->user->role->name ?? 'No Role' }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->log_type . ' - ' . $log->table_name }}</td>

                                <td>{{ $log->ip}}</td>
                                <td>{{ $log->user_agent}}</td>
                                <td>{{ \Carbon\Carbon::parse($log->log_date)->diffForHumans() }} - {{ \Carbon\Carbon::parse($log->log_date)->format('d F Y') }} </td>





                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Company user Logs -->
@else
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <table id="dataTable" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                        <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Username</th>
                                <!-- <th>Company</th> -->
                                <th>Role</th>
                                <th>Activity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count = 0;
                            @endphp

                            @foreach($companyUserLogs as $log)
                            
                            @php
                            $count++;
                            @endphp
                            <tr role="row">
                                <td>{{ $count}}</td>
                                <td>{{ $log->user->name }}</td>
                                <!-- <td>{{ $log->user->company->company_name }}</td> -->
                                <td>{{ $log->user->role->name }}</td>
                                <td>{{ $log->log_type . ' - ' . $log->table_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->log_date)->diffForHumans() }} - {{ \Carbon\Carbon::parse($log->log_date)->format('d F Y') }} </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

@stop

@section('javascript')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [],
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false
            }]
        });
    });
</script>
@stop