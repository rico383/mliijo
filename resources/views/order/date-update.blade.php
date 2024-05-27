@extends('main-layout.layout2')

@section('title', 'Date update')

@section('session')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Update tanggal</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Update tanggal</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 style="text-align: center" class="card-title">Waktu pengunduran acara</h5>
              <form action="" method="POST" enctype="multipart/form-data">
                @csrf
               <input type="hidden" name="order_id" value="id">
               <div style="display: flex; justify-content: center;">
                    <input style="text-align: center;" type="datetime-local" name="event_time" value="">
                </div><br>
                <div style="display: flex; justify-content: center;">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
               </form>
            </div>
          </div>

        </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection
