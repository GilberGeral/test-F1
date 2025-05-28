<!DOCTYPE html>
<html lang="en">

<head>
  @include('snippets.header_html')
  <link href="{{ asset('template') }}/css/style.min.css" rel="stylesheet" />
  <link href="{{ asset('template') }}/css/styles.css" rel="stylesheet" />
  <script src="{{ asset('template') }}/js/all.js" crossorigin="anonymous"></script>
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
          <h3 class="mt-4">Carga de  archivo</h3>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Cargar archivo</li>
          </ol>
          <div class="card mb-4">
            <div class="card-body">
              Seleccione el archivo a cargar, debe ser formato <b>CSV</b> y tener las columnas <b>id</b>, <b>nombre</b> y <b>descripcion.</b>
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-sm-12 col-md-4 ">
              <div>
                <label for="formFileLg" class="form-label">Seleccione archivo</label>
                <input class="form-control form-control-lg" id="fileSVG" name="fileSVG" accept=".csv" type="file">
              </div>
              <hr>
              <p>Opciones de carga <br><small class="text-danger"><i>seleccione una</i></small></p>
              <?php
                $opciones = ['borrar','combinar','mantener'];
                $textos = ['borrar antiguos y dejar solo estos','registrar estos y si un ID ya existe, actualizarlo','registrar estos y si un ID ya existe, ignorar el nuevo'];
                for ($i=0; $i < count($opciones); $i++) {
                  
                    echo '<div class="form-check">
                      <input class="form-check-input" type="radio" name="opcion" id="'.$opciones[$i].'" value="'.$opciones[$i].'" >
                      <label class="form-check-label hand" for="'.$opciones[$i].'">
                        '.$textos[$i].'
                      </label>
                    </div>';
                  
                  
                }
              ?>
              <button type="button" class="btn btn-primary mt-2 w-100" onclick="cargarArchivo()">Cargar</button>
            </div>
            <div class="col-12 col-sm-12 col-md-8 ">
              <span>Resultado</span>
              <div class="mb-4" id="frame_resultado" name="frame_resultado">
                <div class="alert alert-light" role="alert">
                  Diligencie el formulario y haga click en el boton <i><b>Cargar</b></i> para cargar el archivo.
                </div>
              </div>
            </div>
          </div>

        </div>
      </main>
      @include('snippets.footer')
    </div>
  </div>
  <script src="{{ asset('template') }}/js/bootstrap.bundle.min.js" ></script>
  <script src="{{ asset('template') }}/js/jquery-3.7.1.min.js" ></script>  
  <script src="{{ asset('template') }}/js/simple-datatables.min.js" ></script>
  <script src="{{ asset('template') }}/js/datatables-simple-demo.js"></script>
  <script src="{{ asset('template') }}/js/bootbox.min.js" ></script>
  <script src="{{ asset('template') }}/js/scripts.js"></script>
</body>

</html>