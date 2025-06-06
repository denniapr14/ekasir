@extends('Dashboard.app')
@extends('flashdata')
@section('title', 'Penjawalan Kasir')
@section('pageTitle', 'Penjadwalan Kasir')
@section('back', route('schedule'))
@section('breadcrumb', 'Penjawalan Kasir')
{{--  @section('breadcrumb2', 'Tambah Produk')  --}}
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h4>Jadwal Kasir</h4>

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
                                                <form action="{{ route('addEmployeeScheduleAction') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <!-- Add your form for editing here -->
                                                        @csrf
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
                                                                @foreach ($getEmployee as $employee)
                                                                    <option value="{{ $employee->id_user }}">
                                                                        {{ $employee->nameUser }}</option>
                                                                @endforeach
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
                                                                    <input type="checkbox" name="morning"
                                                                        class="form-control" value="true">
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" name="afternoon"
                                                                        class="form-control" value="true">
                                                                </td>
                                                                <td>
                                                                    <input type="checkbox" name="night"
                                                                        class="form-control" value="true">
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
                            @endif

                        </div>

                    </div>


                </div>

                <table style="width: 100%" id="tableSchedule" class="table table-borderless table-responsive-lg">
                    <thead>
                        <tr>
                            <th style="width: 1rem">No</th>
                            <th>Tanggal</th>
                            <th>Detail</th>


                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($getEmployeeScheduleDate as $employeeScheduleDate)
                            <tr>
                                <td style="width: 1rem">{{ $no }}</td>
                                <td>
                                    {{ changeDayToIndonesian($employeeScheduleDate->dayNameDS) }},
                                    {{ tgl_indo($employeeScheduleDate->dateDS) }}
                                </td>
                                <td>
                                    <div id="accordian-3">
                                        <div class="card">
                                            <a class="card-header" id="heading11">
                                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#collapse{{ $no }}" aria-expanded="false"
                                                    aria-controls="collapse1">
                                                    <h5 class="m-b-0">Detail</h5>
                                                </button>
                                            </a>
                                            <div id="collapse{{ $no }}" class="collapse"
                                                aria-labelledby="heading11" data-parent="#accordian-3" style="">
                                                <div class="card-body">
                                                    <table>
                                                        @foreach ($getEmployeeSchedule as $employeeSchedule)
                                                            @if ($employeeSchedule->id_dateSchedule == $employeeScheduleDate->id_dateSchedule)
                                                                <tr>
                                                                    <th>Kasir</th>
                                                                    <th>Pagi</th>
                                                                    <th>Siang</th>
                                                                    <th>Malam</th>
                                                                    @if ($userData->levelUser == 'admin')
                                                                        <th>Pengaturan</th>
                                                                    @else
                                                                    @endif

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{ $employeeSchedule->nameUser }}
                                                                    </td>
                                                                    @if (
                                                                        $employeeSchedule->shiftMorning != 'true' &&
                                                                            $employeeSchedule->shiftAfternoon != 'true' &&
                                                                            $employeeSchedule->shiftNight != 'true')
                                                                        <td class=" " colspan="3">
                                                                            <p class="text-info"><b>Libur</b></p>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            @if ($employeeSchedule->shiftMorning == 'true')
                                                                                <i class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                            @else
                                                                                <i class="fa fa-times"
                                                                                    aria-hidden="true"></i>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($employeeSchedule->shiftAfternoon == 'true')
                                                                                <i class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                            @else
                                                                                <i class="fa fa-times"
                                                                                    aria-hidden="true"></i>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($employeeSchedule->shiftNight == 'true')
                                                                                <i class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                            @else
                                                                                <i class="fa fa-times"
                                                                                    aria-hidden="true"></i>
                                                                            @endif
                                                                        </td>
                                                                    @endif

                                                                    <td>
                                                                        @if ($userData->levelUser == 'admin')
                                                                            <a href="#" class="btn btn-outline-info"
                                                                                data-toggle="modal"
                                                                                data-target="#editModalSchedule{{ $employeeSchedule->id_schedule }}"><i
                                                                                    class="fas fa-edit    "></i></a>

                                                                            <a href="#"
                                                                                class="btn btn-outline-danger"
                                                                                data-toggle="modal"
                                                                                data-target="#deleteModal{{ $employeeSchedule->id_schedule }}"><i
                                                                                    class="fa fa-trash"
                                                                                    aria-hidden="true"></i></a>

                                                                            <div class="modal"
                                                                                id="deleteModal{{ $employeeSchedule->id_schedule }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="deleteModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="deleteModalLabel">
                                                                                                Konfirmasi Hapus</h5>
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <span
                                                                                                    aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Apakah Anda yakin ingin
                                                                                            menghapus jadwal kasir ini?
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">Batal</button>
                                                                                            <a href="{{ route('deleteEmployeeSchedule', Crypt::encrypt($employeeSchedule->id_schedule)) }}"
                                                                                                class="btn btn-danger">Hapus</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                        @endif


                                                                        <!-- Edit Modal -->
                                                                        <div class="modal"
                                                                            id="editModalSchedule{{ $employeeSchedule->id_schedule }}"
                                                                            tabindex="-1" role="dialog"
                                                                            aria-labelledby="editModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="editModalLabel">
                                                                                            Edit
                                                                                            Jadwal
                                                                                            Kasir
                                                                                            {{ changeDayToIndonesian($employeeScheduleDate->dayNameDS) }},
                                                                                            {{ tgl_indo($employeeScheduleDate->dateDS) }}
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form
                                                                                        action="{{ route('editEmployeeScheduleAction', Crypt::encrypt($employeeSchedule->id_schedule)) }}"
                                                                                        method="POST"
                                                                                        enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        <div class="modal-body">
                                                                                            <!-- Form for editing content -->


                                                                                            <div class="form-group">
                                                                                                <label for="">Nama
                                                                                                    Kasir</label>
                                                                                                <input type="text"
                                                                                                    id="" readonly
                                                                                                    value="{{ $employeeSchedule->nameUser }}"
                                                                                                    class="form-control"
                                                                                                    placeholder=""
                                                                                                    aria-describedby="helpId">

                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <table
                                                                                                    style="width: 100%; text-align: center">
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
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                name="editMorning"
                                                                                                                class="form-control"
                                                                                                                value="true"
                                                                                                                @if ($employeeSchedule->shiftMorning == 'true') checked @endif>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                name="editAfternoon"
                                                                                                                class="form-control"
                                                                                                                value="true"
                                                                                                                @if ($employeeSchedule->shiftAfternoon == 'true') checked @endif>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                type="checkbox"
                                                                                                                name="editNight"
                                                                                                                class="form-control"
                                                                                                                value="true"
                                                                                                                @if ($employeeSchedule->shiftNight == 'true') checked @endif>
                                                                                                        </td>

                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>


                                                                                        </div>
                                                                                        <div class="modal-footer">

                                                                                            <button type="submit"
                                                                                                class="btn btn-outline-primary float-left">Simpan</button>
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary float-right"
                                                                                                data-dismiss="modal">Close</button>

                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            @else
                                                            @endif
                                                        @endforeach
                                                    </table>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>

                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </tbody>

                </table>

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

@endsection
