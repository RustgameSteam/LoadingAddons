<?php
	$GetTime        = false;										// Защита по времени
	$allowed_ip     = "IP";											// Разрешенные IP Адреса для получения
	$timeAccess     = strtotime(gmdate('Y-m-d ') . "02:10:00"); 	// Разрешённое время доступа
	$maxDelay       = 5 * 60; 										// Максимально разрешённая разница во времени доступа
	$addon_dir      = "addonslist";									// Каталог с аддонами
	$CallBackCode   = file_get_contents("error.lua");				// Файл Еррор лога, CallBack вывода в консоль сервера.
	$client_ip = getenv('HTTP_CLIENT_IP')?:
		getenv('HTTP_X_FORWARDED_FOR')?:
		getenv('HTTP_X_FORWARDED')?:
		getenv('HTTP_FORWARDED_FOR')?:
		getenv('HTTP_FORWARDED')?:
		getenv('REMOTE_ADDR');

	if ($allowed_ip == $client_ip)
	{
		if ($GetTime)
		{
			if (abs(time() - $timeAccess) != $maxDelay)
			{
				exit;
			}
		}

		if ($_GET['an'])
		{
			$Addon = (string) $_GET['an'];
		}
		else
		{
			echo 'print("[ Loading Addons ] Лог завершен: Вы указали пустое значение!")';
			exit;
		}

		if ($Addon == "all")
		{
			$CallBackCode = "";
			if (is_dir($addon_dir))
			{
				$files1 = array_diff(scandir($addon_dir), array('..', '.'));
				foreach ($files1 AS $i => $file1)
				{
					if (!is_dir($addon_dir."/".$file1))
					{
						echo file_get_contents($addon_dir."/".$file1);
					}
					else
					{
						$files2 = array_diff(scandir($addon_dir."/".$file1), array('..', '.'));
						foreach ($files2 AS $i => $file2)
						if (!is_dir($addon_dir."/".$file1."/".$file2))
						{
							echo file_get_contents($addon_dir."/".$file1."/".$file2);
						}
						else
						{
							$files3 = array_diff(scandir($addon_dir."/".$file1."/".$file2), array('..', '.'));
							foreach ($files3 AS $i => $file3)
							if (!is_dir($addon_dir."/".$file1."/".$file2."/".$file3))
							{
								echo file_get_contents($addon_dir."/".$file1."/".$file2."/".$file3);
							}
						}
					}
				}
			}
			else
			{
				echo 'print("[ Loading Addons ] В файле конфигурации неправильно указан каталог с аддонами!")';
			}
		}
		else
		{
			echo file_get_contents($addon_dir."/".$_GET['an']);
		}
	}
	else
	{
		echo $CallBackCode;
	}
?>
