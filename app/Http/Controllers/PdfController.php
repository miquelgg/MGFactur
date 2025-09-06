<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Ramsey\Uuid\Uuid;

class PdfController extends Controller
{
    public function HolidaysRecords (User $user){
        #$holidays = Holiday::where('user_id', $user->id)->get();
        $holidays = Holiday::all();
        
        //dd( $holidays );


        $pdf = Pdf::loadView('pdf.example',['holidays'=>$holidays]);
        //$name = Uuid::uuid4()->toString();
        //return $pdf->download("$name.pdf");
        //return $pdf->stream();
        return $pdf->download('Registro_de_Dias_Festivos.pdf');
    }
}
