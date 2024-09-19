<?php $__env->startSection('flashdata'); ?>
<?php if($message = Session::get('success')): ?>
    <script>
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
              });
              Toast.fire({
                icon: "success",
                title: "<?php echo e($message); ?>"
              });
    });
    </script>
<?php endif; ?>

<?php if($message = Session::get('danger')): ?>
    <script>
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
                }
              });
              Toast.fire({
                icon: "danger",
                title: "<?php echo e($message); ?>"
              });
    });
    </script>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\Skripsi\ekasir\resources\views/flashdata.blade.php ENDPATH**/ ?>