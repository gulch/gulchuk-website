<?php

use Phinx\Seed\AbstractSeed;

class ArticlesSeed extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            $title = $faker->text(70);
            $data[] = [
                'slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title))),
                'title' => $title,
                'content' => $faker->text(random_int(256, 1024)),
                'is_published' => 1,
                'seo_title' => $title,
                'seo_description' => $faker->text(255),
                'seo_keywords' => str_replace(' ', ', ', $faker->text(100)),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->insert('Article', $data);
    }
}
