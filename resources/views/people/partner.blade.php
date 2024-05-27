@extends('main-layout.layout')

@section('title', 'Partner')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Partner</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Partner</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Partner</h5>

                    <b>
                        @if(session('success'))
                            <div style="text-align: center" class="alert alert-success">{{session('success')}}</div>
                        @endif

                        @error('error')
                            <div style="text-align: center" class="alert alert-danger">{{session('error')}}</div>
                        @enderror

                        @if ($errors->any())
                            <div style="text-align: center" class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                            </div>
                        @endif
                    </b>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{route('partner.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-8">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name">
                            </div>
                            <div class="col-4">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email">
                            </div>
                            <div class="col-6">
                                <label for="number" class="form-label">Phone</label>
                                <input name="number" type="text" class="form-control" id="number">
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                <textarea name="keterangan" class="form-control" placeholder="keterangan" id="keterangan" style="height: 100px;"></textarea>
                                <label for="keterangan">Keterangan</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating">
                                <textarea name="address" class="form-control" placeholder="address" id="address" style="height: 100px;"></textarea>
                                <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($partner as $part)
                            <tr>
                                <td>{{$part->name}}</td>
                                <td>{{$part->email}}</td>
                                <td>{{$part->number}}</td>
                                <td>{{$part->keterangan}}</td>
                                <td>{{$part->address}}</td>
                                <td>
                                    <form id="delete-partner-{{$part->id}}" action="/partner-delete/{{$part->id}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" class="btn btn-danger rounded-pill" onclick="event.preventDefault(); confirmDelete({{$part->id}});"><i class="bi bi-trash"> Delete</i></button>
                                    <script>
                                        function confirmDelete(id) {
                                            if (confirm('Delete this account?')) {
                                                document.getElementById('delete-partner-' + id).submit();
                                            }
                                        }
                                            </script>

                                    <button type="submit" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#partnerUpdate{{$part->id}}"><i class="bi bi-pencil"> Update</i></button>
                                </td>
                            </tr>

                                <!--Update admin modal start-->
                                <div class="modal fade" id="partnerUpdate{{$part->id}}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title">Update partner</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="min-height: 330px;">
                                        <div class="col-12">
                                            <form class="row g-3" id="update-partner-{{$part->id}}" action="/partner-update/{{$part->id}}" enctype="multipart/form-data" method="POST">
                                                @csrf
                                                <div class="col-6">
                                                    <label for="name" class="form-label">Name</label>
                                                    <input name="name" type="text" class="form-control" id="name" value="{{$part->name}}">
                                                </div>
                                                <div class="col-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input name="email" type="text" class="form-control" id="email" value="{{$part->email}}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="number" class="form-label">Phone</label>
                                                    <input name="number" type="text" class="form-control" id="number" value="{{$part->number}}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="keterangan" class="form-label">Deskripsi</label>
                                                    <input name="keterangan" type="text" class="form-control" id="keterangan" value="{{$part->keterangan}}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input name="address" type="text" class="form-control" id="address" value="{{$part->address}}">
                                                </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('update-partner-{{$part->id}}').submit();">Save changes</button>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div><!-- End Scrolling Modal-->

                                @endforeach
                            </tbody>
                        </table><!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
