<?php

namespace Linktocontenu\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Rubrique\Model\RubriqueDao;
use ExtLib\Utils;

/**
 * Class LinktocontenuForm
 * @package Linktocontenu\Form
 */
class LinktocontenuForm extends Form {

    protected $utils;

    /**
     * @return array
     */
    protected function getRubriques() {

        $rubriquesDao = new RubriqueDao();

        $rubriques = $rubriquesDao->getAllRubriques("array");

        $rubriqueArray = array();

        foreach ($rubriques as $value) {

            $rubriqueArray[$value['id']] = $value['libelle'];
        }

        return $rubriqueArray;
    }

    /*
      protected function getSousRubriques($rubid){

      $sousrubriquesDao=  new SousRubriqueDao();

      $sousrubriques = $sousrubriquesDao->getSousrubriquesByRubrique($rubid,"array");

      $sousrubriqueArray = array();

      foreach($sousrubriques as $value){

      $sousrubriqueArray[$value['id']]=$value['libelle'];

      }

      return $sousrubriqueArray;
      }
     */

    /**
     * LinktocontenuForm constructor.
     * @param null $name
     */
    public function __construct($name = null) {

        $this->utils = new Utils();

        // we want to ignore the name passed
        parent::__construct('linktocontenuform');
        //$this->setHydrator(new ClassMethods);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
                'value' => 0
            ),
        ));

        /**
          Select the content that have to be linked in another section
         *         */
         $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'rubriquesList',
            'attributes' => array(
                'id' => 'rubriqueSelectIdTag',
                'class' => 'rubriqueSelectIdClass'
            ),
            'options' => array(
                //'label' => 'Choisir la rubrique',
                'empty_option' => $this->utils->translate('Sélectionner une rubrique'),
                //'class' => 'input-medium',
                'value_options' => $this->getRubriques()
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sousrubriquesList',
            'attributes' => array(
                'id' => 'sousrubriqueSelectIdTag',
                'class' => 'sousrubriqueSelectIdClass'
            ),
            'options' => array(
                //'label' => 'Choisir la rubrique',
                'empty_option' => $this->utils->translate('Sélectionner une sous-rubrique'),
                'disable_inarray_validator' => true
            //'class' => 'input-medium',
            //'value_options' => $this->getSousRubriques()
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'contenusList',
            'attributes' => array(
                'id' => 'contenusSelectIdTag',
                'class' => 'contenusSelectIdClass'
            ),
            'options' => array(
                //'label' => 'Choisir la rubrique',
                'empty_option' => $this->utils->translate('Sélectionner un contenu'),
                'disable_inarray_validator' => true
                //'class' => 'input-medium',
                //'value_options' => //$this->getRubriques()
            ),
        ));

/**
    Select which section you want to create a link to the selected content
 * 
 *  */
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'rubriqueswhereislinkList',
            'attributes' => array(
                'id' => 'rubriquewhereislinkId',
                'class' => 'rubriquewhereislinkId'
            ),
            'options' => array(
                //'label' => 'Choisir la rubrique',
                'empty_option' => $this->utils->translate('Sélectionner une rubrique'),
                //'class' => 'input-medium',
                'value_options' => $this->getRubriques()
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sousrubriqueswhereislinkList',
            'attributes' => array(
                'id' => 'sousrubriquewhereislinkId',
                'class' => 'sousrubriquewhereislinkClass'
            ),
            'options' => array(
                //'label' => 'Choisir la rubrique',
                'empty_option' => $this->utils->translate('Sélectionner une sous-rubrique'),
                'disable_inarray_validator' => true
            //'class' => 'input-medium',
            //'value_options' => $this->getSousRubriques()
            ),
        ));

        $this->add(array(
            'name' => 'titre',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => $this->utils->translate('Titre'),
            ),
        ));

        $this->add(array(
            'name' => 'soustitre',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => $this->utils->translate('Sous-Titre'),
            ),
        ));

        $this->add(array(
            'name' => 'position',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => $this->utils->translate('Position'),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'html',
            'attributes' => array(
                'id' => 'htmlId',
                'class' => 'htmlClass'
            )
        ));

        $this->add(array(
            'name' => 'imagepath',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => $this->utils->translate('Image')
            ),
        ));

        $this->add(array(
            'name' => 'imagepath2',
            'attributes' => array(
                'type' => 'text'
            ),
            'options' => array(
                'label' => $this->utils->translate('Image 2')
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Button',
            'name' => 'submitbutton',
            'options' => array(
                'label' => $this->utils->translate('Valider'),
            ),
            'attributes' => array(
                'value' => $this->utils->translate('Valider'),
                'id' => 'submitbutton',
            ),
        ));
    }

}
