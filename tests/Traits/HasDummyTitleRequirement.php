<?php

namespace Tests\Traits;

use App\Models\{Title, TitleRequirement};
use Illuminate\Database\Eloquent\Collection;

trait HasDummyTitleRequirement
{
    /**
     * Create a new dummy title requirement.
     *
     * @param array $data
     * @param string $state
     * @return \App\Models\TitleRequirement
     */
    public function createDummyTitleRequirement(array $data = []): TitleRequirement
    {
        return TitleRequirement::factory()->create($data);
    }

    /**
     * Create new dummy title requirements.
     *
     * @param int $times
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createDummyTitleRequirements(int $times, array $data = []): Collection
    {
        return TitleRequirement::factory($times)->create($data);
    }

    /**
     * Associate a title requirement for title.
     *
     * @param \App\Models\Title $title
     * @param array $data
     * @return \App\Models\TitleRequirement
     */
    public function createDummyTitleRequirementTo(Title $title, array $data = []): TitleRequirement
    {
        $titleRequirement = $this->createDummyTitleRequirement($data);

        $title->requirements()->save($titleRequirement)->save();

        return $titleRequirement;
    }
}
