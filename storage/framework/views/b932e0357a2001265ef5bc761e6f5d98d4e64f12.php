<?php $__env->startSection('title', 'Penjawalan'); ?>
<?php $__env->startSection('pageTitle', 'Penjadwalan'); ?>
<?php $__env->startSection('back', route('schedule')); ?>
<?php $__env->startSection('breadcrumb', 'Penjawalan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h4>Jadwal</h4>

                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <?php if($userData->levelUser == 'admin'): ?>
                                <div class="dropdown float-lg-end pe-4">
                                    <a href="#" class="btn btn-outline-info float-right" data-toggle="modal"
                                        data-target="#addDate">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Jadwal
                                    </a>

                                    <!-- View Modal -->
                                    <div class="modal fade" id="addDate" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Tambah Jadwal</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?php echo e(route('addScheduleAction')); ?>" method="POST"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <!-- Add your form for editing here -->
                                                        <?php echo csrf_field(); ?>
                                                        <div class="form-group">
                                                            <label for="">Tahun</label>
                                                            <input type="number" name="years" id="years"
                                                                class="form-control" placeholder=""
                                                                aria-describedby="helpId" min="2000" max="3000">

                                                        </div>


                                                        <!-- Add other fields as needed -->


                                                    </div>
                                                    <div class="modal-footer">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <button type="submit"
                                                                        class="btn btn-outline-info">Simpan</button>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-outline-danger"
                                                                        data-dismiss="modal">Close</button>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>
                    <div>

                    </div>

                </div>




                
                <div>

                    <div class="row container">
                        <div class="col-md-12">
                            <h2 class="text-center"><?php echo e(now()->format('F Y')); ?>

                                <button type="button" class="btn btn-oultine-primary" data-toggle="modal" data-target="#myModal">
                                    Lihat Semua
                                </button>

                            </h2>


                            <!-- The Modal -->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Keseluruhan Jadwal</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <table style="width: 100%" id="tableSchedule" class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Hari</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Pengaturan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $no = 1;
                                                    ?>
                                                    <?php $__currentLoopData = $getDateScheduleAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateSchedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($no); ?></td>
                                                            <td>
                                                                <?php echo e(changeDayToIndonesian($dateSchedule->dayNameDS)); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e(tgl_indo($dateSchedule->dateDS)); ?>

                                                            </td>
                                                            <td>
                                                                <?php if($dateSchedule->statusDS == 'work'): ?>
                                                                    <p class="btn btn-outline-primary">Work</p>
                                                                <?php elseif($dateSchedule->statusDS == 'holiday'): ?>
                                                                    <p class="btn btn-outline-danger">Holiday</p>
                                                                <?php else: ?>
                                                                    <!-- Handle other cases or provide a default button -->
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if($dateSchedule->statusDS == 'work'): ?>
                                                                    <a href="<?php echo e(route('changeSchedule', [Crypt::encrypt($dateSchedule->id_dateSchedule), Crypt::encrypt('holiday')])); ?>"
                                                                        class="btn btn-outline-danger"><i class="fas fa-toggle-off    "></i></a>
                                                                <?php else: ?>
                                                                    <a href="<?php echo e(route('changeSchedule', [Crypt::encrypt($dateSchedule->id_dateSchedule), Crypt::encrypt('work')])); ?>"
                                                                        class="btn btn-outline-primary"><i class="fas fa-toggle-on    "></i></a>
                                                                <?php endif; ?>

                                                            </td>
                                                        </tr>
                                                        <?php
                                                            $no++;
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>

                                            </table>
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $__currentLoopData = $getDateSchedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateSchedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card <?php echo e($dateSchedule->statusDS == 'work' ? 'border-primary' : 'border-danger'); ?> col-md-2">
                                <div class="card-header <?php echo e($dateSchedule->statusDS == 'work' ? 'bg-primary' : 'bg-danger'); ?>">
                                    <h4 class="m-b-0 text-white"><?php echo e(changeDayToIndonesian($dateSchedule->dayNameDS)); ?></h4>
                                </div>
                                <div class="card-body">
                                    <?php echo e(tgl_indo($dateSchedule->dateDS)); ?>  <?php if($dateSchedule->statusDS == 'work'): ?>
                                    <a href="<?php echo e(route('changeSchedule', [Crypt::encrypt($dateSchedule->id_dateSchedule), Crypt::encrypt('holiday')])); ?>"
                                        class="btn btn-outline-danger"><i class="fas fa-toggle-off    "></i></a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('changeSchedule', [Crypt::encrypt($dateSchedule->id_dateSchedule), Crypt::encrypt('work')])); ?>"
                                        class="btn btn-outline-primary"><i class="fas fa-toggle-on    "></i></a>
                                <?php endif; ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#tableSchedule').DataTable({
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
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/schedule.blade.php ENDPATH**/ ?>