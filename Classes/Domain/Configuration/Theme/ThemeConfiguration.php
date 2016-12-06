<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2013 Daniel Lienert <typo3@lienert.cc>
*  			Michael Knoll <mimi@kaktusteam.de>
*  			
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class implements theme configuration object for YAG.
 *
 * @package Domain
 * @subpackage Configuration\Theme
 * @author Daniel Lienert <typo3@lienert.cc>
 */
class Tx_Yag_Domain_Configuration_Theme_ThemeConfiguration extends \PunktDe\PtExtbase\Configuration\AbstractConfiguration
{
    /**
     * Resolution config collection
     * @var Tx_Yag_Domain_Configuration_Image_ResolutionConfigCollection
     */
    protected $resolutionConfigCollection;
    
    
    /**
     * Show breadcrumbs
     * 
     * @var boolean
     */
    protected $showBreadcrumbs = true;
    

    /**
     * Array of theme defined CSS files
     * 
     * @var array
     */
    protected $includeCSS = array();


    /**
     * Array of theme defines JS files
     * 
     * @var array
     */
    protected $includeJS = array();
    
    
    /**
     * List of librariers to include JS from
     * 
     * @var array
     */
    protected $includeLibJS = array();
    
    
    /**
     * List of librariers to include CSS from
     * 
     * @var array
     */
    protected $includeLibCSS = array();


    /**
     * @var string
     */
    protected $jsPosition = 'footer';


    /**
     * @var string
     */
    protected $name;


    /**
     * @var string
     */
    protected $title;


    /**
     * @var string
     */
    protected $description;


    /**
     * @param \PunktDe\PtExtbase\Configuration\AbstractConfigurationBuilder $configurationBuilder
     * @param $themeName
     * @param array $settings
     */
    public function __construct(\PunktDe\PtExtbase\Configuration\AbstractConfigurationBuilder $configurationBuilder, array $settings = array(), $themeName = null)
    {
        $settings['name'] = $themeName;
        parent::__construct($configurationBuilder, $settings);
    }


    /**
     * Initializes configuration object (Template method)
     */
    protected function init()
    {
        $this->setRequiredValue('name', 'Theme name was not set! 1316764051');

        $this->resolutionConfigCollection = Tx_Yag_Domain_Configuration_Image_ResolutionConfigCollectionFactory::getInstance($this->configurationBuilder, $this->settings['resolutionConfigs']);
        $this->setBooleanIfExistsAndNotNothing('showBreadcrumbs');
        
        $this->setValueIfExistsAndNotNothing('includeJS');
        $this->setValueIfExistsAndNotNothing('includeCSS');

        $this->setValueIfExistsAndNotNothing('jsPosition');

        $this->setValueIfExistsAndNotNothing('title');
        if (!$this->title) {
            $this->title = $this->name;
        }
        if (GeneralUtility::isFirstPartOfStr($this->title, 'LLL:')) {
            $this->name = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($this->title, '');
        }

        $this->setValueIfExistsAndNotNothing('description');
        if (GeneralUtility::isFirstPartOfStr($this->description, 'LLL:')) {
            $this->description = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate($this->description, '');
        }

        if (array_key_exists('includeLibJS', $this->settings) && trim($this->settings['includeLibJS'])) {
            $this->includeLibJS = GeneralUtility::trimExplode(',', $this->settings['includeLibJS']);
        }
        
        if (array_key_exists('includeLibCSS', $this->settings) && trim($this->settings['includeLibCSS'])) {
            $this->includeLibCSS = GeneralUtility::trimExplode(',', $this->settings['includeLibCSS']);
        }
    }
    
    
    
    /**
     * Returns a template for controller / action kombination if defined
     * 
     * @param string $controller
     * @param string $action
     * @return string
     */
    public function getTemplate($controller, $action)
    {
        if (array_key_exists('controller', $this->settings) && is_array($this->settings['controller'])) {
            return $this->settings['controller'][$controller][$action]['template'];
        }
        
        return '';
    }
    
    
    
    /**
     * @return boolean 
     */
    public function getShowBreadcrumbs()
    {
        return $this->showBreadcrumbs;
    }
    
    
    
    /**
     * @param boolean $showBreadCrumbs
     */
    public function setShowBreadcrumbs($showBreadCrumbs)
    {
        $this->showBreadcrumbs = $showBreadCrumbs;
    }
    
    
    /**
     * @return boolean
     */
    public function getShowPager()
    {
        return $this->showPager;
    }
    
    
    
    /**
     * @return Tx_Yag_Domain_Configuration_Image_ResolutionConfigCollection
     */
    public function getResolutionConfigCollection()
    {
        return $this->resolutionConfigCollection;
    }
    
    
    
    /**
     * Array of CSS files to include in the header
     * 
     * @return array
     */
    public function getCSSFiles()
    {
        return $this->includeCSS;
    }
    
    
    
    /**
     * Array of JS files to include
     * 
     * @return array
     */
    public function getJSFiles()
    {
        return $this->includeJS;
    }
    
    
    
    /**
     * Array of libraries to include JS from
     * @return array
     */
    public function getJSLibraries()
    {
        return $this->includeLibJS;
    }
    
    
    
    /**
     * Array of libraries to include CSS from
     * @return array
     */
    public function getCSSLibraries()
    {
        return $this->includeLibCSS;
    }



    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }



    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * @return string
     */
    public function getJsPosition()
    {
        return $this->jsPosition;
    }
}
