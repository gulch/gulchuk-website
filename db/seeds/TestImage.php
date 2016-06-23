<?php

use Phinx\Seed\AbstractSeed;

class TestImage extends AbstractSeed
{
    public function run()
    {
        $data = [
            'alt' => 'Test Sample Image',
            'path' => '2016/06/test-sample-image.png'
        ];
        $this->insert('Image', $data);
    }
}
