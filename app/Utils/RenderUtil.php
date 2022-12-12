<?php

namespace App\Utils;


use Inertia\Inertia;


class RenderUtil
{
    public static function makeResponse($page, $data){

        return Inertia::render($page, $data);
   }

}
