<?php
namespace App\Http\traits;

trait ENVFilePutContent{

    public function dataWriteInENVFile($key,$value)
    {
        $path = app()->environmentFilePath();

        if($key==="APP_NAME") {
            $searchArray = array($key.'="'.env($key).'"');
            $replaceArray= array($key.'="'.$value.'"');
        }
        else if($key==="MAIL_FROM_NAME") {
            $searchArray = array($key.'="'.env($key).'"');
            $replaceArray= array($key.'="'.$value.'"');
        }
        else {
            $searchArray = array($key.'='.env($key));
            $replaceArray= array($key.'='.$value);
        }

        file_put_contents($path, str_replace($searchArray, $replaceArray, file_get_contents($path)));
    }

}
