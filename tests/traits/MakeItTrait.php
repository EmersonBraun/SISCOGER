<?php

use Faker\Factory as Faker;
use App\Models\It;
use App\Repositories\ItRepository;

trait MakeItTrait
{
    /**
     * Create fake instance of It and save it in database
     *
     * @param array $itFields
     * @return It
     */
    public function makeIt($itFields = [])
    {
        /** @var ItRepository $itRepo */
        $itRepo = App::make(ItRepository::class);
        $theme = $this->fakeItData($itFields);
        return $itRepo->create($theme);
    }

    /**
     * Get fake instance of It
     *
     * @param array $itFields
     * @return It
     */
    public function fakeIt($itFields = [])
    {
        return new It($this->fakeItData($itFields));
    }

    /**
     * Get fake data of It
     *
     * @param array $postFields
     * @return array
     */
    public function fakeItData($itFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $itFields);
    }
}
