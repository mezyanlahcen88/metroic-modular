<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_example">
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
            <th>{{ trans('translation.bank_table_picture') }}</th>
            @foreach ($tableRows as $key => $value)
                <th>{{ trans('translation.' . $model . '_table_' . $value) }} </th>
            @endforeach
            <th class="sort" data-sort="action">{{ trans('translation.general_general_action') }}
            </th>
        </tr>
        <!--end::Table row-->
    </thead>
    <tbody class="fw-semibold text-gray-600 p-1">
        @foreach ($objects as $object)
            <tr class="text-center">
                <td>
                    <div class="symbol symbol-40px symbol-circle">
                        <img src="{{ URL::asset(getPicture($object->avatar, 'clients')) }}" alt="image">
                    </div>
                </td>
                @foreach ($tableRows as $key => $value)
                    <td> {{ $object->$key }}</td>
                @endforeach
                <td>
                    @include('client::actions')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
