<?php

namespace App\Http\Controllers\Conversion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Converter\CheckConverterRequest;
use App\Models\Conversion\ConverterHandle\ConverterHandle;
use Illuminate\Http\Request;
use Exception;

class ConverterController extends Controller
{
    public function converter(CheckConverterRequest $request){
        try{
            $request->validated();
            $conversion = new ConverterHandle();
            $amount = $request->amount;
            $from = $request->from;
            $to = $request->to;
            $result = $conversion->convert($amount, $from, $to);
            if($result == null){
                throw new Exception('No se puede realizar la conversión con las unidades de medida seleccionadas');
            }
            return response()->json([
                'from' => $from,
                'to' => $to,
                'resultado' => $result,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'mensaje' => 'error al realizar la conversión',
                'error' => $e->getMessage(),
                'estado' => 500
            ], 500);
        }
    }
}
