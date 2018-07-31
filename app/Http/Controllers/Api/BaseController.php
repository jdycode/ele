<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //    跨域
    public function __construct()
    {
        header('Access-Control-Allow-Origin:*');
    }
}
