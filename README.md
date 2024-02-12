# The Bookstore API

is a simple robust RESTful web service designed to manage information about books and their respective authors. The API allows users to perform CRUD operations on both books and authors, facilitating seamless integration into various applications. 

**_No Authentication, Rate Limiting, Documentation (except described in this file), Caching, Versioning, Tests implemented._**

Requirements:
You need to have Docker Engine and Docker Compose on your machine.

In order to run application:

1) cd to app directory
2) execute: docker compose up -d
3) execute: php bin/console doctrine:migrations:migrate
2) use endpoints described below with http://localhost:81/, for example:

  GET http://localhost:81/books

  GET http://localhost:81/authors

In order to run application with xdebug execute:
XDEBUG_MODE=debug docker compose -f docker-compose.yaml up -d

---

**Endpoints:**

1. **Get All Books**
    - **Endpoint:** `GET /books`
    - **Description:** Retrieve a list of all books available in the bookstore.

2. **Get Book by ID**
    - **Endpoint:** `GET /books/{id}`
    - **Description:** Retrieve detailed information about a specific book identified by its unique ID.

3. **Create a New Book**
    - **Endpoint:** `POST /books`
    - **Description:** Add a new book to the bookstore. Requires a JSON payload with book details.

4. **Update Book Information**
    - **Endpoint:** `PUT /books/{id}`
    - **Description:** Update the information of an existing book identified by its unique ID. Requires a JSON payload with the updated book details.

5. **Delete a Book**
    - **Endpoint:** `DELETE /books/{id}`
    - **Description:** Remove a book from the bookstore based on its unique ID.

6. **Get All Authors**
    - **Endpoint:** `GET /authors`
    - **Description:** Retrieve a list of all authors with their associated books.

7. **Get Author by ID**
    - **Endpoint:** `GET /authors/{id}`
    - **Description:** Retrieve detailed information about a specific author identified by their unique ID.

8. **Create a New Author**
    - **Endpoint:** `POST /authors`
    - **Description:** Add a new author to the bookstore. Requires a JSON payload with author details.

9. **Update Author Information**
    - **Endpoint:** `PUT /authors/{id}`
    - **Description:** Update the information of an existing author identified by their unique ID. Requires a JSON payload with the updated author details.

10. **Delete an Author**
    - **Endpoint:** `DELETE /authors/{id}`
    - **Description:** Remove an author from the bookstore based on their unique ID. Associated books will remain in the system.

---

Опис завдання.

API:

   a) Роут для створення авторів

   b) Роут для перегляду списку всіх авторів

   c) Роут для створення книг

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


