<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allCategory = array(
            'Non référencée',
            'Jeux vidéo',
            'Film',
            'Livre',
            'Série',
            'Autre',
        );

        $allImages =  array(
            'nonRef.png',
            'jeuxVideo.png',
            'film.png',
            'livre.png',
            'serie.png',
            'autre.png',
        );

        for ($i=0; $i < sizeof($allCategory); $i++) { 
            Category::create(['categoryName' => $allCategory[$i], 'image' => $allImages[$i]]);
        }

    }
}
