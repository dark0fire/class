<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 26-5-2017
 * Time: 20:46
 */

namespace App\Library\Tools;

class classFileHandler
{
    public $content = null;
    public $functions = null;
    public $members = null;
    /**
     * @var null|\stdClass
     */
    public $regexStrings = null;

    function __construct($content = '')
    {
        $this->content = &$content;
        $content = preg_replace('/\r/',"",$content);
        $this->regexStrings = new \stdClass();
        $regexStrings = &$this->regexStrings;
        $regexStrings->functionName = '/(\t| {4})(\w+\s)+?(?<!new |return )\&?(\w+)\(/';
        $regexStrings->functions = '/(.*\/\*\*(.*\n\N)+?(.*\*\/\n))?(\t| {4})(static|function|protected|public|private|final).*\n(\t| {4}){(.*\n)*?(\t| {4})}/';
        $regexStrings->members = '/(.*\/\*\*(.*\n\N)+?(.*\*\/\n))?(\t| {4})(public|protected|static|private|final).*(;|(\[\n)(.*\n)+?(.*;))/';
        $regexStrings->classStart = '/class .*\r?\n?{.*\r?\n/';
        $regexStrings->memberName = '/(public|static|private|protected)+ \$(\w*)/';
        $regexStrings->roqueDocumentations = '/((\t| {4})\/\*\*(.*\r?\n\N)+?(.*\*\/\r?\n))\t?\r?\n/';
        $regexStrings->roqueFunctions = '/\n\n((\t| {4})(static|function|protected|public|private|final).*\n(\t| {4}){(.*\n)*?(\t| {4})})/';
        $regexStrings->trimEmptyRows = '/[\r\n]{3,}/';
    }


    function alphabetize($content = '')
    {
        $content = &$this->setInternalContentIfEmpty($content);
//        $content = preg_replace('/\r/',"",$content);
        $result = $this->getMembers();
        $this->members = $result[0];
        $members = &$this->members;
        $result = $this->getFunctions();
        $this->functions = $result[0];
        $functions = &$this->functions;
        $content = $this->stripContent($functions);
        $content = $this->stripContent($members);
        $content = preg_replace('/(\n){3,}/',"\n\n",$content);
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

        $start = $this->getClassStart();
        foreach ($functions as $function)
        {
            $content = substr_replace($content , "\n" .$function . "\n" , $start, 0);
        }
        foreach ($members as $member)
        {
            $content = substr_replace($content , $member . "\n" , $start, 0);
        }
        return $content;
    }

    /**
     * Get class start
     * @return integer value of startposition
     */
    function getClassStart($content = '')
    {
//        dump($content);
        $content = $this->setInternalContentIfEmpty($content);
        preg_match($this->regexStrings->classStart, $content, $matches, PREG_OFFSET_CAPTURE);
        return $matches[0][1] + strlen($matches[0][0]);
    }

    function &getContentInstance()
    {
        return $this->content;
    }

    function getFunctions($content = '')
    {
        $content = $this->setInternalContentIfEmpty($content);
//        dump($content);
        preg_match_all($this->regexStrings->functions, $content, $result);
        return $result;
    }

    function getMembers($content = '')
    {
        $content = $this->setInternalContentIfEmpty($content);
        preg_match_all($this->regexStrings->members, $content, $result);
        return $result;
    }

    function getRoqueDocumentations($content = '')
    {
        $content = $this->setInternalContentIfEmpty($content);
        preg_match_all($this->regexStrings->roqueDocumentations, $content, $result);
        return $result;
    }

    function getRoqueFunctions($content = '')
    {
        $content = $this->setInternalContentIfEmpty($content);
        preg_match_all($this->regexStrings->roqueFunctions, $content, $result);
        return $result;
    }

    private function &setInternalContentIfEmpty($content)
    {
        if(empty($content))
        {
            return $this->content;
        }
        else
        {
            return $content;
        }
    }

    function stripContent($toStrip, $content = '')
    {
        $content = $this->setInternalContentIfEmpty($content);
        if(is_array($toStrip))
        {
            foreach ($toStrip as $item)
            {
                $this->stripContent($item, $content);
            }
        }
        return str_replace ( $toStrip ,'' , $content);
    }

    function trimEmptyRows($content = '')
    {
        $content = $this->setInternalContentIfEmpty($content);
    }

    /**
     * @var null
     */



}