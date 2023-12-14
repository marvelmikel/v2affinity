<div class="col-md-6 align-middle">
    <div class="admin-section-title card flex space justify-between">
        <h3 style="margin-left: 20px"><i class="voyager-mail"></i> {{ __('Store Email Settings') }}</h3>
    </div>
    <div class="clear"></div>
    <br>
    <div class="panel panel-bordered">
        <form class="form-edit-add" wire:submit.prevent="saveEmailSettings">
            <div class="panel-body">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="host">Host</label>
                        <input wire:model="email_settings.host" class="form-control" type="text" id="host" name="host">
                    </div>

                    <div class="col-md-4">
                        <label for="port">Port</label>
                        <input wire:model="email_settings.port" class="form-control" type="text" id="port" name="port">
                    </div>

                    <div class="col-md-4">
                        <label for="username">Username</label>
                        <input wire:model="email_settings.username" class="form-control" type="text" id="username" name="username">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="password">Password</label>
                        <input wire:model="email_settings.password" type="text" class="form-control" id="password" name="password">
                    </div>

                    <div class="col-md-4">
                        <label for="from_email_address">From Address</label>
                        <input wire:model="email_settings.from_email_address" type="email" class="form-control" id="from_email_address" name="from_email_address">
                    </div>

                    <div class="col-md-4">
                        <label for="is_enabled">Emails Enabled?</label>
                        <div class="w-full">
                            <input wire:model="email_settings.is_enabled" class="cursor-pointer" type="checkbox" id="is_enabled" name="is_enabled">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Save Store Email Settings</button>
            </div>
        </form>
    </div>
</div>
