@extends('Dashboard.app')
@extends('flashdata')
@section('title','Tambah Kategori Produk')
@section('pageTitle','Tambah Produk')
@section('back',route('product') )
@section('breadcrumb','Produk')
@section('breadcrumb2','Tambah Produk')
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
                <form action="{{ route('addProductAction') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Kategori Produk</label>
                        <select name="productCategory" class="form form-control form-select-lg" id="">
                            <option value="" >--Pilih--</option>
                            @foreach ($getProductCategory as $productCategory)
                            <option value="{{ $productCategory->id_productCategory }}">{{ $productCategory->productCategory }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nameProduct" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deskripsi produk</label>
                        <textarea class="form-control" name="descProduct"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" name="stock" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga Awal</label>
                        <input type="number" name="hargaAwal" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Gambar Produk</label>
                      <input type="file"  onchange="previewImage(event)" id="imgProduct" class="form-control" placeholder="" aria-describedby="helpId">

                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form form-control form-select-lg" id="">
                            <option value="">--Pilih--</option>
                            <option value="active">Aktif</option>
                            <option value="nonactive">Nonaktif</option>
                        </select>
                    </div>
                    <div id="imagePreviewContainer" class="card">
                        <img id="imagePreview" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Selesai</button>
                </form>
            </div>

        </div>
    </div>
</div>
    <script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('imagePreview');
        var container = document.getElementById('imagePreviewContainer');

        // Ensure that a file was selected
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                // Set the source of the image to the preview
                preview.src = e.target.result;
                container.style.display = 'block'; // Show the image container
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(input.files[0]);
        } else {
            // Clear the preview if no file was selected
            preview.src = '';
            container.style.display = 'none'; // Hide the image container
        }
    }
    </script>
@endsection
