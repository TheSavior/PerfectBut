<?php
namespace Application;
/**
 * Copyright Eli White & SaroSoftware 2010
 * Last Modified: 3/26/2010
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
 * Place all application initialization here.
 */
class Setup
{
	public static $defaultModule = "Main";

	/**
	 * Sets some settings for the application
	 */
	static function doSetup($registry)
	{
		// Set up our config values
		$registry->config->siteUrl = $_SERVER["ROOT"];
		$registry->config->rewriting = true;
                        
		// Set the default theme
		$registry->display->setTheme("Default");
		// Set up the controller's template
		$registry->display->setLayout("Main");
        
        $registry->config->db = "";
                      
        // Check if we should use production database or not
        if (isset($_SERVER["CLEARDB_DATABASE_URL"]))
        {
            $registry->config->db = $_SERVER["CLEARDB_DATABASE_URL"];
        }
        else
        {   
            $registry->config->db = 'mysql://'.$_SERVER["DBUSER"].':'.$_SERVER["DBPASS"].'@'.$_SERVER["HOSTNAME"].'/'.$_SERVER["DBNAME"];
        }
        
        
	}
}
