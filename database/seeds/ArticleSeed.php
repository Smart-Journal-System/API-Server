<?php

use App\Article;
use App\User;

use Illuminate\Database\Seeder;

class ArticleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $users = User::all();

        foreach ($users as $user) {
            for ($i = 0; $i < 1000; $i++) {
                Article::create([
                    'journal_id' => rand(1, 3),
                    'user_id' => $user->id,
                    'title' => $faker->realText(255)
                ]);
            }

            $this->command->info('Created 1000 articles for ' . $user->username);
        }
    }
}
