<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CambioController extends Controller
{
	public function getCambio()
	{
		$valor = Http::get('https://www.sunat.gop.pe/a/txt/tipoCambio.txt');

		$fecha = substr($valor, 0, -13);
        	$cambio_completo = substr($valor, 11, -7);
        	$cambio_redondeado = substr($valor, 17, -2);
        	
		return [
            		'fecha' => $fecha,
            		'valor' => $cambio_completo,
            		'redondeado' => $cambio_redondeado
        	];
	}
}
