<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script'); ?>
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
<?php $__env->stopPush(); ?>
<table id="dataTable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th class="text-capitalize"><?php echo e($column); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td><?php echo e($item[$column]); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td align="right">
                <a href="<?php echo e(route('backend.'.$module.'s.destroy', [$module => $item->id])); ?>" class="btn btn-danger delete">Del</a>
                <a href="<?php echo e(route('backend.'.$module.'s.edit', [$module => $item->id])); ?>" class="btn btn-warning">Edit</a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /app/www/resources/views/includes/table-list.blade.php ENDPATH**/ ?>