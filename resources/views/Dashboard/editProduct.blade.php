@extends('Dashboard.app')
@extends('flashdata')
@section('title','Tambah Kategori Produk')
@section('pageTitle','Ubah Produk')
@section('back',route('product') )
@section('breadcrumb','Produk')
@section('breadcrumb2','Ubah Produk')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Produk</h4>

                    </div>

                </div>

            </div>
            <div>
                @if (!empty($getProduct))

                <form action="{{ route('editProductAction',[Crypt::encrypt($getProduct->id_product)]) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Kategori Produk</label>
                        <select name="productCategory" class="form form-control form-select-lg" id="">
                            <option value="{{ $getProduct->id_productCategory }}" >
                                {{ $getProduct->id_productCategory }}
                            </option>

                            @foreach ($getProductCategory as $productCategory)
                            <option value="{{ $productCategory->id_productCategory }}">{{ $productCategory->productCategory }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nameProduct" value="{{ $getProduct->nameProduct }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi produk</label>
                        <textarea class="form-control" name="descProduct"> {{ $getProduct->descProduct }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stock" value="{{ $getProduct->stockProduct }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga Awal</label>
                        <input type="number" name="hargaAwal" value="{{ $getProduct->startPrice }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" value="{{ $getProduct->priceProduct }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for=""></label>
                      <input type="file" name="imgProduct" id="" class="form-control" placeholder="" aria-describedby="helpId">

                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form form-control form-select-lg" id="" required>
                            <option value="">--Pilih--</option>
                            <option value="active">Aktif</option>
                            <option value="nonactive">Nonaktif</option>
                        </select>
                    </div>
                    <div id="imagePreviewContainer" class="card">
                        @if (!empty($getProduct->imgProduct))
                        <img id="imagePreview" alt="Image Preview" src="{{ url('Uploads') }}/productCompressed/{{ $getProduct->imgProduct }}" style="max-width: 100%; max-height: 200px;">
                        @else
                        <img id="imagePreview" alt="Image Preview" src="" style="max-width: 100%; max-height: 200px;">
                        @endif

                    </div>
                    <button type="submit" class="btn btn-outline-primary">Selesai</button>
                </form>
                @endif

            </div>

        </div>
    </div>
</div>
@endsection
