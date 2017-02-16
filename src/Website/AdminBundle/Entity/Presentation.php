<?php

namespace Website\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Presentation
 *
 * @ORM\Table(name="presentation")
 * @ORM\Entity(repositoryClass="Website\AdminBundle\Repository\PresentationRepository")
 */
class Presentation 
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
     * @var ArrayCollection $presentation_traduction
     *
     * @ORM\OneToMany(targetEntity="Website\AdminBundle\Entity\PresentationTraduction", mappedBy="presentation_id", cascade={"persist"})
     */
    protected $presentation_traduction;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->presentation_traduction = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add presentationTraduction
     *
     * @param \Website\AdminBundle\Entity\PresentationTraduction $presentationTraduction
     *
     * @return Presentation
     */
    public function addPresentationTraduction(\Website\AdminBundle\Entity\PresentationTraduction $presentationTraduction)
    {
        $this->presentation_traduction[] = $presentationTraduction;

        return $this;
    }

    /**
     * Remove presentationTraduction
     *
     * @param \Website\AdminBundle\Entity\PresentationTraduction $presentationTraduction
     */
    public function removePresentationTraduction(\Website\AdminBundle\Entity\PresentationTraduction $presentationTraduction)
    {
        $this->presentation_traduction->removeElement($presentationTraduction);
    }

    /**
     * Get presentationTraduction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPresentationTraduction()
    {
        return $this->presentation_traduction;
    }
}
