<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class classFileController extends Controller
{
    public $regexStrings = null;
    public $functions = null;
    public $members = null;
    public $content = null;

    function __construct($content = '')
    {
        $this->content = $content;
        $this->regexStrings = new \stdClass();
        $regexStrings = &$this->regexStrings;
        $regexStrings->functionName = '/(\t| {4})(\w+\s)+?(?<!new |return )\&?(\w+)\(/';
        $regexStrings->functions = '/(.*\/\*\*(.*\n\N)+?(.*\*\/\n))?(\t| {4})(static|function|protected|public|private|final).*\n(\t| {4}){(.*\n)*?(\t| {4})}/';
        $regexStrings->members = '/(.*\/\*\*(.*\n\N)+?(.*\*\/\n))?(\t|\s{4})(public|protected|static|private|final).*(;|(\[\n)(.*\n)+?(.*;))/';
        $regexStrings->classStart = '/class.*\n?{.*\n/';
        $regexStrings->memberName = '/(public|static|private|protected)+ \$(\w*)/';
        $regexStrings->roqueDocumentation = '/(.*\/\*\*(.*\n\N)+?(.*\*\/\n))\t?\n/';
        preg_match_all($regexStrings->roqueDocumentation, $this->content, $result);
        foreach ($result[0] as $item)
        {
            if(!empty($item))
            {
                dump('roque documentation found');
                dump($item);
            }

        }
    }

    /**
     * TODO Needs to be moved from class
     */
    function testfunction()
    {
        $content = Storage::disk('controllers')->get('classFileController.php');
        $classFileController = new classFileController($content);
//        dump($classFileController->sortFunctionsAlphabet());
        dump($classFileController->sortMembersAlphabeth());
    }

    function &getContentInstance()
    {
        return $this->content;
    }



    function sortFunctionsAlphabet()
    {
        $content = &$this->content;
        $result = $this->grabFunctions($content);
        $this->functions = $result[0];
        $functions = &$this->functions;
        foreach ($functions as $item)
        {
            $content = $this->stripContent($item, $content);
        }
        usort($functions, function($a, $b)
        {
            preg_match_all($this->regexStrings->functionName, $a, $resultA);
            preg_match_all($this->regexStrings->functionName, $b, $resultB);
            if(isset($resultA[3][0]) and isset($resultB[3][0]))
            {
                return 0 - strcasecmp($resultA[3][0], $resultB[3][0]);
            }
            else
            {
                return 0;
            }
        });
        $start = $this->getClassStartOffset();
        foreach ($functions as $function)
        {
            $content = substr_replace ( $content , $function . "\n\n" , $start, 0);
        }
        $content = preg_replace('/\n(\n\n\n)/',"",$content);
        return $content;
    }

    function sortMembersAlphabeth()
    {
        $content = &$this->content;
        $result = $this->grabMembers($content);
        $this->members = $result[0];
        $members = &$this->members;
        $content = &$this->content;
        $result = $this->grabFunctions($content);
        $this->functions = $result[0];
        $functions = &$this->functions;
        foreach ($functions as $item)
        {
            $content = $this->stripContent($item, $content);
        }
        foreach ($members as $item)
        {
            $content = $this->stripContent($item, $content);
        }
//        dump($content);
        $content = preg_replace('/[\r\n]{2,}/',"\n\n",$content);
//        dump($content);
        usort($functions, function($a, $b)
        {
            preg_match_all($this->regexStrings->functionName, $a, $resultA);
            preg_match_all($this->regexStrings->functionName, $b, $resultB);
            if(isset($resultA[3][0]) and isset($resultB[3][0]))
            {
                return 0 - strcasecmp($resultA[3][0], $resultB[3][0]);
            }
            else
            {
                return 0;
            }
        });
        $start = $this->getClassStartOffset();
        foreach ($functions as $function)
        {
            $content = substr_replace ( $content , "\n" .$function . "\n" , $start, 0);
        }
        usort($members, function($a, $b)
        {
            preg_match_all($this->regexStrings->memberName, $a, $resultA);
            preg_match_all($this->regexStrings->memberName, $b, $resultB);
            if(isset($resultA[2][0]) and isset($resultB[2][0]))
            {
                return 0 - strcasecmp($resultA[2][0], $resultB[2][0]);
            }
            else
            {
                return 0;
            }
        });
        $start = $this->getClassStartOffset();
        foreach ($members as $member)
        {
            $content = substr_replace ( $content , $member . "\n" , $start, 0);
        }
        return $content;
    }

    function getClassStartOffset()
    {
        preg_match($this->regexStrings->classStart,$this->content, $matches, PREG_OFFSET_CAPTURE);
        return $matches[0][1] + strlen($matches[0][0]);
    }




    function grabFunctions($class)
    {
        $result = null;
        preg_match_all($this->regexStrings->functions, $class, $result);
        return $result;
    }


    function grabMembers($class)
    {
        $result = null;
        preg_match_all($this->regexStrings->members, $class, $result);
        return $result;
    }

    function stripContent($content, $original)
    {
        return str_replace ( $content ,'' , $original);
    }
}
