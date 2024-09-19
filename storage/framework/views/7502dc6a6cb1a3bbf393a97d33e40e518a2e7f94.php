<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title', 'Produk'); ?>
<?php $__env->startSection('pageTitle', 'Produk'); ?>
<?php $__env->startSection('breadcrumb', 'Produk'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Produk</h4>

                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="btn btn-outline-info float-right" href="<?php echo e(route('addProduct')); ?>"
                                aria-expanded="false">
                                <i class="fa fa-plus" aria-hidden="true"></i> Produk
                            </a>

                        </div>
                    </div>
                </div>

            </div>
            <div>
                <table class="table" id="product">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Harga Awal </th>
                            <th>Harga Beli (Rp)</th>
                            <th>Stok</th>
                            <th>Pengaturan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $noProduct = 1;

                        ?>
                        <?php $__currentLoopData = $getProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td scope="row"><?php echo e($noProduct); ?></td>
                                <td>
                                    <?php echo e($product->nameProduct); ?>

                                </td>
                                <td>
                                    <?php if($product->statusProduct == 'active'): ?>

                                            <p class="btn waves-effect waves-light btn-rounded btn-outline-success">
                                                Aktif</p>
                                        <?php else: ?>
                                            <p class="btn waves-effect waves-light btn-rounded btn-outline-danger">
                                                Tidak Aktif</p>
                                        <?php endif; ?>
                                </td>
                                <td>
                                    Rp. <?php echo e(rupiah($product->startPrice)); ?>

                                </td>
                                <td>
                                    Rp. <?php echo e(rupiah($product->priceProduct)); ?>

                                </td>
                                <td>
                                    <?php echo e($product->stockProduct); ?>

                                </td>
                                <td>
                                    <a href="<?php echo e(route('editProduct', Crypt::encrypt($product->id_product))); ?>"
                                        class="btn btn-outline-info"><i class="fas fa-edit    "></i></a>

                                    <a class="btn btn-outline-danger" href="#" aria-expanded="false"
                                        data-toggle="modal"
                                        data-target="#deleteProduct<?php echo e($product->id_product); ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <div class="modal fade"
                                        id="deleteProduct<?php echo e($product->id_product); ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalLabel1"> Apakah Anda yakin ingin menghapus produk ini?
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>

                                                <div class="modal-body">
<center>

    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal">Batal</button>
    <a href="<?php echo e(route('deleteProduct', Crypt::encrypt($product->id_product))); ?>" class="btn btn-danger">Hapus</a>

</center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                </td>
                            </tr>
                            <?php
                                $noProduct++;
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Kategori Produk</h4>

                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <div class="dropdown float-lg-end pe-4">
                            <a class="btn btn-outline-info float-right" href="#" aria-expanded="false"
                                data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-plus" aria-hidden="true"></i> Kategori
                            </a>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel1"> Tambah Kategori Produk
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>

                                        <form action="<?php echo e(route('addProductCategoryAction')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">


                                                <div class="form-group">
                                                    <label for="recipient-name" class="control-label">Kategori</label>
                                                    <input type="text" class="form-control" name="productCategory"
                                                        id="recipient-name1">
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
                <div>
                    <table class="table" id="productCategory">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Pengaturan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                            ?>
                            <?php $__currentLoopData = $getProductCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($productCategory->productCategory); ?></td>
                                    <td>
                                        <?php if($productCategory->statusCategory == 'active'): ?>
                                            <p class="btn waves-effect waves-light btn-rounded btn-outline-success">
                                                Aktif</p>
                                        <?php else: ?>
                                            <p class="btn waves-effect waves-light btn-rounded btn-outline-danger">
                                                Tidak Aktif</p>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <div>
                                            <a class="btn btn-outline-info" href="#" aria-expanded="false"
                                                data-toggle="modal"
                                                data-target="#modalEditCategory<?php echo e($productCategory->id_productCategory); ?>">
                                                <i class="fas fa-edit  "></i>
                                            </a>

                                            <div class="modal fade"
                                                id="modalEditCategory<?php echo e($productCategory->id_productCategory); ?>"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="exampleModalLabel1"> Ubah
                                                                Kategori Produk
                                                            </h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        </div>

                                                        <form
                                                            action="<?php echo e(route('editProductCategoryAction', Crypt::encrypt($productCategory->id_productCategory))); ?>"
                                                            enctype="multipart/form-data" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="control-label">Kategori</label>
                                                                    <input type="text" class="form-control"
                                                                        name="editProductCategory"
                                                                        value="<?php echo e($productCategory->productCategory); ?>"
                                                                        id="recipient-name1">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="control-label">Status</label>
                                                                    <select name="editStatusProductCategory"
                                                                        class="form-control" id="">
                                                                        <option value="active">Aktif</option>
                                                                        <option value="nonactive">Tidak Aktif</option>
                                                                    </select>
                                                                </div>
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
                                    $i++;
                                ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            $('#product').DataTable({
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
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/product.blade.php ENDPATH**/ ?>