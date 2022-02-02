<?php
include_once ('../Classes/Category.php');
include_once ('../Classes/Product.php');

require '../Modules/common.php';
require '../Modules/categories.php';
require '../Modules/products.php';
// require '../Modules/database.php';

define("DOC_ROOT", realpath(dirname(__DIR__)));
define("TEMPLATE_ROOT", realpath(DOC_ROOT . "/Templates") . "/");

$request = $_SERVER['REQUEST_URI'];
$params = explode("/", $request);
$title = "HealthOne";
$titleSuffix = "";

switch ($params[1]) {
    case 'categories':
        $titleSuffix = ' | Categories';
        // TODO Toon de categorieen
        $categories = getCategories();
        include_once TEMPLATE_ROOT . "categories.php";
        break;

    case 'category':
        if($_GET['id']) {
            $products = getProducts($categoryId);
            $name = getCategoryName($categoryId);
            $titleSuffix = ' | ' . $name;
            // TODO Zorg dat je hier alle producten laat zien van een categorie
        }
        break;
        
    case 'product':
        if($_GET['id']) {
            $productId = $_GET['product_id'];
            $product = getProduct($productId);
            $titleSuffix = ' | ' . $product->name;
            // TODO Zorg dat je hier de product pagina laat zien
        }
        break;
    
    case '':
    case 'Home':
        $titleSuffix = ' | Home';
        include_once TEMPLATE_ROOT . "home.php";
        break;
    
    default:
        $titleSuffix = ' | 404';
        include_once TEMPLATE_ROOT . "404.php";
}
