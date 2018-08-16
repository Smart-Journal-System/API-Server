<?php

use App\Article;
use App\ArticleVersion;
use App\ArticleVersionData;
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
            for ($i = 0; $i < 100; $i++) {
                $article = Article::create([
                    'journal_id' => rand(1, 3),
                    'user_id' => $user->id,
                    'title' => $faker->realText(255)
                ]);

                $article_version = ArticleVersion::create([
                    'article_id' => $article->id,
                    'version' => 1
                ]);

                ArticleVersionData::create([
                    'article_version_id' => $article_version->id,
                    'journal_article_field_id' => 1,
                    'value' => $faker->realText(255)
                ]);

                ArticleVersionData::create([
                    'article_version_id' => $article_version->id,
                    'journal_article_field_id' => 2,
                    'value' => $faker->realText(66)
                ]);
            }

            $this->command->info('Created 1000 articles for ' . $user->username);
        }
    }
}
