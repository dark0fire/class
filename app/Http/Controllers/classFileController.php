<?php

namespace App\Http\Controllers;

use App\Library\Tools\classFileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class classFileController extends Controller
{
    /**
     * @var string
     */
    public $member = '';

    /**
     * TODO Needs to be moved from class
     */
    function testfunction()
    {
//        $content = Storage::disk('library')->get('Tools/classFileHandler.php');
        $content = Storage::disk('controllers')->get('classFileController.php');
        $classFileHandler = new classFileHandler($content);
        dump($classFileHandler->alphabetize());
        $this->getRoqueDocumentations();
        $this->getRoqueFunctions();
//        Storage::disk('controllers')->put('classFileController.php',$classFileController->content);
    }

    function getRoqueDocumentations()
    {
//        $content = Storage::disk('library')->get('Tools/classFileHandler.php');
        $content = Storage::disk('controllers')->get('classFileController.php');
        $classFileHandler = new classFileHandler($content);
        $result = $classFileHandler->getRoqueDocumentations();
        dump($result[0]);

    }

    function getRoqueFunctions()
    {
//        $content = Storage::disk('library')->get('Tools/classFileHandler.php');
        $content = Storage::disk('controllers')->get('classFileController.php');
        $classFileHandler = new classFileHandler($content);
        $result = $classFileHandler->getRoqueFunctions();
        dump($result[1]);
    }

    function dirk()
    {

    }

    function zion()
    {

    }

}
