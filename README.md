## Тестовое задание на laravel, так же будет на symfony.
запуск проекта
создать проект ларавел, склонить с гита. 

Создать БД

php artisan migrate

php artisan serve


## Скринкаст Tables

GET http://127.0.0.1:8000/api/tables

![alt text](image-3.png)

GET http://127.0.0.1:8000/api/tables/{id}

![alt text](image.png)

PATCH http://127.0.0.1:8000/api/tables/{id}

![alt text](image-1.png)

GET http://127.0.0.1:8000/api/tables/{id}/guests

![alt text](image-2.png)

GET http://127.0.0.1:8000/api/tables_stats

![alt text](image-4.png)


## Скринкаст GuestList

GET http://127.0.0.1:8000/api/guest_lists
![alt text](image-5.png)

GET http://127.0.0.1:8000/api/guest_lists/{id}
![alt text](image-6.png)

PATCH http://127.0.0.1:8000/api/guest_lists/{id}
![alt text](image-7.png)


## Дополнительно
POST http://127.0.0.1:8000/api/tables

![alt text](image-8.png)

POST http://127.0.0.1:8000/api/guests

![alt text](image-9.png)

POST http://127.0.0.1:8000/api/login

![alt text](image-10.png)