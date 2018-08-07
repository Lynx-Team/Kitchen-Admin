<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class SupplierMail extends Mailable
{
    use Queueable, SerializesModels;

    private $pdf;
    private $supplier_name;

    public function __construct($pdf, $supplier_name)
    {
        $this->pdf = $pdf->stream();
        $this->supplier_name = $supplier_name;
    }

    public function build()
    {
        return $this->text('email.supplier')
            ->attachData($this->pdf, $this->supplier_name, [
                'mime' => 'application/pdf',
            ]);
    }
}
