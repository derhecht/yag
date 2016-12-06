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

/**
 * Class implements item configuration object for YAG.
 *
 * @package Domain
 * @subpackage Configuration\Item
 * @author Daniel Lienert <typo3@lienert.cc>
 * @author Michael Knoll <mimi@kaktusteam.de>
 */
class Tx_Yag_Domain_Configuration_Item_ItemConfig extends \PunktDe\PtExtbase\Configuration\AbstractConfiguration
{
    /**
     * Holds partial name used for rendering item meta information
     *
     * @var string
     */
    protected $itemMetaPartial;


    /**
     * @var string
     */
    protected $itemFormFieldsPartial;


    
    /**
     * Initializes configuration object (Template method)
     */
    protected function init()
    {
        $this->setRequiredValue('itemMetaPartial', 'Required setting "itemMetaPartial" could not be found in item settings! 1299437845');
        $this->setRequiredValue('itemFormFieldsPartial', 'Required setting "itemFormFieldsPartial" could not be found in item settings! 1385104542');
    }


    
    /**
     * Getter for partial for item meta information
     *
     * @return string  Name of partial for item meta information
     */
    public function getItemMetaPartial()
    {
        return $this->itemMetaPartial;
    }



    /**
     * @param string $itemFormFieldsPartial
     */
    public function setItemFormFieldsPartial($itemFormFieldsPartial)
    {
        $this->itemFormFieldsPartial = $itemFormFieldsPartial;
    }



    /**
     * @return string
     */
    public function getItemFormFieldsPartial()
    {
        return $this->itemFormFieldsPartial;
    }
}
