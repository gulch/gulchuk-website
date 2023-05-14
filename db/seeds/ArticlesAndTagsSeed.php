<?php

use Phinx\Seed\AbstractSeed;
use Faker\Factory;

class ArticlesAndTagsSeed extends AbstractSeed
{
    /** @var  \Faker\Generator */
    private $faker;

    protected function init()
    {
        $this->faker = Factory::create();
    }

    public function run(): void
    {
        $this->articlesSeed();
        $this->tagsSeed();
        $this->articlesToTagsSeed();
    }

    private function articlesSeed()
    {
        $data = [];

        for ($i = 1; $i < 11; $i++) {
            $title = $this->faker->text(70);
            $data[] = [
                'id' => $i,
                'slug' => $this->slug($title),
                'title' => $title,
                'content' => $this->faker->text(random_int(1024, 4096)),
                'is_published' => 1,
                'seo_title' => $title,
                'seo_description' => $this->faker->text(255),
                'seo_keywords' => str_replace(' ', ', ', $this->faker->text(100)),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->insert('Article', $data);
    }

    private function tagsSeed()
    {
        $data = [];

        for ($i = 1; $i < 11; $i++) {
            $title = $this->faker->word;

            $data[] = [
                'id' => $i,
                'slug' => $this->slug($title),
                'title' => $title,
                'content' => $this->faker->text(random_int(256, 2048)),
                'seo_title' => $this->faker->text(70),
                'seo_description' => $this->faker->text(255),
                'seo_keywords' => str_replace(' ', ', ', $this->faker->text(100)),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->insert('Tag', $data);
    }

    private function articlesToTagsSeed()
    {
        $data = [
            ['id__Article' => 1, 'id__Tag' => 2],
            ['id__Article' => 1, 'id__Tag' => 3],
            ['id__Article' => 1, 'id__Tag' => 4],
            ['id__Article' => 3, 'id__Tag' => 2],
            ['id__Article' => 4, 'id__Tag' => 2],
            ['id__Article' => 5, 'id__Tag' => 2],
            ['id__Article' => 6, 'id__Tag' => 8],
            ['id__Article' => 9, 'id__Tag' => 4],
        ];

        $this->insert('Article_Tag', $data);
    }

    private function slug(string $text): string
    {
        return strtolower(
            preg_replace(
                '/[^A-Za-z0-9-]+/',
                '-',
                trim($text)
            )
        );
    }
}
