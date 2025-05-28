<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Illuminate\Support\Facades\DB;
use App\Helpers\Constantes;

class HomeController extends Controller {

  public function __construct() {
    parent::__construct();
  }

  public function listarRegistros() {
    return view('listar_registros');
  }

  public function cargarRegistros() {

    return view('cargar_registros');
  }

  public function cargarRegistrosCSV(Request $request) {
    $request->validate([
      'fileSVG' => 'required|file|mimes:csv,txt',
      'opcion' => 'required|string',
    ]);

    $archivo = $request->file('fileSVG');
    $opcion = $request->input('opcion');
    error_log('opcion carga es ' . $opcion);
    // Nombre original
    $nombreOriginal = $archivo->getClientOriginalName();

    // Extensión (sin el punto, ej: csv)
    $extension = $archivo->getClientOriginalExtension();

    // Nuevo nombre generado con tu función
    $nuevoNombre = $this->createCode(16) . '.' . $extension;
    $archivo->storeAs('csv', $nuevoNombre, 'local');
    // $this->setTime();

    //cargar el CSV y parsearlo... 
    $rutaArchivo = storage_path('app/csv/' . $nuevoNombre);

    if (!file_exists($rutaArchivo)) {
      throw new \Exception('No se pudo cargar el archivo para procesarlo');
    }

    $dataCarga = [
      'Nombre' => $nuevoNombre,
      'NombreReal' => $nombreOriginal,
      'Opcion' => $opcion,
      'created_at' => $this->now_formatted
    ];

    DB::table('cargasCsv')->insert($dataCarga);


    $reader = new Csv();

    $spreadsheet = $reader->load($rutaArchivo);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // Inicializamos arrays de resultado
    $dataToInsert = [];
    $dataRejected = [];
    $dataMessages = [];
    $oldIdsInFile = [];
    
    $skipHeader = true;
    //extraer en un array los objetos validados o no
    foreach ($rows as $index => $row) {
      if ($skipHeader && $index === 0) continue;

      $id = $row[0] ?? null;
      $nombre = $row[1] ?? null;
      $descripcion = $row[2] ?? null;

      $errores = [];

      // Validaciones
      if (!is_numeric($id)) {
        $errores[] = "ID no es numérico";
      }

      if (empty($nombre)) {
        $errores[] = "Nombre vacío";
      } elseif (strlen($nombre) > 50) {
        $errores[] = "Nombre excede 50 caracteres";
      }

      if (!is_null($descripcion) && !is_string($descripcion)) {
        $errores[] = "Descripción inválida";
      }

      if (empty($errores)) {
        $dataToInsert[] = [
          'IdMask' => $this->createHash(),
          'IdInFile' => (int)$id,
          'Nombre' => $nombre,
          'Descripcion' => $descripcion,
          'Origin' => Constantes::ORIGIN_FILE,
          'created_at' => $this->now,
        ];

      } else {
        $dataRejected[] = $row;
        $dataMessages[] = implode(' | ', $errores);
      }
    }

    $nuevos = 0;
    $actualizados = 0;
    $ignorados = 0;
    
    if( count($dataToInsert) > 0 ){
      
      if( $opcion != 'borrar' ){
        //traer los ID numericos de anteriores registros... 
        $oldIdsInFile = DB::table('registros')->select('IdInFile')->get()->pluck('IdInFile')->toArray();
      }
      
      switch ($opcion) {
        case 'borrar':
          //borrar todos los registros y registrar los nuevos... 
          DB::table('registros')->truncate();
          foreach ( $dataToInsert as $registro ){
            Registro::create($registro);
            $nuevos += 1;
          }
        break;

        case 'combinar':
          
          //ingresar los registros nuevos y si uno ya existe, actualizarlo...
          foreach ( $dataToInsert as $row ){
            if( in_array(intval($row["IdInFile"]),$oldIdsInFile) ){
              //actualizar
              unset($row["created_at"]);
              $row["updated_at"] = $this->now_formatted;
              Registro::where("IdInFile",$row["IdInFile"])->update($row);
              $actualizados += 1;
            }else{
              Registro::create($row);
              $nuevos += 1;
            }
          }
        break;

        case 'mantener':
          //ingresar los registros nuevos y si uno ya existe, ingorar el nuevo...
          foreach ( $dataToInsert as $row ){
            if( in_array(intval($row["IdInFile"]),$oldIdsInFile) ){
              //ignorar ESTE registro... 
              $ignorados += 1;
            }else{
              Registro::create($row);
              $nuevos += 1;
            }
          }
        break;
        
      }
    }

    $this->response["done"] = true;
    $this->response["msg"] = "";
    if( count($dataToInsert) > 0 ){
      $this->response["code"] = 200;
      $this->response["msg"] = "Se ingresaron ".$nuevos." registros<br> actualizados ".$actualizados." registros<br> ignorados ".$ignorados." registros";
    }else{
      $this->response["code"] = 401;
      $this->response["msg"] = "Hubo algun error";
    }
    
    $this->response["data"] = [];
    $this->response["data"]["rechazados"] = $dataRejected;
    $this->response["data"]["messages"] = $dataMessages;

    return json_encode($this->response);
  }
}//fin del controller
