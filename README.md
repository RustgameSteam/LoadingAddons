# LoadingAddons
Использование аддонов из сайтов.
## Все функции:
1. **function LA_LoadingAddons(string URL, string AddonName)** - Получение и запуск аддона\
* Если AddonName равен all, то будут запущены все аддоны со всех каталогах\
* Если вы запускаете по отдельности, то указывайте еще путь до скрипта.
2. **function LA_ErrorLog(bool Error, any ...)** - Логирование ошибок и.или успешных загрузок аддонов\
* В случае если Error равен true:\
	* **LA_ErrorLog(true, string CodeLog, string AddonName, string Error)** - В случае ошибки вызванные запуском аддона\
* В случае если Error равен false\
	* Success равен true:
	**LA_ErrorLog(false, bool Success, string AddonName)** - В случае успешного запуска аддона\
	* Success равен false:
	**LA_ErrorLog(false, bool Success, string AddonName, string Text)** - Причину ошибки можете указать сами\ 
