<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConsultaController extends Controller
{



    public function indexUusarios()
    {
        return view('pages.Usuarios.indexUsuarios');
    }









    // DDL
    public function indexDDL()
    {
        $consulta = DB::table('consultas')->get(); // Recupera todas las consultas y resultados
        return view('pages.ConsultasDDL.gestor-consultasDDL', ['consulta' => $consulta]);
    }

    //DDL
    public function create()
    {
        return view('pages.ConsultasDDL.gestor-consultasDDL');
    }

    public function store(Request $request)
    {
        $definicion = $request->input('definicion');

        if (!empty($definicion)) {
            try {
                DB::statement($definicion);

                // Detectar el tipo de consulta DDL
                $tipoConsulta = $this->detectarTipoConsulta($definicion);

                // Mensaje personalizado según el tipo de consulta
                $mensaje = $this->crearMensajeSegunTipoConsulta($tipoConsulta);

                return redirect()->route('crear-tabla')->with('success', $mensaje);
            } catch (\Exception $e) {
                return redirect()->route('crear-tabla')->with('error', 'Error en la consulta: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('crear-tabla')->with('error', 'La definición de la tabla está vacía.');
        }
    }

    // Método para detectar el tipo de consulta DDL
    private function detectarTipoConsulta($definicion)
    {
        $definicion = Str::lower($definicion);
        if (Str::contains($definicion, 'create table')) {
            return 'CREATE TABLE';
        } elseif (Str::contains($definicion, 'alter table')) {
            return 'ALTER TABLE';
        } elseif (Str::contains($definicion, 'drop table')) {
            return 'DROP TABLE';
        } elseif (Str::contains($definicion, 'truncate table')) {
            return 'TRUNCATE TABLE';
        } else {
            return 'DDL Query';
        }
    }

    // Método para crear mensajes personalizados según el tipo de consulta
    private function crearMensajeSegunTipoConsulta($tipoConsulta)
    {
        switch ($tipoConsulta) {
            case 'CREATE TABLE':
                return 'La tabla se creó exitosamente.';
            case 'ALTER TABLE':
                return 'La tabla se alteró exitosamente.';
            case 'DROP TABLE':
                return 'La tabla se eliminó exitosamente.';
            case 'TRUNCATE TABLE':
                return 'La tabla se truncó exitosamente.';
            default:
                return 'No es un comando DDL';
        }
    }

    // DML
    public function indexDML()
    {
        return view('pages.ConsultasDML.gestor-consultasDML');
    }

    public function executeDML(Request $request)
    {
        $consulta = $request->input('consulta');

        if (!empty($consulta)) {
            try {
                $resultados = DB::select($consulta);
                $tipoConsulta = $this->detectarTipoConsultaDML($consulta);
                $mensaje = $this->crearMensajeSegunTipoConsultaDML($tipoConsulta);

                return view('pages.ConsultasDML.gestor-consultasDML', ['resultados' => $resultados, 'mensaje' => $mensaje]);
            } catch (\Exception $e) {
                return redirect()->route('consultas-dml')->with('error', 'Error en la consulta: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('consultas-dml')->with('error', 'La consulta está vacía.');
        }
    }

    private function detectarTipoConsultaDML($consulta)
    {
        $consulta = strtolower($consulta);
        if (strpos($consulta, 'select') !== false) {
            return 'SELECT';
        } elseif (strpos($consulta, 'insert') !== false) {
            return 'INSERT';
        } elseif (strpos($consulta, 'update') !== false) {
            return 'UPDATE';
        } elseif (strpos($consulta, 'delete') !== false) {
            return 'DELETE';
        } else {
            return 'DML Query';
        }
    }

    private function crearMensajeSegunTipoConsultaDML($tipoConsulta)
    {
        switch ($tipoConsulta) {
            case 'SELECT':
                return 'La consulta SELECT se ejecutó con éxito.';
            case 'INSERT':
                return 'El dato se insertó exitosamente en la tabla.';
            case 'UPDATE':
                return 'La tabla se actualizó exitosamente.';
            case 'DELETE':
                return 'El registro se eliminó exitosamente de la tabla.';
            default:
                return 'La consulta DML se ejecutó exitosamente.';
        }
    }




// Metodo DCL
public function indexDCL()
{
    return view('pages.ConsultasDCL.gestor-consultasDCL');
}

public function executeDCL(Request $request)
{
    $consulta = $request->input('consulta');

    if (!empty($consulta)) {
        try {
            $resultados = DB::select($consulta);
            $tipoConsulta = $this->detectarTipoConsultaDML($consulta);
            $mensaje = $this->crearMensajeSegunTipoConsultaDML($tipoConsulta);

            return view('pages.ConsultasDML.gestor-consultasDML', ['resultados' => $resultados, 'mensaje' => $mensaje]);
        } catch (\Exception $e) {
            return redirect()->route('consultas-dcl')->with('error', 'Error en la consulta: ' . $e->getMessage());
        }
    } else {
        return redirect()->route('consultas-dml')->with('error', 'La consulta está vacía.');
    }
}

private function detectarTipoConsultaDCL($consulta)
{
    $consulta = strtolower($consulta);
    if (strpos($consulta, 'select') !== false) {
        return 'SELECT';
    } elseif (strpos($consulta, 'insert') !== false) {
        return 'INSERT';
    } elseif (strpos($consulta, 'update') !== false) {
        return 'UPDATE';
    } elseif (strpos($consulta, 'delete') !== false) {
        return 'DELETE';
    } else {
        return 'DML Query';
    }
}

private function crearMensajeSegunTipoConsultaDCL($tipoConsulta)
{
    switch ($tipoConsulta) {
        case 'SELECT':
            return 'La consulta SELECT se ejecutó con éxito.';
        case 'INSERT':
            return 'El dato se insertó exitosamente en la tabla.';
        case 'UPDATE':
            return 'La tabla se actualizó exitosamente.';
        case 'DELETE':
            return 'El registro se eliminó exitosamente de la tabla.';
        default:
            return 'La consulta DML se ejecutó exitosamente.';
    }
}

    public function showTables()
    {
        $tables = DB::select('SHOW TABLES');
        return view('database.tables', compact('tables'));
    }

}
