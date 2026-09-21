<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::current();
        $featuredProducts = Product::active()->featured()->orderBy('sort_order')->take(6)->get();
        $latestProducts = Product::active()->orderBy('sort_order')->take(8)->get();
        $testimonials = Testimonial::active()->orderBy('sort_order')->get();
        $faqs = Faq::active()->orderBy('sort_order')->get();

        return view('home', compact('settings', 'featuredProducts', 'latestProducts', 'testimonials', 'faqs'));
    }
}
