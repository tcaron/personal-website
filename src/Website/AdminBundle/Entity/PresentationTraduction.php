<?php

namespace Website\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Presentation
 *
 * @ORM\Table(name="presentation_traduction")
 * @ORM\Entity(repositoryClass="Website\AdminBundle\Repository\PresentationTraductionRepository")
 */
class PresentationTraduction
{

     /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

   /**
   * @ORM\ManyToOne(targetEntity="Website\AdminBundle\Entity\Presentation", inversedBy="presentation_traduction", cascade={"persist", "remove", "merge"})
   * @ORM\JoinColumn(name="presentation_id", referencedColumnName="id",nullable=false)
   */
    private $presentation_id;

    /**
     * @ORM\Column(name="description", type="text", nullable=false, length=1000)
    */
    private $description;

    /**
     * @ORM\Column(name="locale", type="string", nullable=false,length=2)
    */
    private $locale;

    /**
     * Set description
     *
     * @param string $description
     *
     * @return PresentationTraduction
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return PresentationTraduction
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set presentationId
     *
     * @param \Website\AdminBundle\Entity\Presentation $presentationId
     *
     * @return PresentationTraduction
     */
    public function setPresentationId(\Website\AdminBundle\Entity\Presentation $presentationId)
    {
        $this->presentation_id = $presentationId;

        return $this;
    }

    /**
     * Get presentationId
     *
     * @return \Website\AdminBundle\Entity\Presentation
     */
    public function getPresentationId()
    {
        return $this->presentation_id;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
