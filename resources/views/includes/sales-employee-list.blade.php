<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employeeData as $index => $emp)

                                <tr role="row">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $emp['name'] }}</td>
                                    <td>{{ $emp['email'] }}</td>
                                    <td>{{ $emp['role']['name'] ?? 'N/A' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($emp['created_at'])->format('F d, Y') }}</td>                                    
                                </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>