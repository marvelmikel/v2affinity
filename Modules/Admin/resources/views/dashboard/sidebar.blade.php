<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('voyager.dashboard') }}">
                    <div class="logo-icon-container">
                        <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                        @if($admin_logo_img == '')
                            <img src="{{ voyager_asset('images/logo.png') }}" alt="Logo Icon">
                        @else
                            <img src="{{ Voyager::image($admin_logo_img) }}" alt="Logo Icon">
                        @endif
                    </div>
                    <div class="title">{{Voyager::setting('admin.title', 'VOYAGER')}}</div>
                </a>
            </div><!-- .navbar-header -->


            @php
                $company_logo = Auth::user()->company && Auth::user()->company->logo ?  asset(Auth::user()->company->logo) : asset('assets/img/logo-placeholder-image.png') ;
            @endphp
            <div class="panel widget center bgimage" style="background-image:url({{ $company_logo }}); background-size: cover; background-position: 0px;">
                <div class="dimmer"></div>
                <div class="panel-content">

                    @if($company = Auth::user()->company )
                        <img src="{{ asset($company->logo) }}" class="avatar" alt="{{ $company->name }} avatar">
                        <h4>{{ ucwords($company->company_name) }}</h4>
                        <p>{{ $company->company_email }}</p>
                    @else
                        <img src="{{ Auth::user()->avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                        <h4>{{ ucwords(Auth::user()->name) }}</h4>
                        <p>{{ Auth::user()->email }}</p>
                    @endif

                    <a href="{{ route('voyager.profile') }}" class="btn btn-primary">{{ __('voyager::generic.profile') }}</a>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
        <div id="adminmenu">
            <admin-menu :items="{{ menu('admin', '_json') }}"></admin-menu>
        </div>
    </nav>
</div>
