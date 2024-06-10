<x-default-layout>
    @section('breadcrumb')
        @include('components.breadcrumb', [
            'title' => 'Users',
            'createPermission' => 'user-create',
            'createRoute' => route('admin.users.create'),
            'createText' => trans('translation.user_action_add'),
            'deletedPermission' => 'user-delete',
            'deletedRoute' => route('admin.users.create'),
            'deletedText' => trans('translation.user_action_add'),
        ])
    @endsection
    <div class="card card-p-1 card-flush">
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon fs-1 position-absolute ms-4">...</span>
                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14"
                        placeholder="Search Report" />
                </div>
                <!--end::Search-->
                <!--begin::Export buttons-->
                <div id="kt_datatable_example_export" class="d-none"></div>
                <!--end::Export buttons-->
            </div>
            <div class="d-flex">
                {{-- start filter button --}}
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span
                                class="path2"></span></i> Filter
                    </button>
                </div>
                {{-- end filter button --}}
                {{-- start export button --}}
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                    <!--begin::Export dropdown-->
                    <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span
                                class="path2"></span></i>
                        Export Report
                    </button>
                    <!--begin::Menu-->
                    <div id="kt_datatable_example_export_menu"
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="copy">
                                Copy to clipboard
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="excel">
                                Export as Excel
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="csv">
                                Export as CSV
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="pdf">
                                Export as PDF
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Export dropdown-->

                    <!--begin::Hide default export buttons-->
                    <div id="kt_datatable_example_buttons" class="d-none"></div>
                    <!--end::Hide default export buttons-->
                </div>
                {{-- end export button --}}
            </div>
                <!--begin::Group actions-->
    <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
        <div class="fw-bold me-5">
            <span class="me-2" data-kt-docs-table-select="selected_count"></span> Selected
        </div>

        <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="Coming Soon">
            Selection Action
        </button>
    </div>
    <!--end::Group actions-->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle border rounded table-row-dashed fs-6 g-5 px-4"
                    id="kt_datatable_example">
                    <thead>

                        <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true"
                                        data-kt-check-target="#kt_datatable_example .form-check-input"
                                        value="1" />
                                </div>
                            </th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Phone</th>
                            <th>Created at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ URL::asset('assets/custom_js/users.js') }}"></script>
        <script src="{{ URL::asset('assets/custom_js/delete.js') }}"></script>
    @endpush

</x-default-layout>
