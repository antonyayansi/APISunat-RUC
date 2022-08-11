<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function ruc($ruc)
    {
        
        if( strlen($ruc) != 11)
        {
            return [
                'success' => false,
                'message'=> "El número de RUC ingresado es inválido."
            ];
        }

        $site = Empresa::where('ruc', $ruc)->first();

        if($site)
        {
            $address = $this->getAddress($site);
            $location = $this->getDataLocation($site->ubigeo, $address);

            $response = [
                'ruc' => $site->ruc,
                'estado' => $site->estado_contribuyente,
                'condicion' => $site->condicion_domicilio,
                'ubigeo' => $location['ubigeo'],
                'tipo_via' => $site->tipo_via,
                'nombre_via' => $site->nombre_via,
                'codigo_zona' => $site->codigo_zona,
                'tipo_zona' => $site->tipo_zona,
                'numero' => $site->numero,
                'interior' => $site->interior,
                'lote' => $site->lote,
                'departamento' => $site->departamento,
                'manzana' => $site->manzana,
                'kilometro' => $site->kilometro,
                'nombre_o_razon_social' => $site->nombre_razon_social,
                'direccion' => $location['address'],
                'direccion_completa' => $location['address_full'],
            ];

            return [
                'success' => true,
                'data' => $response
            ];
        }

        return [
            'success' => false,
            'message'=> "El número de RUC no fué encontrado."
        ];
        
    }
 
    public function getAddress($site){

        $tipo_via = ($site->tipo_via && $site->tipo_via != '-') ? $site->tipo_via : '';
        $nombre_via = ($site->nombre_via && $site->nombre_via != '-') ? ' '.$site->nombre_via : '';
        $codigo_zona = ($site->codigo_zona && $site->codigo_zona != '-') ? ' '.$site->codigo_zona : '';
        $tipo_zona = ($site->tipo_zona && $site->tipo_zona != '-') ? ' '.$site->tipo_zona : '';
        $numero = ($site->numero && $site->numero != '-') ? " NRO. {$site->numero}" : '';
 
        $manzana = ($site->manzana && $site->manzana != '-') ? " MZ. {$site->manzana}" : '';
        $lote = ($site->lote && $site->lote != '-') ? " LT. {$site->lote}" : '';
        $departamento = ($site->departamento && $site->departamento != '-') ? " DPTO. {$site->departamento}" : '';
        $interior = ($site->interior && $site->interior != '-') ? " INT. {$site->interior}" : '';
        $kilometro = ($site->kilometro && $site->kilometro != '-') ? " KM. {$site->kilometro}" : '';

        $address = "{$tipo_via}{$nombre_via}{$numero}{$codigo_zona}{$tipo_zona}{$manzana}{$lote}{$departamento}{$interior}{$kilometro}";

        return $address;
    }

    public function getDataLocation($location_id, $address)
    {

        $district = District::with('province')->find($location_id);

        if(is_null($district)) {

            return [
                'ubigeo' => [],
                'address' => $address,
                'address_full' => $address,
            ];

        }

        $department_name = mb_strtoupper($district->province->department->description);
        $province_name = mb_strtoupper($district->province->description);
        $district_name = mb_strtoupper($district->description);
        $location_full_name = $department_name.' - '.$province_name.' - '.$district_name;

        $ubigeo = [
            $district->province->department_id,
            $district->province_id,
            $district->id,
        ];
        
        return [
            'ubigeo' => $ubigeo,
            'address' => $address,
            'address_full' => $address.', '.$location_full_name,
        ];
    }


}
