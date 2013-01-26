<?php
namespace Application\Modules\Main;

/**
 * Copyright Eli White & SaroSoftware 2010
 * Last Modified: 4/21/2010
 *
 * This file is part of Saros Framework.
 *
 * Saros Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Saros Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Saros Framework.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Initialization class for the Main Module
 */
class Setup
{

	public static $defaultController = "Index";
	public static $defaultAction = "index";

	/**
	 * Sets some settings for the application
	 */
	public function doSetup($registry)
	{
        $registry->facebook = new \Saros\Service\Facebook\Api
        (
            array
            (
                'appId' => '123534114485999',
                'secret' => 'ded21ee9c55a4aa21ee998ccd8761fa1',
            )
        );
        
        $cfg = new \Spot\Config();
        $cfg->addConnection('mysql', 'mysql://'.$_SERVER["DBUSER"].':'.$_SERVER["DBPASS"].'@'.$_SERVER["HOSTNAME"].'/'.$_SERVER["DBNAME"]);
        $registry->mapper = new \Spot\Mapper($cfg);

        $auth = \Saros\Auth::getInstance();

        $authAdapter = new \Application\Classes\Auth\Adapter\FbDb($registry->facebook, $registry->mapper);

        $auth->setAdapter($authAdapter);
        
        $auth->authenticate();
	}
}