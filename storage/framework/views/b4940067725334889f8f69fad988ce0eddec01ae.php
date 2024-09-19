

<?php $__env->startSection('title', 'Penjawalan Kasir'); ?>
<?php $__env->startSection('pageTitle', 'Penjadwalan Kasir'); ?>
<?php $__env->startSection('back', route('schedule')); ?>
<?php $__env->startSection('breadcrumb', 'Penjawalan Kasir'); ?>

<?php $__env->startSection('content'); ?>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Jadwal Kasir</h4>

                    </div>
                    <div class="col-lg-6 col-5 my-auto text-end">
                        <?php if($userData->levelUser == 'admin'): ?>
                        <div class="dropdown float-lg-end pe-4">
                            <a href="#" class="btn btn-outline-info float-right" data-toggle="modal"
                                data-target="#addDate">
                                <i class="fa fa-plus" aria-hidden="true"></i> Jadwal Kasir
                            </a>

                            <!-- View Modal -->
                            <div class="modal fade" id="addDate" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Tambah Jadwal Kasir</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="<?php echo e(route('addEmployeeScheduleAction')); ?>" method="POST"
                                            enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <!-- Add your form for editing here -->
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <label for="">Tanggal Mulai</label>
                                                    <input type="date" name="dateStart" class="form-control">

                                                </div>
                                                <div class="form-group">
                                                    <label for="">Tanggal Berhenti</label>
                                                    <input type="date" name="dateStop" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Kasir</label>
                                                    <select name="user" class="form-control">
                                                        <option value="">--Pilih Kasir--</option>
                                                        <?php $__currentLoopData = $getEmployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($employee->id_user); ?>">
                                                            <?php echo e($employee->nameUser); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <table style="width: 100%; text-align: center">
                                                    <tr>
                                                        <td>Pagi</td>
                                                        <td>Siang</td>
                                                        <td>Malam</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="morning" class="form-control"
                                                                value="true">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="afternoon" class="form-control"
                                                                value="true">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="night" class="form-control"
                                                                value="true">
                                                        </td>

                                                    </tr>
                                                </table>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">Kerja Senin - Minggu : &nbsp;
                                                    </label>
                                                    <input class="form-check-input" type="checkbox" name="fullWeek"
                                                        value="yes">
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

            <div class="row container">
                <div class="col-md-12">
                    <h2 class="text-center"><?php echo e(now()->format('F Y')); ?>

                        <a class="btn btn-oultine-primary" href="<?php echo e(route('getEmployeeSchedule')); ?>">
                            Lihat Semua
                        </a>

                    </h2>



                </div>

                <?php $__currentLoopData = $getDateSchedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateSchedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card <?php echo e($dateSchedule->statusDS == 'work' ? 'border-primary' : 'border-danger'); ?> col-md-4">
                    <div class="card-header <?php echo e($dateSchedule->statusDS == 'work' ? 'bg-primary' : 'bg-danger'); ?>">
                        <h4 class="m-b-0 text-white"><?php echo e(changeDayToIndonesian($dateSchedule->dayNameDS)); ?>,
                            <?php echo e(tgl_indo($dateSchedule->dateDS)); ?></h4>
                    </div>
                    <div class="card-body">
                        <table class="text-center">

                            <?php $__currentLoopData = $getEmployeeSchedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employeeSchedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($employeeSchedule->id_dateSchedule == $dateSchedule->id_dateSchedule): ?>
                            <tr>
                                <th>Kasir</th>
                                <th>Pagi</th>
                                <th>Siang</th>
                                <th>Malam</th>
                                <?php if($userData->levelUser == 'admin'): ?>
                                <th>Pengaturan</th>
                                <?php else: ?>
                                <?php endif; ?>

                            </tr>
                            <tr>
                                <td>
                                    <?php echo e($employeeSchedule->nameUser); ?>

                                </td>
                                <?php if(
                                $employeeSchedule->shiftMorning != 'true' &&
                                $employeeSchedule->shiftAfternoon != 'true' &&
                                $employeeSchedule->shiftNight != 'true'): ?>
                                <td class=" " colspan="3">
                                    <p class="text-info"><b>Libur</b></p>
                                </td>
                                <?php else: ?>
                                <td>
                                    <?php if($employeeSchedule->shiftMorning == 'true'): ?>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <?php else: ?>
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($employeeSchedule->shiftAfternoon == 'true'): ?>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <?php else: ?>
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($employeeSchedule->shiftNight == 'true'): ?>
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    <?php else: ?>
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>


                                <td>
                                    <?php if($userData->levelUser == 'admin'): ?>
                                    <a href="#" class="btn btn-outline-info" data-toggle="modal"
                                        data-target="#editModalSchedule<?php echo e($employeeSchedule->id_schedule); ?>"><i
                                            class="fas fa-edit    "></i></a>

                                    <a href="#" class="btn btn-outline-danger" data-toggle="modal"
                                        data-target="#deleteModal<?php echo e($employeeSchedule->id_schedule); ?>"><i
                                            class="fa fa-trash" aria-hidden="true"></i></a>

                                            <div class="modal" id="deleteModal<?php echo e($employeeSchedule->id_schedule); ?>"
                                                tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">
                                                                Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus jadwal kasir ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <a href="<?php echo e(route('deleteEmployeeSchedule', Crypt::encrypt($employeeSchedule->id_schedule))); ?>"
                                                                class="btn btn-danger">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php else: ?>
                                    <?php endif; ?>


                                    <!-- Edit Modal -->
                                    <div class="modal" id="editModalSchedule<?php echo e($employeeSchedule->id_schedule); ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">
                                                        Edit
                                                        Jadwal
                                                        Kasir
                                                        <?php echo e(changeDayToIndonesian($dateSchedule->dayNameDS)); ?>,
                                                        <?php echo e(tgl_indo($dateSchedule->dateDS)); ?>

                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?php echo e(route('editEmployeeScheduleAction', Crypt::encrypt($employeeSchedule->id_schedule))); ?>"
                                                    method="POST" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <!-- Form for editing content -->


                                                        <div class="form-group">
                                                            <label for="">Nama
                                                                Kasir</label>
                                                            <input type="text" id="" readonly
                                                                value="<?php echo e($employeeSchedule->nameUser); ?>"
                                                                class="form-control" placeholder=""
                                                                aria-describedby="helpId">

                                                        </div>
                                                        <div class="form-group">
                                                            <table style="width: 100%; text-align: center">
                                                                <tr>
                                                                    <td>Pagi
                                                                    </td>
                                                                    <td>Siang
                                                                    </td>
                                                                    <td>Malam
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <input type="checkbox" name="editMorning"
                                                                            class="form-control" value="true"
                                                                            <?php if($employeeSchedule->shiftMorning == 'true'): ?> checked <?php endif; ?>>
                                                                    </td>
                                                                    <td>
                                                                        <input type="checkbox" name="editAfternoon"
                                                                            class="form-control" value="true"
                                                                            <?php if($employeeSchedule->shiftAfternoon == 'true'): ?> checked <?php endif; ?>>
                                                                    </td>
                                                                    <td>
                                                                        <input type="checkbox" name="editNight"
                                                                            class="form-control" value="true"
                                                                            <?php if($employeeSchedule->shiftNight == 'true'): ?> checked <?php endif; ?> >
                                                                    </td>

                                                                </tr>
                                                            </table>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit"
                                                            class="btn btn-outline-primary float-left">Simpan</button>
                                                        <button type="button" class="btn btn-secondary float-right"
                                                            data-dismiss="modal">Close</button>

                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                </td>
                            </tr>
                            <?php else: ?>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </table>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div>

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
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\ekasir\resources\views/Dashboard/employeSchedule.blade.php ENDPATH**/ ?>