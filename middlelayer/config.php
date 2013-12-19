<!-- Copyright 2013 Jason Hejna

This file is part of howmanycupsofcoffee.

    howmanycupsofcoffee is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    howmanycupsofcoffee is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with howmanycupsofcoffee.  If not, see <http://www.gnu.org/licenses/>. -->
    
<?php
//Please use a difficult to crack password for $web_password, and a $web_username greater than four characters. I can't save you from yourself
//Also, be aware, you should have ssl on the web server your running this on. Or else you're vulnerable to session injection attacks.
$timezone		= 'America/Detroit'; //for a full list of time zones in php see http://php.net/manual/en/timezones.php
$web_secret		= '1234';
$webusername	= 'myusername';
$webpassword	= 'mypassword';
$dbhostaddress	= 'localhost';
$dbname 		= 'mydbname';
$dbuser			= 'mydbusername';
$dbpass			= 'mydbpassword';
?>