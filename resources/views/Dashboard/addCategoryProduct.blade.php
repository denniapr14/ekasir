@extends('Dashboard.app')
@extends('flashdata')
@section('title','Tambah Kategori Produk')
@section('pageTitle','Tambah Kategori Produk')

@section('breadcrumb','Produk')
@section('back','produk')
@section('breadcrumb2','Tambah Kategori Produk')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h4>Tambah Kategori Produk</h4>

                    </div>

                </div>

            </div>
            <div>
                <form>
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Kategori Produk</label>
                        <select name="idCategoryProduct" class="form form-control form-select-lg" id="">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-outline-primary">Selesai</button>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
