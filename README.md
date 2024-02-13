# The Bookstore API

is a simple robust RESTful web service designed to manage information about books and their respective authors. The API allows users to perform CRUD operations on both books and authors, facilitating seamless integration into various applications. 

**_No Authentication, Rate Limiting, Documentation (except described in this file), Caching, Versioning, Tests implemented._**

Requirements:
You need to have Docker Engine and Docker Compose on your machine.

In order to run application:

1) switch to app directory
2) execute: docker compose up -d
3) execute: docker compose exec app bin/console doctrine:migrations:migrate 
4) use endpoints described below, using host **http://localhost:81/**

In order to run application with xdebug execute:
XDEBUG_MODE=debug docker compose -f docker-compose.yaml up -d

---

Опис завдання.

API:

   a) Роут для створення авторів

      POST /api/author
      {
      "firstName": "Jules",
      "lastName": "Verne",
      "middleName": "Gabriel"
      }

   b) Роут для перегляду списку всіх авторів
   
      GET /api/authors/{page}

   c) Роут для створення книг

     POST /api/book
      {
      "title": "The Begum's Fortune",
      "description": "It is noteworthy as the first published book in which Verne was cautionary, and somewhat pessimistic about the development of science and technology.",
      "authorsIds": [1],
      "publicationDate": "1879"
      }   

   d) Роут для перегляду списку всіх книг

   e) Роут для пошуку книг за прізвищем автора

   f) Роут для перегляду однієї книги

   g) Роут для редагування книги

Опис даних.

   a) Кожна книга повинна мати:
1. Назва. (Обов'язкове поле)
2. Короткий опис. (Необов'язкове поле)
3. Зображення. (jpg або png, не більше 2 Мб, повинна зберігатися в окрему
   папку та мати унікальне ім'я файлу)
4. Автори. (Обов'язкове поле може бути кілька авторів в однієї книги)
5. Дата опублікування книги.
   b) У кожного автора мають бути:
1. Прізвище (Обов'язкове поле, не коротше 3 символів)
2. Ім'я (Обов'язкове)
3. По-батькові (Необов'язкове)


