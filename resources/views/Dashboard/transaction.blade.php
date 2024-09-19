@extends('Dashboard.app')
@extends('flashdata')
@section('title', 'Transaksi')
@section('pageTitle', 'Transaksi')
@section('back', route('transaction'))
@section('breadcrumb', 'Transaksi')
{{--  @section('breadcrumb2', 'Tambah Produk')  --}}
@section('content')
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
        @foreach ($getProduct as $product)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="el-card-item">
                            <div class="el-card-avatar el-overlay-1">
                                @if ($product->imgProduct != null)
                                    <img src="{{ asset('Uploads/productCompressed/' . $product->imgProduct) }}"
                                        class="card-img-top img-fluid" alt="{{ $product->imgProduct }}"
                                        style="
                                        width: 100%; height: 200px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('Uploads/no-image.jpg') }}" class="card-img-top img-fluid"
                                        alt="tidak ada gambar" style="width: 100%; height: 200px; object-fit: cover;">
                                @endif


                            </div>

                        </div>
                        <br>
                        <div class="container" style="">
                            <h4 class="m-b-0">{{ $product->nameProduct }}</h4>
                            <span class="text-muted"><strong>Price:</strong> Rp.
                                {{ rupiah($product->priceProduct) }}</span>
                            <br>
                            @if ($product->stockProduct == 0)

                            @else
                                <span class="text-muted"><strong>Stok:</strong> {{ $product->stockProduct }}</span>
                            @endif
                        </div>
                        <div class="el-card-content">
                            @if ($product->stockProduct == 0)
                            <span class="text-danger"><center><strong>Habis</strong></center></span>
                        @else
                        <div class="d-flex justify-content-between">
                            <div class="btn-group w-100"  style="width: 25%" role="group" aria-label="Quantity Buttons">
                                <a type="button"
                                    href="{{ route('addTransaction', [Crypt::encrypt($product->id_product), Crypt::encrypt('Plus'), Crypt::encrypt(1), Crypt::encrypt($product->priceProduct), Crypt::encrypt($product->startPrice)]) }}"
                                    class="btn btn-outline-primary w-100">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>

                            <div class="flex-grow-1"></div>


                            <!-- Modal -->


                            <div class="btn-group w-100" role="group" aria-label="Quantity Buttons">
                                <button type="button" class="btn btn-outline-secondary w-100" data-toggle="modal"
                                    data-target="#myModal{{ $product->id_product }}">
                                    Beli
                                </button>
                            </div>
                            <div class="modal fade" id="myModal{{ $product->id_product }}" tabindex="-1" role="dialog"
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
                                            action="{{ route('costumTransactionAction', Crypt::encrypt($product->id_product)) }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">



                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <p>{{ $product->nameProduct }}</p>
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
                                    href="{{ route('addTransaction', [Crypt::encrypt($product->id_product), Crypt::encrypt('Minus'), Crypt::encrypt(1), Crypt::encrypt($product->priceProduct),Crypt::encrypt($product->startPrice) ]) }}"
                                    class="btn btn-outline-danger w-100">
                                    <i class="fa fa-minus"></i>
                                </a>
                            </div>
                        </div>
                        @endif

                        </div>
                    </div>

                </div>
            </div>
        @endforeach
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                {{ $getProduct->links() }}
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
                    <form action="{{ route('checkoutAction',Crypt::encrypt($userData->id_user)) }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                        @php
                                            $totalHarga = 0;
                                        @endphp
                                        @foreach ($getCart as $cart)
                                            @php
                                                $totalHarga += $cart->priceCart;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $cart->nameProduct }}
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-outline-danger btn-update-quantity"
                                                        data-id="{{ $cart->id_cart }}"
                                                        data-product-id="{{ $cart->id_product }}"
                                                        data-action="decrement"><i class="fa fa-minus"
                                                            aria-hidden="true"></i></a>
                                                    <span class="cart-quantity">{{ $cart->quantyCart }}</span>
                                                    <a href="#" class="btn btn-outline-success btn-update-quantity"
                                                        data-id="{{ $cart->id_cart }}"
                                                        data-product-id="{{ $cart->id_product }}"
                                                        data-action="increment"><i class="fa fa-plus"
                                                            aria-hidden="true"></i></a>
                                                </td>
                                                <td class="cart-total-price">{{ rupiah($cart->priceCart) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>
                                <div class="float-right" id="totalHarga">
                                    <h4>
                                        Total Harga: {{ rupiah($totalHarga) }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Pembayaran</h4>
                                <div class="row" style="overflow-y: scroll">
                                    @foreach ($getOrderCategory as $orderCategory)
                                    <div class="card col-md-4">
                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1">
                                                <img src="{{ asset('Uploads/orderCategoryCompressed/' . $orderCategory->markUp) }}"
                                                    class="card-img-top img-fluid" alt="tidak ada gambar"
                                                    style="width: 100%; object-fit: cover;">
                                            </div>
                                            <div class="el-card-content">
                                                <center>
                                                    <input type="radio" name="selectedOrderCategory" value="{{ $orderCategory->id_orderCategory }}">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
            let totalHarga = {{ $totalHarga }}; // Initialize totalHarga with the PHP variable

            $('.btn-update-quantity').on('click', function() {
                var cartId = $(this).data('id');
                var action = $(this).data('action');
                var quantityElement = $(this).parent().find('.cart-quantity');
                var totalPriceElement = $(this).closest('tr').find('.cart-total-price');

                $.ajax({
                    type: 'POST',
                    url: '/update-cart-quantity/' + cartId + '/' + action,
                    data: {
                        _token: '{{ csrf_token() }}'
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



@endsection
