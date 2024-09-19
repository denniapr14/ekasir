@extends('Dashboard.app')
@extends('flashdata')
@section('title', 'Penjawalan')
@section('pageTitle', 'Penjadwalan')
@section('back', route('schedule'))
@section('breadcrumb', 'Penjawalan')
{{--  @section('breadcrumb2', 'Tambah Produk')  --}}
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h4>Jadwal</h4>

                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            @if ($userData->levelUser == 'admin')
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
                                                <form action="{{ route('addScheduleAction') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <!-- Add your form for editing here -->
                                                        @csrf
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
                            @endif

                        </div>

                    </div>
                    <div>

                    </div>

                </div>




                {{--  <div>
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
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($getDateSchedule as $dateSchedule)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>
                                        {{ changeDayToIndonesian($dateSchedule->dayNameDS) }}
                                    </td>
                                    <td>
                                        {{ tgl_indo($dateSchedule->dateDS) }}
                                    </td>
                                    <td>
                                        @if ($dateSchedule->statusDS == 'work')
                                            <p class="btn btn-outline-primary">Work</p>
                                        @elseif($dateSchedule->statusDS == 'holiday')
                                            <p class="btn btn-outline-warning">Holiday</p>
                                        @else
                                            <!-- Handle other cases or provide a default button -->
                                        @endif
                                    </td>
                                    <td>
                                        @if ($dateSchedule->statusDS == 'work')
                                            <a href="{{ route('changeSchedule', [Crypt::encrypt($dateSchedule->id_dateSchedule), Crypt::encrypt('holiday')]) }}"
                                                class="btn btn-outline-warning"><i class="fas fa-toggle-off    "></i></a>
                                        @else
                                            <a href="{{ route('changeSchedule', [Crypt::encrypt($dateSchedule->id_dateSchedule), Crypt::encrypt('work')]) }}"
                                                class="btn btn-outline-primary"><i class="fas fa-toggle-on    "></i></a>
                                        @endif

                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>

                    </table>
                </div>  --}}

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

    @endsection
