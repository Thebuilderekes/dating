<?php

namespace App;

class Product
{
    public string $productname;

    public string $productImage;
    public function __construct(string $productname, string $productImage)
    {
        $this->productname = $productname;
        $this->productImage = $productImage;
    }
}

$mtnProduct = new Product('mtn', './assets/gear-50.png');

return [
    $mtnProduct,
];
