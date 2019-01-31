<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class TestController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        //$res = 123;
        $this->categoryRepository->add('тестовая 123');
        $res = $this->categoryRepository->findAll();

        dd($res);
    }
}
