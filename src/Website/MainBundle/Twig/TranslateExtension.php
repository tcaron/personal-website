<?php

namespace Website\AdminBundle\Twig;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\HttpFoundation\RequestStack;

class TranslateExtension extends \Twig_Extension{
  
  /**
   * @var string 
   */
  protected $locale;

  /**
   * @var string
   */
  protected $defautLocale;

   /**
    *
    * @var \Symfony\Component\PropertyAccess\PropertyAccessor
    */
   protected $propertyAccessor;

   public function _construct(RequestStack $requestStack){
   	
   	if ($requestStack->getMasterRequest()){
   		$this->locale = $requestStack->getMasterRequest()->getLocale();
   		$this->defautLocale = $requestStack->getMasterRequest()->getDefaultLocale();
  	}
  	$this->propertyAccessor = PropertyAccess::createPropertyAccessor();
   }

   public function getFunctions(){

   	return array(new \Twig_SimpleFunction('translate',array($this,'translate')),
   		);
   }

   public function translate($array, $key){

   	if (!is_array($array) && method_exists($array,'toArray')){
   		$array = $array->toArray();
   	}

   	elseif (!is_array($array)){
   		throw new \Exception('Translation need an array or an object wich implements "To Array"');
   		
   	}

   	if (isset($array[$this->locale])){
   		return $this->propertyAccessor->getValue($array[$this->locale],$key);
   	}
   	 
   	if(isset($array[$this->defaultLocale]))
     {
       return $this->propertyAccessor->getValue($array[$this->defaultLocale], $key);
     }

     else
     {
        throw new \Exception('Object key "'.$key.'" not translated');
     }




   }

    public function getName()
    {
        return 'translate';
    }

}