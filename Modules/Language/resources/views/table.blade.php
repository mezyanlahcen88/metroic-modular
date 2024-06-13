<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_example">
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
            @foreach ($tableRows as $key => $value)
                <th>{{ trans('translation.' . $model . '_table_' . $value) }} </th>
            @endforeach
            <td>{{ trans('translation.language_table_status')}}</td>
            <th class="sort" data-sort="action">{{ trans('translation.general_general_action') }}
            </th>
        </tr>
        <!--end::Table row-->
    </thead>
    <tbody class="fw-semibold text-gray-600 p-1">
        @foreach ($objects as $object)
            <tr class="text-center">
                @foreach ($tableRows as $key => $value)
                    <td> {{ $object->$key }}</td>
                @endforeach
                <td>
                    <div class="form-check form-switch d-flex justify-content-center">
                        <input class="form-check-input default"
                            data-route-name="{{ route('language.changestatus') }}" type="checkbox"
                            role="switch" data-id="{{ $object->id }}"
                            {{ $object->isDefault ? 'checked' : '' }}>
                    </div>
                </td>
                <td>
                    <div class="form-check form-switch d-flex justify-content-center">
                        <input class="form-check-input changeStatus"
                            data-route-name="{{ route('language.changestatus') }}" type="checkbox"
                            role="switch" data-id="{{ $object->id }}"
                            {{ $object->status ? 'checked' : '' }}>
                    </div>
                </td>
                <td>
                    @include('language::actions')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
