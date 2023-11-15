<?php

namespace App\Service;


use Endroid\QrCode\QrCode;

use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Color\Color;


use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PdfWriter;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Font\NotoSans;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Writer\ValidationException;
use Endroid\QrCode\Label\Alignment\LabelAlignmentRight;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Alignment\LabelAlignmentInterface;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;


class QrcodeService
{
    protected $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function qrcode($reference)
    {
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($reference)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(1100)
            ->margin(50)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            #->logoPath(\dirname(__DIR__,2).'/public/assets/img/immobilisations.jpg')->logoResizeToWidth(50)
            ->labelText($reference)
            ->labelFont(new NotoSans(105))
            ->labelAlignment(new LabelAlignmentCenter())
            ->validateResult(false)
            ->build();
        return $result->getDataUri();
    }
    #$namePng=uniqid('','').'.jpg';
    #$result->saveToFile((\dirname(__DIR__,2).'/public/assets/img/qr-code/'.$namePng));

}
