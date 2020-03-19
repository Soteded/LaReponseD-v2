<?php

use Illuminate\Database\Seeder;

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
            'Jeux vidéo',
            'Film',
            'Livre',
            'Série',
        );
        foreach ($allCategory as $category) {
            Category::create(['categoryName'=> $category]);
        }
    }
}
