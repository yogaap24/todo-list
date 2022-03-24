<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">User Profile
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <div class="offcanvas-content pr-5 mr-n5">
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url({{asset('assets/media/users/300_21.png')}})"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{(auth()->check()) ? auth()->user()->username : auth()->user()->name}}</a>
                <div class="text-muted mt-1">{{(auth()->check()) ? auth()->user()->username : auth()->user()->name}}</div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
								<span class="navi-link p-0 pb-2">
									<span class="navi-text text-muted text-hover-primary">{{empty(auth()->user()->email) ? '' : auth()->user()->email}}</span>
								</span>
                    </a>
                    <a href="{{route('app.logout')}}" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                </div>
            </div>
        </div>
        <div class="separator separator-dashed my-7"></div>
    </div>
</div>
