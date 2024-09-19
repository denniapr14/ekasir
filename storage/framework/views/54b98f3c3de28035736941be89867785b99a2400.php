

<?php $__env->startSection('title', 'Transaksi'); ?>
<?php $__env->startSection('pageTitle', 'Transaksi'); ?>
<?php $__env->startSection('back', route('transaction')); ?>
<?php $__env->startSection('breadcrumb', 'Transaksi'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        .hidden {
            display: none;
        }

        .floating-cart-button {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background-color: #007BFF;
            color: #FFFFFF;
            border: none;
            border-radius: 50%;
            width: 5rem;
            height: 5rem;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="row">
        <?php $__currentLoopData = $getProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="el-card-item">
                            <div class="el-card-avatar el-overlay-1">
                                <?php if($product->imgProduct != null): ?>
                                    <img src="<?php echo e(asset('Uploads/productCompressed/' . $product->imgProduct)); ?>"
                                        class="card-img-top img-fluid" alt="<?php echo e($product->imgProduct); ?>"
                                        style="
                                        width: 100%; height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('Uploads/no-image.jpg')); ?>" class="card-img-top img-fluid"
                                        alt="tidak ada gambar" style="width: 100%; height: 200px; object-fit: cover;">
                                <?php endif; ?>


                            </div>

                        </div>
                        <br>
                        <div class="container" style="">
                            <h4 class="m-b-0"><?php echo e($product->nameProduct); ?></h4>
                            <span class="text-muted"><strong>Price:</strong> Rp.
                                <?php echo e(rupiah($product->priceProduct)); ?></span>
                            <br>
                            <?php if($product->stockProduct == 0): ?>

                            <?php else: ?>
                                <span class="text-muted"><strong>Stok:</strong> <?php echo e($product->stockProduct); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="el-card-content">
                            <?php if($product->stockProduct == 0): ?>
                            <span class="text-danger"><center><strong>Habis</strong></center></span>
                        <?php else: ?>
                        <div class="d-flex justify-content-between">
                            <div class="btn-group w-100"  style="width: 25%" role="group" aria-label="Quantity Buttons">
                                <a type="button"
                                    href="<?php echo e(route('addTransaction', [Crypt::encrypt($product->id_product), Crypt::encrypt('Plus'), Crypt::encrypt(1), Crypt::encrypt($product->priceProduct), Crypt::encrypt($product->startPrice)])); ?>"
                                    class="btn btn-outline-primary w-100">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>

                            <div class="flex-grow-1"></div>


                            <!-- Modal -->


                            <div class="btn-group w-100" role="group" aria-label="Quantity Buttons">
                                <button type="button" class="btn btn-outline-secondary w-100" data-toggle="modal"
                                    data-target="#myModal<?php echo e($product->id_product); ?>">
                                    Beli
                                </button>
                            </div>
                            <div class="modal fade" id="myModal<?php echo e($product->id_product); ?>" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pembelian</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form
                                            action="<?php echo e(route('costumTransactionAction', Crypt::encrypt($product->id_product))); ?>"
                                            method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">



                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <p><?php echo e($product->nameProduct); ?></p>
                                                    <input type="number" name="countProduct" class="form-control"
                                                        placeholder="masukan jumlah pembelian" aria-describedby="helpId" min="1" >


                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="btn-group w-100" role="group" aria-label="Quantity Buttons">
                                <a type="button"
                                    href="<?php echo e(route('addTransaction', [Crypt::encrypt($product->id_product), Crypt::encrypt('Minus'), Crypt::encrypt(1), Crypt::encrypt($product->priceProduct),Crypt::encrypt($product->startPrice) ])); ?>"
                                    class="btn btn-outline-danger w-100">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php echo e($getProduct->links()); ?>

            </ul>
        </nav>

        <div class="floating-cart-button" data-toggle="modal" data-target="#cartModal">
            <i class="fas fa-cart-plus    "></i>
        </div>

        <!-- Bootstrap Modal -->
        <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Keranjang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('checkoutAction',Crypt::encrypt($userData->id_user))); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>

                                        </tr>
                                    </thead>
                                    <tbody id="cartTableBody">
                                        <?php
                                            $totalHarga = 0;
                                        ?>
                                        <?php $__currentLoopData = $getCart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $totalHarga += $cart->priceCart;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($cart->nameProduct); ?>

                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-outline-danger btn-update-quantity"
                                                        data-id="<?php echo e($cart->id_cart); ?>"
                                                        data-product-id="<?php echo e($cart->id_product); ?>"
                                                        data-action="decrement"><i class="fa fa-minus"
                                                            aria-hidden="true"></i></a>
                                                    <span class="cart-quantity"><?php echo e($cart->quantyCart); ?></span>
                                                    <a href="#" class="btn btn-outline-success btn-update-quantity"
                                                        data-id="<?php echo e($cart->id_cart); ?>"
                                                        data-product-id="<?php echo e($cart->id_product); ?>"
                                                        data-action="increment"><i class="fa fa-plus"
                                                            aria-hidden="true"></i></a>
                                                </td>
                                                <td class="cart-total-price"><?php echo e(rupiah($cart->priceCart)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table>
                                <div class="float-right" id="totalHarga">
                                    <h4>
                                        Total Harga: <?php echo e(rupiah($totalHarga)); ?>

                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Pembayaran</h4>
                                <div class="row" style="overflow-y: scroll">
                                    <?php $__currentLoopData = $getOrderCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card col-md-4">
                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1">
                                                <img src="<?php echo e(asset('Uploads/orderCategoryCompressed/' . $orderCategory->markUp)); ?>"
                                                    class="card-img-top img-fluid" alt="tidak ada gambar"
                                                    style="width: 100%; object-fit: cover;">
                                            </div>
                                            <div class="el-card-content">
                                                <center>
                                                    <input type="radio" name="selectedOrderCategory" value="<?php echo e($orderCategory->id_orderCategory); ?>">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function formatRupiah(amount) {
            var rupiah = '';
            var amountString = String(amount);

            var splitAmount = amountString.split('.');
            var integerPart = splitAmount[0];
            var decimalPart = splitAmount.length > 1 ? '.' + splitAmount[1] : '';

            var count = 0;
            for (var i = integerPart.length - 1; i >= 0; i--) {
                rupiah = integerPart[i] + rupiah;
                count++;
                if (count % 3 === 0 && i !== 0) {
                    rupiah = '.' + rupiah;
                }
            }

            return 'Rp ' + rupiah + decimalPart;
        }

        $(document).ready(function() {
            let totalHarga = <?php echo e($totalHarga); ?>; // Initialize totalHarga with the PHP variable

            $('.btn-update-quantity').on('click', function() {
                var cartId = $(this).data('id');
                var action = $(this).data('action');
                var quantityElement = $(this).parent().find('.cart-quantity');
                var totalPriceElement = $(this).closest('tr').find('.cart-total-price');

                $.ajax({
                    type: 'POST',
                    url: '/update-cart-quantity/' + cartId + '/' + action,
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update the displayed quantity
                            if (action == 'increment' && response.quantity > response.productStock) {
                                alert('Produk sudah habis');
                                return;
                            }
                            quantityElement.text(response.quantity);
                            totalPriceElement.text(response.totalPrice);
                            if (response.quantity == 0 && action == 'decrement') {
                                totalHarga = totalHarga - parseFloat(response.price);
                                $(quantityElement).closest('tr').remove();
                            } else if (action == 'decrement') {
                                totalHarga = totalHarga - parseFloat(response.price);
                            } else {
                                totalHarga = totalHarga + parseFloat(response.price);
                            }

                            // Update the total harga based on the response
                            updateTotalHarga(totalHarga);
                        } else {
                            alert('Failed to update quantity');
                        }
                    },
                    error: function() {
                        alert('Error updating quantity');
                    }
                });
            });

            function updateTotalHarga(newTotalHarga) {
                // Display the updated total harga
                $('#totalHarga').text('Total Harga: ' + formatRupiah(newTotalHarga));
            }
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\ekasir\resources\views/Dashboard/transaction.blade.php ENDPATH**/ ?>