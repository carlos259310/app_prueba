<?php

namespace App\Http\Controllers\Api;

use App\Models\Clientes;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Validators;

class ClienteController
{
    //metodo por laravelconsultar todos los registros de la tabla clientes
    public function index()
    {

        //obtener todos los registros de la tabla cliente
        $clientes = Clientes::all();

        $data = [
            'status' => true,
            'code' => 200,
            'data' => $clientes
        ];
        //obtener lista de estudiantes
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        // Validaciones comunes para ambos tipos de personas
        $validator = Validator::make($request->all(), [
            'tipo_persona' => 'required|string|in:N,J', // Validar que sea 'N' o 'J'
            'tipo_documento' => 'nullable|string|max:10',
            'numero_documento' => 'nullable|string|max:20|unique:clientes,numero_documento',
            'tipo_cliente' => 'nullable|string|max:10',
            'email' => 'required|email|max:100|unique:clientes,email',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:10',
            'departamento' => 'required|string|max:10'
        ]);

        // Validaciones específicas según el tipo de persona
        if ($request->tipo_persona == 'N') {
            $validator->addRules([
                'nombre_1' => 'required|string|max:30',
                'apellido_1' => 'required|string|max:30',
                'nombre_2' => 'nullable|string|max:30',
                'apellido_2' => 'nullable|string|max:30',
            ]);
        } elseif ($request->tipo_persona == 'J') {
            $validator->addRules([
                'razon_social' => 'required|string|max:120',
            ]);
        }

        // Validar los datos
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Los datos no son correctos',
                'errors' => $validator->errors()
            ], 400);
        }

        // Crear cliente según el tipo de persona
        if ($request->tipo_persona == 'N') {
            $clientes = Clientes::create([
                'nombre_1' => $request->nombre_1,
                'nombre_2' => $request->nombre_2,
                'apellido_1' => $request->apellido_1,
                'apellido_2' => $request->apellido_2,
                'email' => $request->email,
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'tipo_cliente' => $request->tipo_cliente,
                'tipo_persona' => $request->tipo_persona,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'departamento' => $request->departamento
            ]);
        } elseif ($request->tipo_persona == 'J') {
            $clientes = Clientes::create([
                'razon_social' => $request->razon_social,
                'email' => $request->email,
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'tipo_cliente' => $request->tipo_cliente,
                'tipo_persona' => $request->tipo_persona,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'departamento' => $request->departamento
            ]);
        }

        //si error al crear el cliente
        if (!$clientes) {
            $data = [
                'status' => false,
                'code' => 500,
                'message' => 'Error al crear el cliente'
            ];
            return response()->json($data, 500);
        }

        //si se pudo crear
        $data = [
            'status' => true,
            'code' => 201,
            'message' => 'Cliente creado correctamente',
            'data' => $clientes
        ];

        return response()->json($data, 201);
    }



    //metodo consultar por id
    public function show($id_cliente)
    {
        $clientes = Clientes::find($id_cliente);
        if (!$clientes) {
            $data = [
                'status' => false,
                'code' => 404,
                'message' => 'Cliente no encontrado'
            ];
            return response()->json($data, 404);
        }

        $data = [
            'cliente' => $clientes,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //metodo para eliminar
    public function destroy($id_cliente)
    {
        $clientes = Clientes::find($id_cliente);
        if (!$clientes) {
            $data = [
                'status' => false,
                'code' => 404,
                'message' => 'Cliente no encontrado'
            ];
            return response()->json($data, 404);
        }

        $clientes->delete();

        $data = [
            'status' => true,
            'code' => 200,
            'message' => 'Cliente eliminado correctamente'
        ];
        return response()->json($data, 200);
    }

    //metodo para actualizar recibe un json con los datos a actualizar y el id
   
   /* public function update(Request $request, $id_cliente)
    {
        $clientes = Clientes::find($id_cliente);
        if (!$clientes) {
            $data = [
                'status' => false,
                'code' => 404,
                'message' => 'Cliente no encontrado'
            ];
            return response()->json($data, 404);
        }


        // Validaciones comunes para ambos tipos de personas
        $validator = Validator::make($request->all(), [
            'tipo_persona' => 'required|string|in:N,J', // Validar que sea 'N' o 'J'
            'tipo_documento' => 'nullable|string|max:10',
            'numero_documento' => 'nullable|string|max:20|unique:clientes,numero_documento,' . $id_cliente . ',id_cliente',
            'tipo_cliente' => 'nullable|string|max:10',
            'email' => 'required|email|max:100|unique:clientes,email,' . $id_cliente . ',id_cliente',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:10',
            'departamento' => 'required|string|max:10'
        ]);

        // Validaciones específicas según el tipo de persona
        if ($request->tipo_persona == 'N') {
            $validator->addRules([
                'nombre_1' => 'required|string|max:30',
                'apellido_1' => 'required|string|max:30',
                'nombre_2' => 'nullable|string|max:30',
                'apellido_2' => 'nullable|string|max:30',
            ]);
        } elseif ($request->tipo_persona == 'J') {
            $validator->addRules([
                'razon_social' => 'required|string|max:120',
            ]);
        }

        // Validar los datos
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 400,
                'message' => 'Los datos no son correctos',
                'errors' => $validator->errors()
            ], 400);
        }

        // Crear cliente según el tipo de persona
        if ($request->tipo_persona == 'N') {
            $clientes = Clientes::update([
                'id_cliente' => $id_cliente,
                'nombre_1' => $request->nombre_1,
                'nombre_2' => $request->nombre_2,
                'apellido_1' => $request->apellido_1,
                'apellido_2' => $request->apellido_2,
                'email' => $request->email,
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'tipo_cliente' => $request->tipo_cliente,
                'tipo_persona' => $request->tipo_persona,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'departamento' => $request->departamento
            ]);
        } elseif ($request->tipo_persona == 'J') {
            $clientes = Clientes::update([
                'id_cliente' => $id_cliente,
                'razon_social' => $request->razon_social,
                'email' => $request->email,
                'tipo_documento' => $request->tipo_documento,
                'numero_documento' => $request->numero_documento,
                'tipo_cliente' => $request->tipo_cliente,
                'tipo_persona' => $request->tipo_persona,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'ciudad' => $request->ciudad,
                'departamento' => $request->departamento
            ]);
        }

        //si error al crear el cliente
        if (!$clientes) {
            $data = [
                'status' => false,
                'code' => 500,
                'message' => 'Error al actualizar el cliente'
            ];
            return response()->json($data, 500);
        }

        //si se pudo crear
        $data = [
            'status' => true,
            'code' => 201,
            'message' => 'Cliente actualizado correctamente',
            'data' => $clientes
        ];

        return response()->json($data, 201);
    }
        */

        public function update(Request $request, $id_cliente)
        {
            $cliente = Clientes::find($id_cliente);
            if (!$cliente) {
                $data = [
                    'status' => false,
                    'code' => 404,
                    'message' => 'Cliente no encontrado'
                ];
                return response()->json($data, 404);
            }
        
            // Validaciones comunes para ambos tipos de personas
            $validator = Validator::make($request->all(), [
                'tipo_persona' => 'required|string|in:N,J', // Validar que sea 'N' o 'J'
                'tipo_documento' => 'nullable|string|max:10',
                'numero_documento' => 'nullable|string|max:20|unique:clientes,numero_documento,' . $id_cliente . ',id_cliente',
                'tipo_cliente' => 'nullable|string|max:10',
                'email' => 'required|email|max:100|unique:clientes,email,' . $id_cliente . ',id_cliente',
                'telefono' => 'required|string|max:15',
                'direccion' => 'required|string|max:255',
                'ciudad' => 'required|string|max:10',
                'departamento' => 'required|string|max:10'
            ]);
        
            // Validaciones específicas según el tipo de persona
            if ($request->tipo_persona == 'N') {
                $validator->addRules([
                    'nombre_1' => 'required|string|max:30',
                    'apellido_1' => 'required|string|max:30',
                    'nombre_2' => 'nullable|string|max:30',
                    'apellido_2' => 'nullable|string|max:30',
                ]);
            } elseif ($request->tipo_persona == 'J') {
                $validator->addRules([
                    'razon_social' => 'required|string|max:120',
                ]);
            }
        
            // Validar los datos
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => 400,
                    'message' => 'Los datos no son correctos',
                    'errors' => $validator->errors()
                ], 400);
            }
        
            // Actualizar cliente según el tipo de persona
            if ($request->tipo_persona == 'N') {
                $cliente->nombre_1 = $request->nombre_1;
                $cliente->nombre_2 = $request->nombre_2;
                $cliente->apellido_1 = $request->apellido_1;
                $cliente->apellido_2 = $request->apellido_2;
            } elseif ($request->tipo_persona == 'J') {
                $cliente->razon_social = $request->razon_social;
            }
        
            // Actualizar campos comunes
            $cliente->email = $request->email;
            $cliente->tipo_documento = $request->tipo_documento;
            $cliente->numero_documento = $request->numero_documento;
            $cliente->tipo_cliente = $request->tipo_cliente;
            $cliente->tipo_persona = $request->tipo_persona;
            $cliente->telefono = $request->telefono;
            $cliente->direccion = $request->direccion;
            $cliente->ciudad = $request->ciudad;
            $cliente->departamento = $request->departamento;
        
            // Guardar cambios
            $guardado = $cliente->save();
        
            //$guardado = Clientes::where('id_cliente', $id_cliente)->update($cliente);

            //si error al actualizar el cliente
            if (!$guardado) {
                $data = [
                    'status' => false,
                    'code' => 500,
                    'message' => 'Error al actualizar el cliente'
                ];
                return response()->json($data, 500);
            }
        
            //si se pudo actualizar
            $data = [
                'status' => true,
                'code' => 200, // Cambié a 200 porque es una actualización, no una creación
                'message' => 'Cliente actualizado correctamente',
                'data' => $cliente
            ];
        
            return response()->json($data, 200);
        } 
}
