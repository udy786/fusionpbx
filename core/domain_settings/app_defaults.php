<?php
/*
	FusionPBX
	Version: MPL 1.1

	The contents of this file are subject to the Mozilla Public License Version
	1.1 (the "License"); you may not use this file except in compliance with
	the License. You may obtain a copy of the License at
	http://www.mozilla.org/MPL/

	Software distributed under the License is distributed on an "AS IS" basis,
	WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
	for the specific language governing rights and limitations under the
	License.

	The Original Code is FusionPBX

	The Initial Developer of the Original Code is
	Mark J Crane <markjcrane@fusionpbx.com>
	Portions created by the Initial Developer are Copyright (C) 2008-2017
	the Initial Developer. All Rights Reserved.

	Contributor(s):
	Mark J Crane <markjcrane@fusionpbx.com>
*/

//proccess this only one time
	if ($domains_processed == 1) {
		//set domains with enabled status of empty or null to true
			$sql = "update v_domains set domain_enabled = 'true' where domain_enabled = '' or domain_enabled is null";
			$db->exec(check_sql($sql));
			unset($sql);
		//update any domains set to legacy languages
			$language = new text;
			foreach ($language->legacy_map as $language_code => $legacy_code) {
				if(strlen($legacy_code) == 5)
					continue;
				$sql = "update v_domain_settings set domain_setting_value = '$language_code' where domain_setting_value = '$legacy_code' and deafult_setting_name = 'code' and domain_setting_dubcategory = 'language' and domain_setting_category = 'domain'";
				$db->exec(check_sql($sql));
				unset($sql);
			}
	}

?>