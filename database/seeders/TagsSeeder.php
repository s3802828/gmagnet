<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $listOfTag = ['Adventure', 'Horror','Science-Fiction', 'Action', 'RPG', 'Multiplayer', 'Puzzle','Racing','Comedy','War', 'Romance', '3D', 
        'Sandbox', 'Shooting', 'Simulation', 'Survival' , 'Visual-Novel', 'Turn-Based', 'Point&Click', 'Adult'];
        foreach ($listOfTag as $tagName){
            Tag::create([
                'name' => $tagName,
            ]
            );
        } 
    }
}
