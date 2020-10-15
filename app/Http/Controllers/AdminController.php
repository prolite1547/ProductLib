<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{   

   public function __construct()
   {
      return $this->middleware('auth');
   }
    
   public function index(){
       return view('home');
   }

   public function productsView(){
       return view('pages.products');
   }

   public function addProductView(){
       return view('pages.manage_product.add_product');
   }

   public function reportView(){
       return view('pages.reports');
  }   
  
}
