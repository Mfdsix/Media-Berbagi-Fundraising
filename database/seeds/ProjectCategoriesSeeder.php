<?php

use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {

            $icon = file_get_contents('http://via.placeholder.com/80x80');
            $image = file_get_contents('http://via.placeholder.com/254x87');

            // upload icon to storage path uploads/category
            $icon_path ='uploads/category/'.Str::random().'.png';
            Storage::disk('local')->put('public/'.$icon_path, $icon);
            // upload image to storage path uploads/category
            $image_path = 'uploads/category/'.Str::random().'.png';
            Storage::disk('local')->put('public/'.$image_path, $image);

            ProjectCategory::create([
                'category' => $faker->word(),
                'path_icon' => $icon_path,
                'image' => $image_path,
                'risalah_status' => false,
            ]);
        }
    }
}
