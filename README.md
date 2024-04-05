# SportNews
## Overview
Symfony 7 web application for showing, adding and editing news.

## Setup
If you wish to run application on local environment:
- fetch repo
- run queries from db_data.sql to create tables and insert example values in your MySQL database instance (for example by MySQL Workbench), make sure that MySQL server is running
- make sure you have composer installed (https://getcomposer.org/download/): type composer --version if you're not sure
- Symfony CLI should be installed as well (https://symfony.com/download)
- type composer install in repo terminal, be sure that in php.ini file extension=zip line is uncommented
- make sure your local instance of database has user root on port 3306 with url 127.0.0.1 - unless you won't be able to do database requests
- if you want to change database connection info, change this line in .env file:
  DATABASE_URL="mysql://type_user_name_here:type_password_here@127.0.0.1:3306/sportNews?charset=utf8mb4"
- type: symfony server:start in terminal and type 127.0.0.1:8000 in browser to load project  

Docker:
- fetch repo
- open project, in terminal type 'cd .docker'
- then type 'docker compose up -d'
- after the containers being composed, go to 'php-1' container terminal in Docker (Show container actions -> Open in terminal)
- type 'composer install'
- in browser type localhost to show main page

## Endpoints
News JSON response:
- GET /news/{id}/json - get news by id with JSON response, i.e.:
```json
{
  "id": 1,
  "title": "Bramka Lewadowskiego w meczu Barcy",
  "text": "Lorem ipsum est docet alert!!!!sssad",
  "createdAt": "2024-03-08T21:48:15+01:00",
  "author": [
    {
      "id": 1,
      "name": "Przemek"
    },
    {
      "id": 3,
      "name": "Cycu"
    }
  ]
}
```
- GET /news/top3 - get top 3 authors that wrote the most articles last week, i.e.:
```json
[
  {
    "name": "Maniek",
    "news_count": 4
  },
  {
    "name": "Przemek",
    "news_count": 3
  },
  {
    "name": "Cycu",
    "news_count": 2
  }
]
```
- GET /news/{author}/all - get all articles for given author, i.e.:
```json
[
  {
    "id": 1,
    "title": "Bramka Lewadowskiego w meczu Barcy",
    "text": "Lorem ipsum est docet alert!!!!sssad",
    "created_at": "2024-03-08 21:48:15"
  },
  {
    "id": 16,
    "title": "zxcv",
    "text": "dqafqf",
    "created_at": "2024-03-10 23:53:27"
  },
  {
    "id": 17,
    "title": "sssss",
    "text": "S",
    "created_at": "2024-03-11 12:49:44"
  }
]
```
News website endpoints:
- GET / - show main page
- GET or POST /news - show page for adding article or send request to add article to database
- GET /news/{id} - show extended news details
- GET or POST /news/{id}/edit - show page for editing article or send request to update article in database


 