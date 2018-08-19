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
    private $order_list_name;

    public function __construct($pdf, $order_list_name)
    {
        $this->pdf = $pdf->stream();
        $this->order_list_name = $order_list_name;
    }

    public function build()
    {
        return $this->subject($this->order_list_name)->text('email.supplier')
            ->attachData($this->pdf, $this->order_list_name . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
