@extends('Dashboard.app')
@extends('flashdata')
@section('title', 'Struk Belanja')
@section('pageTitle', 'Struk Belanja')
@section('back', route('transaction'))
@section('breadcrumb', 'Struk Belanja')
{{--  @section('breadcrumb2', 'Tambah Produk')  --}}
@section('content')



<div class="card mx-auto" style="width: 70%">
    <div class="card-body mx-auto">
        <center>

            <h4 class="card-title">Struk Belanja <a href="javascript:void(0)" class="btn btn-outline-info float-right" onclick="printTable()"><i class="fa fa-print" aria-hidden="true"></i></a></h4>
        </center>
        <div id="printTable">

            <br>
            <span class="text-left">
                Jam : {{ date('H:i', strtotime($getOrder->dateInputOrders)) }}
            </span>
            <br>
            <span class="text-left">
                Pembelian Tanggal : {{ tgl_indo(date('Y-m-d', strtotime($getOrder->dateInputOrders))) }}
            </span>
            <table>
                <tr>
                    <th style="width: 10rem">Produk</th>
                    <th style="width: 5rem">Jumlah</th>
                    <th style="width: 10rem">Harga</th>
                </tr>
                @php
                    $sumPrice = 0;
                @endphp
                @foreach ($getOrderDetail as $orderDetail)
                    @php
                        $sumPrice += $orderDetail->totalOrderDetail;
                    @endphp
                    <tr>
                        <td>
                            {{ $orderDetail->nameProduct }}
                        </td>
                        <td>
                            {{ number_format($orderDetail->quantyOrderDetail, 0) }}
                        </td>
                        <td>Rp. {{ number_format($orderDetail->totalOrderDetail, 0) }} ,-
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="text-left" style="">
                        <b>Total Harga : </b>
                    </td>
                    <td>
                        Rp. {{ number_format($sumPrice, 0) }} ,-
                    </td>
                </tr>
            </table>
        </div>
        @if ($getOrder->orderCategory == 'Midtrans')
            <button id="pay-button">Pay!</button>
        @else
            <a href="{{ route('payment', [Crypt::encrypt($getOrder->id_order)]) }}" class="btn btn-outline-success float-right">Selesai</a>
        @endif
    </div>
</div>

    <script>
        function printTable() {
            var printContents = document.getElementById("printTable").outerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $getOrder->orderCode }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    console.log(result);
                    // Redirect to the specified route after successful payment
                    window.location.href = "{{ route('payment', [Crypt::encrypt($getOrder->id_order)]) }}";
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("waiting for your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
