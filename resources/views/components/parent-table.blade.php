<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showFormAdd" type="button">{{ trans('parent-translation.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('parent-translation.email') }}</th>
            <th>{{ trans('parent-translation.name_father') }}</th>
            <th>{{ trans('parent-translation.national_id_father') }}</th>
            <th>{{ trans('parent-translation.passport_id_father') }}</th>
            <th>{{ trans('parent-translation.phone_father') }}</th>
            <th>{{ trans('parent-translation.job_father') }}</th>
            <th>{{ trans('parent-translation.processes') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($parents as $parent)
            <tr>
                <td>{{ $parent->id }}</td>
                <td>{{ $parent->email }}</td>
                <td>{{ $parent->father_name }}</td>
                <td>{{ $parent->father_national_id }}</td>
                <td>{{ $parent->father_passport_id }}</td>
                <td>{{ $parent->father_phone }}</td>
                <td>{{ $parent->father_job }}</td>
                <td>
                    <button wire:click="edit({{ $parent->id }})" title="{{ trans('grade-translation .edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $parent->id }})" title="{{ trans('grade-translation .delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>