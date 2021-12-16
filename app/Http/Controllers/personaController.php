<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\persona;
class personaController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = persona::all();


       return response()->json([

            'code'   => 200,
            'status' => 'success',
            'data'   => $data

       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $json = $request->input('json', null);
     
        $params_array = json_decode($json, true);

        if (!empty($params_array)) {

            $validate = \Validator::make($params_array, [

                'Modelo'                => 'required',
                'NombreCompleto'        => 'required',
                'Correo'                => 'required',
                'Telefono'              => 'required',
                'Ciudad'                => 'required'

            ]);
            if ($validate->fails()) {

                $data = [

                    'code'      => 400,
                    'status'    => 'error',
                    'mensaje'   => 'Se ha encontrado error el los datos',
                    'error'     => $validate->errors()

                ];
            } else {


                $dt = new persona();

                $dt->NombreCompleto          = $params_array['NombreCompleto'];
                $dt->Modelo                  = $params_array['Modelo'];
                $dt->Correo                  = $params_array['Correo'];
                $dt->Telefono                = $params_array['Telefono'];
                $dt->Ciudad                  = $params_array['Ciudad'];

                $dt->save();

                $data = [

                    'code'      => 200,
                    'status'    => 'success',
                    'mensaje'   => 'Se ha guardado correctamente el dato',
                    'data'      => $dt

                ];
            }
        } else {

            $data = [

                'code'      => 400,
                'status'    => 'error',
                'mensaje'   => 'No has enviado ningún dato',


            ];
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
