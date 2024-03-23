# The Bookstore API

is a simple robust RESTful web service designed to manage information about books and their respective authors. The API allows users to perform CRUD operations on both books and authors, facilitating seamless integration into various applications. 

**_No Authentication, Rate Limiting, Documentation (except short description below), Caching, Versioning, Tests, Exception Handling implemented._**

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

Task Description (+ request examples).

API:

  a) Route for creating authors

      POST /api/author
      {
      "firstName": "Jules",
      "lastName": "Verne",
      "middleName": "Gabriel"
      }

   b) Route for viewing the list of all authors
   
      GET /api/authors/{page}

   c) Route for creating books

     POST /api/book
      {
      "title": "The Begum's Fortune",
      "description": "It is noteworthy as the first published book in which Verne was cautionary, and somewhat pessimistic about the development of science and technology.",
      "authorsIds": [1],
      "publicationDate": "1879"
      }   

   d) Route for viewing the list of all books
   
      GET /api/books/{page}

   e) Route for searching for books by author's last name
      
      -

   f) Route for viewing a single book

      GET /api/book/{id}

   g) Route for editing a book

      PUT /api/book/{id}
      {
      "title": "The Begum's Fortune",
      "description": "It is noteworthy as the first published book in which Verne was cautionary, and somewhat pessimistic about the development of science and technology.",
      "authorsIds": [1],
      "publicationDate": "1879"
      } 
   
   h) Route for uploading an image

      POST /api/book/{id}/cover
      Request Body
      cover: {file}

Data Description.

a) Each book must have:
Title. (Mandatory field)
Short description. (Optional field)
Image. (jpg or png, no larger than 2MB, must be stored in a separate folder and have a unique file name)
Authors. (Mandatory field, a book can have multiple authors)
Publication date of the book.
b) Each author must have:
Last name (Mandatory field, no shorter than 3 characters)
First name (Mandatory)


