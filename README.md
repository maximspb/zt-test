Процедура разворачивания проекта:
1. Склонируйте проект
2. Скачайте с официального сайта Phing архив phar с последней версией финга 
https://www.phing.info/
   (по умолчанию файл называется phing-latest.phar)
   Поместите его в папку проекта.
3. Находясь в папке проекта, выполните консольную команду вида:   
php phing-latest.phar -f ./build/build.xml -Dadmin.email=ЕМЕЙЛ_АДМИНА 
-Dadmin.password=ПАРОЛЬ_АДМИНА -Deditor.email=ЕМЕЙЛ_РЕДАКТОРА 
-Deditor.password=ПАРОЛЬ_РЕДАКТОРА 
-Ddb.name=НАЗВАНИЕ_БАЗЫ 
-Ddb.username=ЛОГИН_БАЗЫ 
-Ddb.password=ПАРОЛЬ_БАЗЫ

Пример:
php phing-latest.phar -f ./build/build.xml -Dadmin.email=admin@zt-test.local -Dadmin.password=123456 -Deditor.email=editor@zt-test.local -Deditor.password=123456 -Ddb.name=check2 -Ddb.username=homestead -Ddb.password=secret

Пароль админа и редактора - не менее 6 символов
Запустится процедура сборки, в ходе которой:
данные конфигов запишутся в .env (лежит под гитигнором)
установятся зависимости
применятся миграции, в том числе миграции rbac
для админа и первого редактора будут присвоены роли
таблицы прокси и юзеров будут наполнены тестовыми данными
после завершения сборки проекта можно зайти в систему под логинами admin или editor1 с теми паролями, которые указаны при запуске сборки.

