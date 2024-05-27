    @extends('main-layout.layout')

    @section('title', 'Product')

    @section('content')
    <div class="container-fluid">

    <main id="main" class="main">

        <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active">Product</li>
            </ol>
        </nav>
        </div><!-- End Page Title -->

        <b>
        @if(session('success'))
            <div style="text-align: center" class="alert alert-success">{{session('success')}}</div>
        @endif

        @if(session('error'))
            <div style="text-align: center" class="alert alert-warning">{{session('error')}}</div>
        @endif

        @if(session('message'))
            <div style="text-align: center" class="alert alert-danger">{{session('message')}}</div>
        @endif

        @error('error')
            <div style="text-align: center" class="alert alert-danger">{{session('error')}}</div>
        @enderror
        </b>

        <div class="card">
            <div class="card-body">
            <h5 style="text-align:center" class="card-title">Masukkan data produk</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-8">
                <label for="name" class="form-label">Name</label>
                <input name="name" type="text" class="form-control" id="name" required>
                </div>
                <div class="col-4">
                    <label for="price" class="form-label">Harga</label>
                    <input name="price" type="text" class="form-control" id="price" onkeypress="if(this.value.length == 16) return false;" required>
                </div>
                <div class="col-4">
                    <label for="category" class="form-label">Kategori</label>
                    <select name="category" class="form-select" id="category" aria-label="State" required>
                        <option value="" disabled selected>Pilih kategori--</option>
                        <option value="Sayuran">Sayuran</option>
                        <option value="Buah-Buahan">Buah-Buahan</option>
                        <option value="Paket Sayur">Paket Sayur</option>
                        <option value="Protein">Protein</option>
                    </select>
                </div>
                <div class="col-8">
                    <div class="form-floating">
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan" id="keterangan" style="height: 100px;"></textarea>
                    <label for="keterangan">Keterangan</label>
                    </div>
                </div>
                <div class="col-12">
                    <label for="image" class="form-label">Gambar</label>
                    <input name="image" type="file" class="form-control" id="image">
                </div>
                <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form><!-- Vertical Form -->

            </div>
        </div>

        <div class="row" style="flex-wrap: wrap;">

            @foreach($product as $prod)

            <div class="col-lg-4">
                <div class="card">
                        <img src="{{ asset('product/'.$prod->image) }}" class="card-img" style="height: 300px;" alt="{{asset('profile/blank.png')}}" onerror="this.onerror=null; this.src='{{ asset('profile/blank.png') }}'">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">{{ $prod->name }}</h5>
                            <p class="card-text">{{ $prod->category }}</p>
                        </div>
                        <b><p class="card-text" style="font-style:italic"><span>Rp. </span>{{number_format($prod->price,2,',','.')}}<span></span></p></b><br>
                        <p class="card-text product-description">{{ $prod->keterangan }}</p>

                        <div class="d-flex justify-content-between">
                            <a href="{{ url('product-show/'.$prod->id) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProduct{{ $prod->id }}"><i class="bi bi-pencil-square"></i> Update</a>
                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal{{$prod->id}}"><i class="bi bi-trash"></i> Delete</button>

                                <!-- Update modal start -->
                                <div class="modal fade" id="updateProduct{{$prod->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Product update</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="min-height: 650px;">
                                                <form id="update-form-{{$prod->id}}" class="row g-3" action="/product-update/{{$prod->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <img src="{{ asset('product/'.$prod->image) }}" alt="{{asset('profile/blank.png')}}" onerror="this.onerror=null; this.src='{{ asset('profile/blank.png') }}'"><br><br>
                                                    <div class="col-6">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input name="name" type="text" class="form-control" id="name" value="{{$prod->name}}" required>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="price" class="form-label">Harga</label>
                                                        <input name="price" type="text" class="form-control" id="price" onkeypress="if(this.value.length == 16) return false;" value="{{$prod->price}}" required>
                                                    </div>
                                                    <div class="col-4">
                                                        <label for="category" class="form-label">Kategori</label>
                                                        <select name="category" class="form-select" id="category" aria-label="State" required>
                                                            <option selected value="{{$prod->category}}" disabled>{{$prod->category}}</option>
                                                            <option value="Sayuran">Sayuran</option>
                                                            <option value="Buah-buahan">Buah-Buahan</option>
                                                            <option value="Paket sayuran">Paket Sayuran</option>
                                                            <option value="Protein">Protein</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="form-floating">
                                                            <textarea name="keterangan" class="form-control" placeholder="Kategori" id="keterangan" style="height: 100px;" required>{{$prod->keterangan}}</textarea>
                                                            <label for="kategory">Keterangan</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="image" class="form-label">Gambar</label>
                                                        <input name="image" type="file" class="form-control" id="image" accept="image/jpg, image/jpeg, image/png, image/webp" value="{{$prod->image}}" required>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="#" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('update-form-{{$prod->id}}').submit();">Save changes</a>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- End Scrolling Modal-->

                            <div class="modal fade" id="basicModal{{$prod->id}}" tabindex="-1">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Confirmation.</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    Yakin untuk menghapus?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <form action="{{ url('product-delete/'.$prod->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" >Ya</button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div><!-- End Basic Modal-->

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>




    </main><!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    </div>
    @endsection
