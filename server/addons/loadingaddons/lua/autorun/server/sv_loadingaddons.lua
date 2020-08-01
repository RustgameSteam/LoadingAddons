------------------------------------------------------------------------------------------------------------------------------------------------------
print("[ LoadingAddons ] Запуск ядра.")

if not (file.Exists("la_logs", "DATA")) then 
	file.CreateDir("la_logs") 
	print("[ LoadingAddons ] Каталог: logs/la_logs - Создан!") 
end

function LA_ErrorLog(Error, ...)
	local String = ""
	local Args = {...}
	if (Error) then
		String = "________________[ "..os.date("[ %d.%m.%y ][ %X ]", os.time()).." | Код лог: "..Args[1].." ]________________\
| > Аддон: "..Args[2].."\
| > Error: "..Args[3].."\
_________________________[ Завершение логов ошибки аддона ]__________________________\n"
		file.Append("la_logs/errors.dat", String)
	else
		if (Args[1]) then
			String = os.date("[ %d.%m.%y ][ %X ]", os.time()).." | Аддон: "..Args[2].." Запуск аддона!\n"
		else
			String = os.date("[ %d.%m.%y ][ %X ]", os.time()).." | Аддон: "..Args[2].." "..Args[3].."\n"
		end

		file.Append("la_logs/loading.dat", String)
	end
end

function LA_LoadingAddons(URL, AddonName)
	local CodeLog = "[ "..math.random(1000,9999).."-"..math.random(1000,9999).." ]"
	local URL = URL.."/index.php?an="..AddonName
	print(URL)
	http.Fetch(URL, 
	function(C)
		print(C)
		LA_ErrorLog(false, true, AddonName)
		local succ, err = pcall(function()
			CompileString(C, AddonName)()
		end)
		if (succ) then 
			LA_ErrorLog(false, false, AddonName, "Запуск прошел успешно!") 
		else 
			print("[ LoadingAddons ]: "..AddonName.." Вызвал ошибку: "..CodeLog)
			LA_ErrorLog(true, CodeLog, AddonName, tostring(err).."\n")
			LA_ErrorLog(false, false, AddonName, "Запуск не завершен, есть ошибка! Код Лог: "..CodeLog)
		end
	end,
	function(Error)
		local String = "________________[ "..os.date("[ %d.%m.%y ][ %X ]", os.time()).." | Код лог: "..CodeLog.." ]________________\
| > Аддон: "..AddonName.."\
| > Error: "..Error.."\
_________________________[ Завершение логов ошибок сайта ]__________________________\n"
		file.Append("la_logs/site_errors.dat", String)
	end)
end

print("[ LoadingAddons ] Запуск ядра прошел успешно.")
