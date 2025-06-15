<?php
namespace App;
class Products{
  public int $productname;
  public int $productImage;
  
public function __construct($productname, $productImage)
{
  $this->productname = $productname;
  $this->productImage = $productImage;
}
}

$mtnProduct = new Product("mtn", "./assets/gear-50.png");
  return [
    $mtnProduct
  ];
