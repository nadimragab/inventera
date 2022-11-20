<?php

namespace App\Service;


use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class QrcodeService
{
    protected $builder; 

    public function __construct(BuilderInterface $builder)
    {
        $this->builder =$builder; 
    } 

    public function qrcode($reference)
    {
        $result = $this->builder
            ->data($reference)
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->encoding(new Encoding('UTF-8'))
            ->size(300)
            ->margin(10)
            ->LabelText($reference)
            ->build()
            ;
        $namePng=uniqid('','').'.png';
        $result->saveToFile((\dirname(__DIR__,2).'/public/assets/img/qr-code/'.$namePng));
        return $result->getDataUri(); 
    }
    
}