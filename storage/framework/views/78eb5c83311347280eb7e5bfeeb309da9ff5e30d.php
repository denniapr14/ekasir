<?php $__env->startSection('title','User'); ?>
<?php $__env->startSection('pageTitle','User'); ?>
<?php $__env->startSection('back',route('user') ); ?>
<?php $__env->startSection('breadcrumb','User'); ?>

<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>User</h4>

                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="btn btn-outline-info float-right" href="<?php echo e(route('addUser')); ?>" >
                                <i class="fa fa-plus" aria-hidden="true"></i> User
                            </a>

                        </div>

                    </div>

                </div>
                <div>

                </div>

            </div>

            <div>
                <table style="width: 100%" id="tableUser" class="table table-borderless">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Detail</th>
                            <th>Pengaturan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no=1;
                        ?>
                        <?php $__currentLoopData = $getUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><?php echo e($no); ?></td>
                            <td><?php echo e($user->nameUser); ?></td>
                            <td>

                                    <span>nomor HP : <?php echo e($user->phoneUser); ?></span>
                                    <br>
                                    <span>email : <?php echo e($user->emailUser); ?></span>
                                    <br>
                                    <span>Level : <?php echo e($user->levelUser); ?></span>

                            </td>
                            <td>
                                <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#viewModal<?php echo e($user->id_user); ?>">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>

                                <a href="#" class="btn btn-outline-info" data-toggle="modal" data-target="#editModal<?php echo e($user->id_user); ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Delete Button -->
                                <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal<?php echo e($user->id_user); ?>">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal<?php echo e($user->id_user); ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this user?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <a href="<?php echo e(route('deleteUser', Crypt::encrypt($user->id_user))); ?>" class="btn btn-outline-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- View Modal -->
                                <div class="modal fade" id="viewModal<?php echo e($user->id_user); ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewModalLabel">User Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Status</th>
                                                        <td>
                                                            <?php if($user->statusUser == 'nonactive'): ?>
                                                                <span class="fw-bold text-danger"><b><?php echo e($user->statusUser); ?></b></span>
                                                            <?php else: ?>
                                                                <span class="fw-bold text-success"><b><?php echo e($user->statusUser); ?></b></span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Username</th>
                                                        <td><?php echo e($user->usernameUser); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Name</th>
                                                        <td><?php echo e($user->nameUser); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Phone</th>
                                                        <td><?php echo e($user->phoneUser); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Email</th>
                                                        <td><?php echo e($user->emailUser); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Alamat</th>
                                                        <td><?php echo e($user->addressUser); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Photo</th>
                                                        <td><img src="<?php echo e(url('Uploads')); ?>/photoUserCompressed/<?php echo e($user->photoUser); ?>" alt="User Photo" style="width: 100%"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Level</th>
                                                        <td><?php echo e($user->levelUser); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal<?php echo e($user->id_user); ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Ubah User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Add your form for editing here -->
                                                <form action="<?php echo e(route('editUserAction', Crypt::encrypt($user->id_user))); ?>" method="POST" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group">
                                                        <label for="editName">Nama</label>
                                                        <input type="text" class="form-control" name="editName" value="<?php echo e($user->nameUser); ?>" placeholder="Enter edited name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editPhone">No Telepon</label>
                                                        <input type="text" class="form-control" name="editPhone" value="<?php echo e($user->phoneUser); ?>" placeholder="Enter edited phone">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="editEmail">Email</label>
                                                        <input type="email" class="form-control" name="editEmail" value="<?php echo e($user->emailUser); ?>" placeholder="Enter edited email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editEmail">Alamat</label>
                                                        <textarea  class="form-control" name="editAddress" ><?php echo e($user->addressUser); ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editStatus">Status</label>
                                                        <select name="statusUser" class="form-control">
                                                            <option value="active" <?php echo e($user->statusUser == 'active' ? 'selected' : ''); ?>>Active</option>
                                                            <option value="nonactive" <?php echo e($user->statusUser == 'nonactive' ? 'selected' : ''); ?>>Nonactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="editEmail">Level</label>
                                                        <select name="editLevel" class="form-control" id="">
                                                            <option value="kasir">Kasir</option>
                                                            <option value="costumer">Costumer</option>
                                                            <option value="admin">Admin</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="photoUser">Foto</label>
                                                        <input type="file" class="form-control-file" onchange="previewImage(event)" name="editPhotoUser">
                                                    </div>
                                                    <div id="imagePreviewContainer" class="card">
                                                        <img id="imagePreview" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                                    </div>

                                                    <!-- Add other fields as needed -->

                                                    <button type="submit" class="btn btn-outline-info">Simpan</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <?php
                            $no++;
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
        $('#tableUser').DataTable({
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
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/user.blade.php ENDPATH**/ ?>