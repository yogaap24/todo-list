<div class="topbar">
    <!--begin::User-->
    <div class="topbar-item">
        <div class="btn btn-icon w-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
            <div class="d-flex text-right pr-3">
                <span class="text-black opacity-50 font-weight-bold font-size-sm d-none d-md-inline mr-1">Hi,</span>
                <span class="text-black font-weight-bolder font-size-sm d-none d-md-inline">{{(auth()->check()) ? auth()->user()->name : auth()->user()->name}}</span>
            </div>
        </div>
    </div>
    <!--end::User-->
</div>
