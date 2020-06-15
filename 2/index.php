<?php
$productsContent = file_get_contents('products.xml');
$productsXML = new SimpleXMLElement($productsContent);

$sectionsContent = file_get_contents('sections.xml');
$sectionsXML = new SimpleXMLElement($sectionsContent);

$outputContent = '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"></rss>';
$outputXML = new SimpleXMLElement($outputContent);
$rss = $outputXML->addChild('Catalog')->addChild('Sections');
foreach ($sectionsXML->Section as $section){
    $newSection = $rss->addChild('Section');
    $newSection->addChild('ID', $section->ID);
    $newSection->addChild('Name', $section->Name);
    $addProductsToSection = $newSection->addChild('Products');
    foreach ($productsXML->Product as $product) {
        foreach($product->Sections->SectionID as $id) {
            if (strcmp($section->ID, $id) == 0) {
                $addProductToSection = $addProductsToSection->addChild('Product');
                $addProductToSection->addChild('ID', $product->ID);
                $addProductToSection->addChild('Name', $product->Name);
                $addProductToSection->addChild('VendorCode', $product->VendorCode);
            }
        }
    }
}

$outputXML->asXML('output.xml');
echo 'Сохранено в output.xml';