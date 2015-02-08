<?php

if (!defined('NGCMS'))
{
	die ('HAL');
}

function plugin_suser_install($action) {
	global $lang;
	
	switch ($action) {
		case 'confirm':generate_install_page('suser', 'Cейчас плагин будет установлен');break;
		case 'autoapply':
		case 'apply':
			if (fixdb_plugin_install('suser', $db_update, 'install', ($action=='autoapply')?true:false)) {

				$ULIB = new urlLibrary();
				$ULIB->loadConfig();
	
				$UHANDLER = new urlHandler();
				$UHANDLER->loadConfig();
	
				$ULIB->registerCommand('suser', '',
					array ('vars' => array (), 
							'descr' => array ('russian' => 'Сортировка пользователей'),
					)
				);
	
				$ULIB->registerCommand('suser', 'search',
					array ('vars' => array (), 
							'descr' => array ('russian' => 'Поиск пользователей'),
					)
				);
	
				$ULIB->saveConfig();

				plugin_mark_installed('suser');
			} else {
				return false;
			}
			
			extra_commit_changes();
			break;
	}
	return true;
}
