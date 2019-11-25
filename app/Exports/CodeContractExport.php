<?php

namespace App\Exports;

use App\Model\Hacienda\Presupuesto\FontsRubro;
use App\Model\Hacienda\Presupuesto\Rubro;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Session;


class CodeContractExport implements FromArray, WithHeadings
{
    use Exportable;

    protected $code;

    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function headings(): array
    {
       return [
         'Id',
         'Codigo',
         'Nombre',
         'Valor Inicial',
         'Valor Disponible',
       ];
    }

    public function array(): array
    {
        $data = Rubro::where('code_contractuales_id', $this->code)->get();
        if ($data->count() != 0){
            foreach ($data as $d){
                $valFuent = FontsRubro::where('rubro_id', $d->id)->sum('valor');
                $valDisp = FontsRubro::where('rubro_id', $d->id)->sum('valor_disp');
                $Rubros[] = [$d->id, $d->cod, $d->name, $valFuent, $valDisp];
                $TotalVal[] = $valFuent;
                $TotalValDisp[] = $valDisp;
            }
            $totalV = array_sum($TotalVal);
            $totalD = array_sum($TotalValDisp);
            $Rubros[] =  ['Total Rubros', '', '',  $totalV, $totalD];

            return $Rubros;

        }
    }
}
