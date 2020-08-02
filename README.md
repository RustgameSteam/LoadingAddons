# LoadingAddons
Загрузка аддонов с вашего Web Сервера.
Делалось это для защиты ваших аддонов Серверной части, от хука при помощью бекдура.
Или прочими методами получить данные с сервера, по мимо бекдура, допустим FTP

Так вы можете хоть как-то защитить очень важные скрипты.
## Все функции:
1. **function LA_LoadingAddons(string URL, string AddonName)** - Получение и запуск аддона
* Если AddonName равен all, то будут запущены все аддоны со всех каталогах
* Если вы запускаете по отдельности, то указывайте еще путь до скрипта.
2. **function LA_ErrorLog(bool Error, any ...)** - Логирование ошибок и.или успешных загрузок аддонов
* В случае если Error равен true:
	* **LA_ErrorLog(true, string CodeLog, string AddonName, string Error)** - В случае ошибки вызванные запуском аддона
* В случае если Error равен false
	* Success равен true:
	**LA_ErrorLog(false, bool Success, string AddonName)** - В случае успешного запуска аддона
	* Success равен false:
	**LA_ErrorLog(false, bool Success, string AddonName, string Text)** - Причину ошибки можете указать сами
3. **function LA_LoadingAddons_From(string URL, string Text)** - Где Text: Обозначение/Наименование чтобы вы знали, что вызвало ошибку.
* Пример использование: Получим данные этого же аддона:
* LA_LoadingAddons_From("https://raw.githubusercontent.com/RustgameSteam/LoadingAddons/master/server/addons/loadingaddons/lua/autorun/server/sv_loadingaddons.lua", "LoadingAddons")
## Настройка Web:
* **Все подробности указаны в самом index.php**
* **Файл error.lua, вызывается при ошибках на стороне Web, если указан пустой [an] или такого файла нет на сайте.** - Можете изменить его под себя, язык: Lua
