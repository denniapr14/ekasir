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




                

            </div>
        </div>

        <script>
            $(document).ready(function() {
                var events = [];
                var calendar = $('#calendar').fullCalendar({
                    initialView: 'dayGridMonth',
                    allDaySlot: false,
                    editable: true,
                    selectable: true,
                    events: function(start, end, timezone, callback) {
                        $.ajax({
                            url: '/getDateSchedule',
                            dataType: 'json',
                            success: function(data) {
                                var events = [];

                                data.forEach(function(event) {
                                    // Check if the required properties are defined before pushing to the events array
                                    if (event && event.id_dateSchedule !== undefined && event.statusDS !== undefined && event.dateDS !== undefined) {
                                        events.push({
                                            id: event.id_dateSchedule,
                                            title: event.statusDS,
                                            start: event.dateDS,
                                        });
                                    }
                                });

                                callback(events);
                                console.log(data);
                            }
                        });
                    }
                });
            });



        </script>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('flashdata', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Skripsi\Kasir\resources\views/Dashboard/scheduleAll.blade.php ENDPATH**/ ?>