<?php

namespace Website\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use  Website\AdminBundle\Model\Image as BaseImage;

/**
 *
 * @ORM\Entity
 * @ORM\Table(name="image_presentation")
 * @ORM\HasLifecycleCallbacks
 */
class SocieteLogo extends BaseImage
{
    /**
     * @ORM\Column(name="associated", type="boolean", nullable=true)
     */
    private $associated;

    public function setAssociated($associated)
    {
        $this->associated = $associated;
        return $this;
    }

    public function getAssociated()
    {
        return $this->associated;
    }

    public function getUploadDir()
    {
        return 'img/societes/logos';
    }
}