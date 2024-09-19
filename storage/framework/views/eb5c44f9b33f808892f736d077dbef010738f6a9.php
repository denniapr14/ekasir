<?php $__env->startSection('title', 'Edit Profile'); ?>
<?php $__env->startSection('pageTitle', 'Edit Profile'); ?>
<?php $__env->startSection('back', route('editProfile')); ?>
<?php $__env->startSection('breadcrumb', 'Edit Profile'); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">

        <div class="card-body">
            <form action="<?php echo e(route('editProfileAction')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="usernameUser" id="" class="form-control"
                        value="<?php echo e($userData->usernameUser); ?>" placeholder="" readonly aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="nameUser" id="" value="<?php echo e($userData->nameUser); ?>"
                        class="form-control" placeholder="" aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="emailUser" id="" value="<?php echo e($userData->emailUser); ?>"
                        class="form-control" placeholder="" aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="addessUser" id="" class="form-control"
                        value="<?php echo e($userData->addressUser); ?>" placeholder="" aria-describedby="helpId">

                </div>

                <div class="form-group">
                    <label for="">No. Phone</label>
                    <input type="tel" name="phoneUser" id="" class="form-control" placeholder=""
                        value="<?php echo e($userData->phoneUser); ?>" aria-describedby="helpId">

                </div>
                <div class="form-group">
                    <label for="">Foto</label>
                    <input type="file" name="photoUser" id="" class="form-control"
                        value="<?php echo e($userData->photoUser); ?>" placeholder="" aria-describedby="helpId">
                    <?php if(!empty($userData->photoUser)): ?>
                        <img src="<?php echo e(url('Uploads/photoUser/', [$userData->photoUser])); ?>"
                            class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                            alt="">
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="passwordUser">Password</label>
                    <div class="input-group">
                        <input type="password" name="passwordUser" id="passwordUser" class="form-control" required placeholder=""
                            aria-describedby="helpId">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="showPasswordToggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>


    <script>
        document.getElementById("showPasswordToggle").addEventListener("click", function() {
            var passwordInput = document.getElementById("passwordUser");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                document.getElementById("showPasswordToggle").innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                document.getElementById("showPasswordToggle").innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/editProfile.blade.php ENDPATH**/ ?>