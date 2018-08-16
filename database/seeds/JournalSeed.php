<?php

use App\Journal;
use App\JournalArticleField;

use Illuminate\Database\Seeder;

class JournalSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $journals = [
            [
                'name' => 'Journal of Machine Learning',
                'initials' => 'JML'
            ],
            [
                'name' => 'Journal of Organic Chemistry',
                'initials' => 'Science, yo!'
            ],
            [
                'name' => 'Journal of Rick and Morty',
                'initials' => 'Wubalubadubdub'
            ]
        ];

        foreach ($journals as $journal) {
            $journal = Journal::create($journal);

            JournalArticleField::create([
                'slug' => 'title',
                'journal_id' => $journal->id
            ]);

            JournalArticleField::create([
                'slug' => 'abstract',
                'journal_id' => $journal->id
            ]);
        }
    }
}
