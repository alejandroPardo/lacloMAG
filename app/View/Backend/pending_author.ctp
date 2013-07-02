<?php
//Use the html helper to generate a link (cannot be crossdomain);
$pdfurl = $this->Html->url('/files/usecase.pdf',true); //Using true for full url, cookbookdemo.pdf is an example in the webroot of the plugin

$vieweroptions = array(
        'pdfurl'    =>  $pdfurl,
        'class'     =>  'section padding current', //Class you want to give to canvas, use your own class. I use TwitterBootstrap so therefore i use the span6 (half page) class.
        'scale'     =>  0.5, //The 'zoom' or 'scale' factor. I use 2 for making the PDF more sharp in displaying. 
        'startpage' =>  1, //Starting page
    );

//Get the PdfView element that renders the PDF
echo $this->element('PdfViewer.viewer',$vieweroptions);
?>