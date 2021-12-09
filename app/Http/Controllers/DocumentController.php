<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

class DocumentController extends Controller
{
    /* Laravel Convert Word To PDF Tutorial
     * By ScratchCode.io
     */
    public function convertWordToPDF()
    {
        /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        Settings::setPdfRendererPath($domPdfPath);
        Settings::setPdfRendererName('DomPDF');

        /*@ Reading doc file */
        $template = new TemplateProcessor(public_path('facturTemplate.docx'));

        /*@ Replacing variables in doc file */
        $template->setValue('company.name', date('d-m-Y'));
        $template->setValue('adress.name', 'Mr.');
        $template->setValue('company.street', 'mavericks');
        $template->setValue('company.zip', 'james');
        $template->setValue('author', 'maverick');

        /*@ Save Temporary Word File With New Name */
        $saveDocPath = public_path('new-facturTemplate.docx');
        $template->saveAs($saveDocPath);

        // Load temporarily create word file
        $Content = IOFactory::load($saveDocPath);

        //Save it into PDF
        $savePdfPath = public_path('new-facturTemplate.pdf');

        /*@ If already PDF exists then delete it */
        if ( file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }

        //Save it into PDF
        $PDFWriter = IOFactory::createWriter($Content,'PDF');
        $PDFWriter->save($savePdfPath);
        echo 'File has been successfully converted';

        /*@ Remove temporarily created word file */
        if ( file_exists($saveDocPath) ) {
            unlink($saveDocPath);
        }
    }
}
