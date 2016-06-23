<?php

use Phinx\Seed\AbstractSeed;

class TestArticles extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'slug' => str_slug($faker->text(50)),
                'title' => $faker->text(50),
                'content' => $faker->text(random_int(256, 1024)),
                'seo_title' => $faker->text(50),
                'seo_description' => $faker->text(255),
                'seo_keywords' => $faker->text(100),
                'image_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->insert('Article', $data);
    }
}
