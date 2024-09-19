<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Kategori Pembelian'); ?>
<?php $__env->startSection('pageTitle', 'Kategori Pembelian'); ?>
<?php $__env->startSection('breadcrumb', 'Kategori Pembelian'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Kategori Pembelian</h4>

                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="btn btn-outline-info float-right" href="#" aria-expanded="false"
                                data-toggle="modal" data-target="#addOrderCategory">
                                <i class="fa fa-plus" aria-hidden="true"></i> Kategori Pembelian
                            </a>

                            <div class="modal fade" id="addOrderCategory" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel1"> Tambah Kategori Pembelian
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>

                                        <form action="<?php echo e(route('addOrderCategoryAction')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Nama Kategori Pembelian</label>
                                                    <input type="text" class="form-control" name="orderCategory"
                                                        id="recipient-name1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Logo</label>
                                                    <input type="file" class="form-control" name="imgOrderCategory" onchange="previewImage(event)" id="imgOrderCategory"
                                                        id="recipient-name1">
                                                </div>

                                                <div id="imagePreviewContainer" class="card">
                                                    <img id="imagePreview" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-primary">Selesai</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>
                </div>

            </div>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Pengaturan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $noOrderCategory = 1;

                        ?>
                        <?php $__currentLoopData = $getOrderCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td scope="row"><?php echo e($noOrderCategory); ?></td>
                                <td>
                                    <?php echo e($orderCategory->orderCategory); ?>

                                </td>
                                <td>
                                    <?php echo e($orderCategory->statusOrderCategory); ?>

                                </td>

                                <td>
                                    <div>
                                        <a class="btn btn-outline-info" href="#"
                                            aria-expanded="false" data-toggle="modal" data-target="#modalEditOrder<?php echo e($orderCategory->id_orderCategory); ?>">
                                            <i class="fas fa-edit  "></i>
                                        </a>

                                        <div class="modal fade" id="modalEditOrder<?php echo e($orderCategory->id_orderCategory); ?>" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel1">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="exampleModalLabel1">
                                                            Ubah Kategori Pembelian
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    </div>

                                                    <form action="<?php echo e(route('editOrderCategoryAction',Crypt::encrypt($orderCategory->id_orderCategory))); ?>" enctype="multipart/form-data"
                                                        method="post">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                    class="control-label">Kategori Pembelian</label>
                                                                <input type="text" class="form-control"
                                                                    name="editOrderCategory" value="<?php echo e($orderCategory->orderCategory); ?>" id="recipient-name1">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="control-label">Logo</label>
                                                                <input type="file" class="form-control" name="editImgOrderCategory" onchange="previewImage(event)" id="imgOrderCategory"
                                                                    id="recipient-name1">
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                    class="control-label">Status</label>
                                                                <select name="editStatusOrderCategory" class="form-control" id="">
                                                                    <option value="active">Aktif</option>
                                                                    <option value="nonactive">Tidak Aktif</option>
                                                                </select>
                                                            </div>

                                                            <?php if(!empty($orderCategory->markUp)): ?>
                                                            <div id="imagePreviewContainer" class="card">
                                                                <img id="imagePreview" alt="Image Preview" src="<?php echo e(url('Uploads')); ?>/orderCategoryCompressed/<?php echo e($orderCategory->markUp); ?>" style="max-width: 100%; max-height: 200px;">
                                                            </div>
                                                            <?php else: ?>
                                                            <div id="imagePreviewContainer" class="card">
                                                                <img id="imagePreview" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-outline-primary">Selesai</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <?php
                                $noOrderCategory++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
     <script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('imagePreview');
        var container = document.getElementById('imagePreviewContainer');

        // Ensure that a file was selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Set the source of the image to the preview
                preview.src = e.target.result;
                container.style.display = 'block'; // Show the image container
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(input.files[0]);
        } else {
            // Clear the preview if no file was selected
            preview.src = '';
            container.style.display = 'none'; // Hide the image container
        }
    }
    </script>

    <script>

        $(document).ready(function() {
            $('#productCategory').DataTable({
                lengthMenu: [
                    [25, 50, 100, -1],
                    [25, 50, 100, 'All'],
                ],
                searching: true, // Enable global search bar
                searchCols: [
                    null, // Column 1 (No) - No search input field
                    null, // Column 2 (Rumah) - No search input field
                    null, // Column 3 (Status) - No search input field
                    null, // Column 4 (Tipe) - No search input field
                    null // Column 5 (Tanggal Pre Order) - No search input field
                ],
                autoWidth: true
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/orderCategory.blade.php ENDPATH**/ ?>