@extends('Dashboard.app')
@extends('flashdata')
@section('title','Laporan Penjualan')
@section('pageTitle','Laporan Penjualan')
@section('back',route('reportOrder') )
@section('breadcrumb','Laporan Penjualan')
{{--  @section('breadcrumb2','Tambah Produk')  --}}
@section('content')

<div class="card">
  <img class="card-img-top">
  <div class="card-body">
    <h5 class="card-title">Laporan Penjualan  <div class="float-right">
        <button class="btn btn-primary" onclick="printAll()"><i class="fa fa-print" aria-hidden="true"></i></button>

    </div></h5>
<br>

    @php

    $monthNames = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    @endphp
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="filterMonth">Bulan</label>
            <select id="filterMonth" class="form-control">
                <option value="">Pilih Bulan</option>
                @foreach ($monthNames as $index => $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="filterYear">Tahun</label>
            <select id="filterYear" class="form-control">
                <option value="">Pilih Tahun</option>
                @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
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
            {{--  table.column(5).search(month + '-' + year).draw();  --}}
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
        @php
            $no = 1;
        @endphp
        @if (!empty($getOrder))
            @foreach ($getOrder as $order)
            <tr>
                <td >{{$no}}</td>
                <td style="width: 10%">{{ $order->orderCategory }}</td>


                <td>

                Rp. {{ rupiah($order->priceOrder) }}


                </td>
                <td style="width: 50%">
                    <div id="accordion">
                        <div class="card">
                          <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                              <button class="btn btn-link" data-toggle="collapse" data-target="#detail{{ $no }}" aria-expanded="true" aria-controls="collapseOne">
                                Detail Pembelian
                              </button>
                            </h5>
                          </div>

                          <div id="detail{{ $no }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <table>
                                    <thead>

                                        <tr>
                                            <td>Nama Produk</td>
                                            <td>Jumlah</td>
                                            @if ($userData->levelUser=="admin")
                                            <td>Harga Awal</td>
                                            @endif
                                            <td>Harga jual</td>
                                            <td>Untung</td>
                                            <td>Total</td>

                                        </tr>
                                    </thead>
                                    @php
                                    $totalUntung=0;
                                    $hasilTotal=0;
                                    @endphp
                                @foreach ($getOrderDetail as $orderDetail)
                                    @if ($orderDetail->id_order == $order->id_order)
                                    @php
                                        $totalUntung += $orderDetail->totalOrderDetail-($orderDetail->startPrice*$orderDetail->quantyOrderDetail);
                                        $hasilTotal+=$orderDetail->totalOrderDetail;
                                    @endphp
                                    <tbody>

                                        <tr>
                                            <td>

                                                {{ $orderDetail->nameProduct }}
                                            </td>
                                            <td>
                                                {{ $orderDetail->quantyOrderDetail }}
                                            </td>
                                            @if ($userData->levelUser=="admin")
                                            <td>
                                                Rp. {{ rupiah($orderDetail->startPrice) }}
                                            </td>

                                            @endif
                                            <td>
                                                Rp. {{ rupiah($orderDetail->priceProduct) }}
                                            </td>
                                            <td>
                                                Rp. {{ rupiah($orderDetail->totalOrderDetail-($orderDetail->startPrice*$orderDetail->quantyOrderDetail)) }}
                                            </td>
                                            <td>
                                                Rp. {{ rupiah($orderDetail->totalOrderDetail) }}
                                            </td>
                                        </tr>

                                    </tbody>



                                    @endif
                                @endforeach
                                <tr style="border-top: 2px solid black">
                                    <td colspan="4">Jumlah Total</td>
                                    <td>Rp. {{  rupiah($totalUntung) }}</td>
                                    <td>Rp. {{  rupiah($hasilTotal) }}</td>
                                </tr>

                            </table>
                            </div>
                          </div>
                        </div>
                      </div>
                </td>
                <td> {{ tgl_indo(date('Y-m-d', strtotime($order->dateInputOrders))) }}</td>
            </tr>
            @php
                $no++;
            @endphp
            @endforeach
        @else
            <div class="bg-danger rounded">
                <p>Tidak ada data!!</p>
            </div>
        @endif
    </tbody>
   </table>
  </div>
</div>

<script>
    {{--  $(document).ready(function() {
        $('#reportOrder').DataTable({
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
    });  --}}
</script>
@endsection
