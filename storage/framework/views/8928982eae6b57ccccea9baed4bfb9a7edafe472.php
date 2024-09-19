<?php $__env->startSection('title','Tambah Kategori Produk'); ?>
<?php $__env->startSection('pageTitle','Tambah Kategori Produk'); ?>

<?php $__env->startSection('breadcrumb','Produk'); ?>
<?php $__env->startSection('back','produk'); ?>
<?php $__env->startSection('breadcrumb2','Tambah Kategori Produk'); ?>

<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Tambah Kategori Produk</h4>

                    </div>

                </div>

            </div>
            <div>
                <form>
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-label">Kategori Produk</label>
                        <select name="idCategoryProduct" class="form form-control form-select-lg" id="">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>
                    <div class="form-group">

                            <label class="form-label">Nama Produk</label>
                            <input type="email" name="nameProduct" class="form-control">

                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi produk</label>
                        <textarea class="form-control" name="descriptionProduct"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="idCategoryProduct" class="form form-control form-select-lg" id="">
                            <option value="">--Pilih--</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-outline-primary">Selesai</button>
                </form>
            </div>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/addCategoryProduct.blade.php ENDPATH**/ ?>