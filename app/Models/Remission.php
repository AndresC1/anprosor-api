<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remission extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_remision',
        'fecha_remision',
        'remision_origen',
        'hora_entrada',
        'hora_salida',
        'client_id',
        'servicio_id',
        'vapor',
        'creado_por',
        'ultima_modificacion_por',
        'silo_id',
        'presentacion',
        'producto',
        'unidad_medida',
        'temperatura',
        'humedad',
        'impureza',
        'grano_quebrado',
        'grano_no_desarrollado',
        'conductor',
        'placa',
        'cedula_conductor',
        'peso_bruto',
        'peso_tara',
        'peso_neto',
        'movimiento',
        'observaciones',
        'estado',
        'remision_general_xlsx',
        'recibo_ingreso_xlsx',
        'recibo_egreso_xlsx',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'cliente_id');
    }
}
