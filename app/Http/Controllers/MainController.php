<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        return view('index');
    }

    public function recruit() {
        $faker = \Faker\Factory::create('ja_JP');

        $companyData = [];

        for ($i = 1; $i <= 10; $i++) {
            $companyData[] = [
                'id' => $i,
                'company_name' => $faker->company,
                'business_description' => $faker->realText(400),
                'company_pr' => $faker->realText(400),
                'business_details' => $faker->realText(400),
                'photo1' => $faker->imageUrl(480, 640, 'cats'),
                'photo2' => $faker->imageUrl(480, 640, 'cats'),
                'photo3' => $faker->imageUrl(480, 640, 'cats'),
                'followed' => $faker->boolean,
            ];
            $postData[] =[
                'id' => $i,
                'company_name' => $faker->company,
                'introduction' => $faker->realText(400),
                'photo' => $faker->imageUrl(640, 640, 'cats'),
            ];
        }
        $data = [
            'companies' => $companyData,
            'posts' => $postData,
        ];
        return view('recruit.recruit', $data);
    }

    public function companyDetail($id) {
        $data = [];
        return view('recruit.detail', $data);
    }
}
