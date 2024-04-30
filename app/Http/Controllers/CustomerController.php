<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;


class CustomerController extends Controller 
{
    public function __construct()
    {
        $this->middleware('storeCustomer', ['only' => ['store']]);
        $this->middleware('deleteCustomer', ['only' => ['destroy']]);
        // $this->middleware('AuthClient');
    }

    function store(Request $request) {

        $customer = new customer;

        $customer->dni = $request->dni;
        $customer->id_reg = $request->id_reg;
        $customer->id_com = $request->id_com;
        $customer->email = $request->email;
        $customer->name = $request->name;
        $customer->last_name= $request->last_name;
        $customer->date_reg  = \Carbon\Carbon::now()->toDateTimeString();
        if ( $request->address ) {
            $customer->address = $request->address;
        }

        if ( $request->status ) {
            $customer->status = $request->status;
        }

        $customer->save();
     if ($customer) {
        return response()->json($customer ,200 );
     }
     return response()->json(['message' => 'Error al registrar el cliente'], 422 );
    }
    function index() {
        // usuario activo login - logeado
        // if ($request->status == 'activado') {
            return response()->json([
                "data" => customer::where('status', 'A')->with('commune','region')->get()
            ], 200);
        // }
        
    }

    /** validar algo mas */
    function destroy($dni) {
        $customer = customer::where('dni', $dni)->first();
        $customer->delete();
        return response()->json(
            ['message' => 'Registro eliminado.'], 200);
    }
}
