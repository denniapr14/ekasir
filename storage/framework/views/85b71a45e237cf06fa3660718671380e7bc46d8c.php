

<?php $__env->startSection('title','Tambah Kategori Produk'); ?>
<?php $__env->startSection('pageTitle','Ubah Produk'); ?>
<?php $__env->startSection('back',route('product') ); ?>
<?php $__env->startSection('breadcrumb','Produk'); ?>
<?php $__env->startSection('breadcrumb2','Ubah Produk'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Produk</h4>

                    </div>

                </div>

            </div>
            <div>
                <?php if(!empty($getProduct)): ?>

                <form action="<?php echo e(route('editProductAction',[Crypt::encrypt($getProduct->id_product)])); ?>" enctype="multipart/form-data" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label class="form-label">Kategori Produk</label>
                        <select name="productCategory" class="form form-control form-select-lg" id="">
                            <option value="<?php echo e($getProduct->id_productCategory); ?>" >
                                <?php echo e($getProduct->id_productCategory); ?>

                            </option>

                            <?php $__currentLoopData = $getProductCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($productCategory->id_productCategory); ?>"><?php echo e($productCategory->productCategory); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nameProduct" value="<?php echo e($getProduct->nameProduct); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi produk</label>
                        <textarea class="form-control" name="descProduct"> <?php echo e($getProduct->descProduct); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stock" value="<?php echo e($getProduct->stockProduct); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga Awal</label>
                        <input type="number" name="hargaAwal" value="<?php echo e($getProduct->startPrice); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" value="<?php echo e($getProduct->priceProduct); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for=""></label>
                      <input type="file" name="imgProduct" id="" class="form-control" placeholder="" aria-describedby="helpId">

                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form form-control form-select-lg" id="" required>
                            <option value="">--Pilih--</option>
                            <option value="active">Aktif</option>
                            <option value="nonactive">Nonaktif</option>
                        </select>
                    </div>
                    <div id="imagePreviewContainer" class="card">
                        <center>

                            <?php if(!empty($getProduct->imgProduct)): ?>
                            <img id="imagePreview" alt="Image Preview"  class="border" src="<?php echo e(url('Uploads')); ?>/productCompressed/<?php echo e($getProduct->imgProduct); ?>" style="max-width: 40%; ">
                            <?php else: ?>
                            <img id="imagePreview" alt="Image Preview"  class="border" src="<?php echo e(url('Uploads')); ?>/no-image.jpg" style="max-width: 40%; ">
                            <?php endif; ?>
                        </center>

                    </div>
                    <button type="submit" class="btn btn-outline-primary">Selesai</button>
                </form>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\ekasir\resources\views/Dashboard/editProduct.blade.php ENDPATH**/ ?>