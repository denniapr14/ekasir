<?php $__env->startSection('title','Laporan Penjualan'); ?>
<?php $__env->startSection('pageTitle','Laporan Penjualan'); ?>
<?php $__env->startSection('back',route('reportOrder') ); ?>
<?php $__env->startSection('breadcrumb','Laporan Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<div class="card">
  <img class="card-img-top">
  <div class="card-body">
    <h5 class="card-title">Laporan Penjualan  <div class="float-right">
        <button class="btn btn-primary" onclick="printAll()"><i class="fa fa-print" aria-hidden="true"></i></button>

    </div></h5>
<br>

    <?php

    $monthNames = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    ?>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="filterMonth">Bulan</label>
            <select id="filterMonth" class="form-control">
                <option value="">Pilih Bulan</option>
                <?php $__currentLoopData = $monthNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($month); ?>"><?php echo e($month); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="filterYear">Tahun</label>
            <select id="filterYear" class="form-control">
                <option value="">Pilih Tahun</option>
                <?php for($i = date('Y'); $i >= date('Y') - 10; $i--): ?>
                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </div>

    <script>
        function printAll() {
            var month = $('#filterMonth').val();
            var year = $('#filterYear').val();
            var header = '<h1>Laporan Penjualan ' + (month ? month : '') + ' ' + (year ? year : '') + '</h1>';

            // Expand all detail sections
            $('.collapse').each(function() {
            $(this).addClass('show');
            });

            var printContents = header + document.getElementById('reportOrder').outerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.location.reload(); // Reload the page after printing or canceling print
        }
        $(document).ready(function() {
            var table = $('#reportOrder').DataTable({
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

            $('#filterMonth, #filterYear').change(function() {
                var month = $('#filterMonth').val();
                var year = $('#filterYear').val();
                table.column(4).search(month + ' ' + year).draw();
            });
        });
        $('#filterMonth, #filterYear').change(function() {
            var month = $('#filterMonth').val();
            var year = $('#filterYear').val();
            console.log('Selected Month: ' + month);
            console.log('Selected Year: ' + year);
            
        });
    </script>



   <table class="table table-responsive-lg" id="reportOrder">
    <thead>

        <tr>
            <th style="width: 1rem;">No</th>
            <th>Pembelian</th>

            <th>Total</th>
            <th>Detail</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
        ?>
        <?php if(!empty($getOrder)): ?>
            <?php $__currentLoopData = $getOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td ><?php echo e($no); ?></td>
                <td style="width: 10%"><?php echo e($order->orderCategory); ?></td>


                <td>

                Rp. <?php echo e(rupiah($order->priceOrder)); ?>



                </td>
                <td style="width: 50%">
                    <div id="accordion">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                              <button class="btn btn-link" data-toggle="collapse" data-target="#detail<?php echo e($no); ?>" aria-expanded="true" aria-controls="collapseOne">
                                Detail Pembelian
                              </button>
                            </h5>
                          </div>

                          <div id="detail<?php echo e($no); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <table>
                                    <thead>

                                        <tr>
                                            <td>Nama Produk</td>
                                            <td>Jumlah</td>
                                            <?php if($userData->levelUser=="admin"): ?>
                                            <td>Harga Awal</td>
                                            <?php endif; ?>
                                            <td>Harga jual</td>
                                            <td>Untung</td>
                                            <td>Total</td>

                                        </tr>
                                    </thead>
                                    <?php
                                    $totalUntung=0;
                                    $hasilTotal=0;
                                    ?>
                                <?php $__currentLoopData = $getOrderDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($orderDetail->id_order == $order->id_order): ?>
                                    <?php
                                        $totalUntung += $orderDetail->totalOrderDetail-($orderDetail->startPrice*$orderDetail->quantyOrderDetail);
                                        $hasilTotal+=$orderDetail->totalOrderDetail;
                                    ?>
                                    <tbody>

                                        <tr>
                                            <td>

                                                <?php echo e($orderDetail->nameProduct); ?>

                                            </td>
                                            <td>
                                                <?php echo e($orderDetail->quantyOrderDetail); ?>

                                            </td>
                                            <?php if($userData->levelUser=="admin"): ?>
                                            <td>
                                                Rp. <?php echo e(rupiah($orderDetail->startPrice)); ?>

                                            </td>

                                            <?php endif; ?>
                                            <td>
                                                Rp. <?php echo e(rupiah($orderDetail->priceProduct)); ?>

                                            </td>
                                            <td>
                                                Rp. <?php echo e(rupiah($orderDetail->totalOrderDetail-($orderDetail->startPrice*$orderDetail->quantyOrderDetail))); ?>

                                            </td>
                                            <td>
                                                Rp. <?php echo e(rupiah($orderDetail->totalOrderDetail)); ?>

                                            </td>
                                        </tr>

                                    </tbody>



                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr style="border-top: 2px solid black">
                                    <td colspan="4">Jumlah Total</td>
                                    <td>Rp. <?php echo e(rupiah($totalUntung)); ?></td>
                                    <td>Rp. <?php echo e(rupiah($hasilTotal)); ?></td>
                                </tr>

                            </table>
                            </div>
                          </div>
                        </div>
                      </div>
                </td>
                <td> <?php echo e(tgl_indo(date('Y-m-d', strtotime($order->dateInputOrders)))); ?></td>
            </tr>
            <?php
                $no++;
            ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="bg-danger rounded">
                <p>Tidak ada data!!</p>
            </div>
        <?php endif; ?>
    </tbody>
   </table>
  </div>
</div>

<script>
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/reportOrder.blade.php ENDPATH**/ ?>