<!-- modal to view invoice logs -->
<div class="modal modal-info fade" tabindex="-1" id="add_pricing_column_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-logbook"></i>Invoice Logs</h4>
            </div>
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
                                            <th>Activity</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr role="row">
                                            <td>1</td>
                                            <td>jyair</td>
                                            <td>edit</td>
                                            <td>12 minues ago</td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning mx-3 pull-right" data-dismiss="modal">{{ __('voyager::generic.close') }}</button>
                <!-- <button type="submit" class="btn btn-primary pull-right" ">{{ __('voyager::generic.save') }}</button> -->
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->