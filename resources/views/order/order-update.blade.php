@extends('main-layout.layout')

@section('title', 'Update order')

@section('content')
<div class="container-fluid">
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Orders</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <b>
    @if(session('warning'))
        <div style="text-align: center" class="alert alert-danger">{{ session('warning') }}</div>
    @endif

    @if(session('warning2'))
        <div style="text-align: center" class="alert alert-danger">{{ session('warning2') }}</div>
    @endif

    @if(session('warning3'))
        <div style="text-align: center" class="alert alert-warning">{{ session('warning3') }}</div>
    @endif

    @if(session('info'))
        <div style="text-align: center" class="alert alert-warning">{{ session('info') }}</div>
    @endif

    @if(session('success'))
        <div style="text-align: center" class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('success2'))
        <div style="text-align: center" class="alert alert-success">{{ session('success2') }}</div>
    @endif
    </b>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Method</th>
                    <th scope="col">Address</th>
                    <th scope="col">Total products</th>
                    <th scope="col">Total price</th>
                    <th scope="col">Order time</th>
                    <th scope="col">Event time</th>
                    <th scope="col">Order status</th>
                    <th scope="col">Proof payment</th>
                    <th scope="col">Payment status</th>
                    <th scope="col">Tanggal</th>
                  </tr>
                <tbody>
                    @foreach($order as $ord)

                  <tr>
                    <td>{{$ord->name}}</td>
                    <td>{{$ord->number}}</td>
                    <td>{{$ord->email}}</td>
                    <td>{{$ord->method}}</td>
                    <td>{{$ord->address}}</td>
                    <td>{{$ord->total_products}}</td>
                    <td>{{$ord->total_price}}</td>
                    <td>{{$ord->order_time}}</td>
                    <td>{{$ord->event_time}}</td>

                    <td>{{$ord->order_status}}</td>
                    <td><a href="{{ route('image.download', ['proof_payment' => $ord->proof_payment]) }}"><img src="{{ asset('bukti/' . $ord->proof_payment) }}" alt="Bukti belum ada" width="90px" height="80px"></a>
                    <td>{{$ord->payment_status}}</td>
                  <td>
                    <a href="{{ url('order-show/'.$ord->id) }}" class="btn btn-info rounded-pill" data-bs-toggle="modal" data-bs-target="#orderUpdate{{$ord->id}}"><i class="bi bi-pencil"></i> Update</button>
                    <a href="{{ url('date-show/'.$ord->id) }}" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#dateUpdate{{$ord->id}}"><i class="bi bi-calendar-day"></i> Undur</button>
                    </td>
                  </tr>

                  <!--Modal start-->
                  <div class="modal fade" id="dateUpdate{{$ord->id}}" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Update tanggal</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="update-form-{{$ord->id}}" action="/date-update/{{$ord->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                               <input type="hidden" name="order_id" value="id">
                               <div style="display: flex; justify-content: center;">
                                    <input style="text-align: center;" type="datetime-local" name="event_time" value="{{$ord->event_time}}">
                                </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <a href="/update" type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('update-form-{{$ord->id}}').submit();">Save changes</a>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Small Modal-->

                  <!--Modal start-->
                  <div class="modal fade" id="orderUpdate{{$ord->id}}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Update status</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="min-height: 210px;">
                            <form id="updated-form-{{$ord->id}}" action="/order-update/{{$ord->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="order_status" class="form-label">Status order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <input type="hidden" name="customer_id" value="{{$ord->customer_id}}">
                                    <select name="order_status" class="form-select" id="order_status" aria-label="State">
                                        <option hidden selected value="{{$ord->order_status}}">{{$ord->order_status}}</option>
                                        <option value=""></option>
                                        <option value="Diterima">Diterima</option>
                                        <option value="Ditolak">Ditolak</option>
                                </select>
                                <label for="payment_status" class="form-label">Status pembayaran</label>
                                <input type="hidden" name="customer_id" value="{{$ord->customer_id}}">
                                <select name="payment_status" class="form-select" id="payment_status" aria-label="State">
                                    <option hidden selected value="{{$ord->payment_status}}">{{$ord->payment_status}}</option>
                                    <option value=""></option>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum lunas">Belum lunas</option>
                                </select>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-info" onclick="event.preventDefault(); document.getElementById('updated-form-{{$ord->id}}').submit();">Update</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div><!-- End Small Modal-->
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>

        </div>
      </div>

  </main><!-- End #main -->
</div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
@endsection
