<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pengadaan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    @include('parsil.user')

    <!-- Right navbar links -->
    @include('parsil.setting')
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      @include('parsil.user')

      @include('parsil.menu')
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>List Suplier</h1>
            </div>
            <div class="col-sm-6">
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- /.row -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Suplier</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Nama Usaha</th>
                        <th>Email</th>
                        <th>Almat</th>
                        <th>no mpwp</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($suplier as $adm)
                      <tr>
                        <td>{{$adm->nama_usaha}}</td>
                        <td>{{$adm->email}}</td>
                        <td>{{$adm->alamat}}</td>
                        <td>
                          {{$adm->no_npwp}}
                        </td>
                        <td>
                          @if($adm->status == "0")
                          <a href="/Aktif/{{$adm->id_suplier}}" class="btn btn-success konfirmasi"><i class="fa fa-check"></i>verifikasi</a>
                          @else
                          <a href="/nonAktif/{{$adm->id_suplier}}" class="btn btn-danger konfirmasi"><i class="fa fa-times"></i>non aktif</a>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('parsil.footer')
    

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
  <!-- SweetAlert2 -->
  <script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      @if(\Session::has('berhasil'))
      Toast.fire({
        icon: 'success',
        title: '{{Session::get('berhasil')}}'
      })
      @endif
      @if(\Session::has('gagal'))
      Toast.fire({
        icon: 'error',
        title:  '{{Session::get('berhasil')}}'
      })
      @endif

      @if(count($errors) > 0)
      Toast.fire({
        icon: 'error',
        title:  '<ul>@foreach($errors->all() as $error)<li>{{$error}}</li> @endforeach</ul>'
      })

      @endif
    });


    $(document).on("click", ".konfirmasi", function(event){
      event.preventDefault();
      const url = $(this).attr('href');

      var answer = window.confirm("kamu yakin ingin memprosess data ini?");

      if (answer) {
        window.location.href = url;
      }else{

      }

    });
  </script>


</body>
</html>
