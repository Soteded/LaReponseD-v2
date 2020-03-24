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
            'Ceci',
            'Est',
            'Un',
            'Test',
            'Donc',
            'Voué',
            'à',
            'disparaitre',
        );

        foreach ($allCategory as $category) {
            Category::create(['categoryName'=> $category]);
        }
    }
}
