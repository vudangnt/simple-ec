@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@endpush
@push('script')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
            $(document).on('click', '.delete', function(e){
                e.preventDefault();
                var $this = $(this);
                $.post({
                    type: 'DELETE',
                    url: $this.attr('href')
                }).done(function (data) {
                    $this.parents('tr').remove();
                });
            });
        });
    </script>
@endpush
<table id="dataTable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            @foreach ($columns as $column)
            <th class="text-capitalize">{{$column}}</th>
            @endforeach
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
        <tr>
            @foreach ($columns as $column)
                <td>{{$item[$column]}}</td>
            @endforeach
            <td align="right">
                <a href="{{route('backend.'.$module.'s.destroy', [$module => $item->id])}}" class="btn btn-danger delete">Del</a>
                <a href="{{route('backend.'.$module.'s.edit', [$module => $item->id])}}" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
