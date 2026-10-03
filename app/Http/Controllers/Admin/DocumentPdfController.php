<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bordereau;
use App\Models\Facture;
use App\Models\Proforma;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class DocumentPdfController extends Controller
{
    public function facture(Facture $facture): Response
    {
        $facture->load('articles');

        return Pdf::loadView('admin.pdf.facture', compact('facture'))
            ->setPaper('a4')
            ->download(Str::slug($facture->num_facture).'.pdf');
    }

    public function proforma(Proforma $proforma): Response
    {
        $proforma->load('articles');

        return Pdf::loadView('admin.pdf.proforma', compact('proforma'))
            ->setPaper('a4')
            ->download(Str::slug($proforma->num_proforma).'.pdf');
    }

    public function bordereau(Bordereau $bordereau): Response
    {
        $bordereau->load('articles');

        return Pdf::loadView('admin.pdf.bordereau', compact('bordereau'))
            ->setPaper('a4')
            ->download(Str::slug($bordereau->num_bl).'.pdf');
    }
}
