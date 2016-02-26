<?php

namespace Klever\TutorTest\AccessMethod\TestAsset;

class StateProvider
{
    protected $active = false;

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return boolean
     */
    public function isInactive()
    {
        return !$this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}
