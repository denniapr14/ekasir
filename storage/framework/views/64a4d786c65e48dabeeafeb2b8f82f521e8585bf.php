<?php $__env->startSection('title','Tambah User'); ?>
<?php $__env->startSection('pageTitle','Tambah Kasir'); ?>
<?php $__env->startSection('back',route('user') ); ?>
<?php $__env->startSection('breadcrumb','User'); ?>
<?php $__env->startSection('breadcrumb2','Tambah User'); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
        <div class="card-title">
            <h3>
                Tambah Kasir
                </h3>
        </div>

            <form action="<?php echo e(route('addUserAction')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="usernameUser">Username</label>
                <input type="text" class="form-control" name="usernameUser" placeholder="Enter username" required>
            </div>

            <div class="form-group">
                <label for="passwordUser">Password</label>
                <input type="password" class="form-control" name="passwordUser" placeholder="Enter password" required>
            </div>

            <div class="form-group">
                <label for="nameUser">Nama</label>
                <input type="text" class="form-control" name="nameUser" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label for="phoneUser">Nomor Telepon</label>
                <input type="tel" class="form-control" name="phoneUser" placeholder="Enter phone number">
            </div>

            <div class="form-group">
                <label for="emailUser">Email </label>
                <input type="email" class="form-control" name="emailUser" placeholder="Enter email" required>
            </div>

            <div class="form-group">
                <label for="addressUser">Alamat</label>
                <textarea class="form-control" name="addressUser" rows="3" placeholder="Enter address"></textarea>
            </div>

            <div class="form-group">
                <label for="photoUser">Foto</label>
                <input type="file" class="form-control-file" onchange="previewImage(event)" name="photoUser">
            </div>
            <div id="imagePreviewContainer" class="card">
                <img id="imagePreview" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
            </div>

            <button type="submit" class="btn btn-outline-primary">Selesai</button>
        </form>
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/adduser.blade.php ENDPATH**/ ?>