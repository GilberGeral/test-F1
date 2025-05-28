<!DOCTYPE html>
<html lang="en">

<head>
  @include('snippets.header_html')
  <link href="{{ asset('template') }}/css/style.min.css" rel="stylesheet" />
  <link href="{{ asset('template') }}/css/styles.css" rel="stylesheet" />
  <script src="{{ asset('template') }}/js/all.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

</head>

<body class="sb-nav-fixed">
  @include('snippets.menu_superior')

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">

      @include('snippets.menu_izquierdo')

    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h3 class="mt-4">Lista de registros</h3>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
              <li class="breadcrumb-item active">Listar registros</li>
            </ol>
            <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="abrirModalCreate()">
              Crear nuevo registro
            </a>
          </div>
          <hr class="m-1">

          <div class="row">
            <table id="myTable" class="table table-striped">
              <thead>
                <tr>
                  <th>Cargando...</th>
                </tr>
              </thead>
            </table>
          </div>

        </div>
      </main>
      @include('snippets.footer')
    </div>

    @include('snippets.modal_create')
  </div>
  <script src="{{ asset('template') }}/js/bootstrap.bundle.min.js" ></script>
  <script src="{{ asset('template') }}/js/jquery-3.7.1.min.js" ></script>  
  <script src="{{ asset('template') }}/js/simple-datatables.min.js" ></script>
  <script src="{{ asset('template') }}/js/datatables-simple-demo.js"></script>
  <script src="{{ asset('template') }}/js/bootbox.min.js" ></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

  <script src="{{ asset('template') }}/js/scripts.js"></script>
</body>

</html>