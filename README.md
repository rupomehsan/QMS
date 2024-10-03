# Welcome to Quiz Management Application

## Table of contents

-   [Introduction](#introduction)
-   [Features](#features)
-   [Model](#model)
-   [Technologies](#technologies)
-   [Demo Screenshots](#demo-screenshots)
-   [Setup](#setup)

## Introduction

Welcome to the Quiz Management Application! Our application is designed to streamline the process of creating, managing, and conducting quizzes and assessments. Whether you're an educator, trainer, or anyone who needs to assess knowledge, our application provides an efficient and user-friendly platform to help you achieve your goals.

## Features

This website has two Roles:

-   Applicants
-   Admin

## Model

<h3>Application flowchart :</h3>
<div>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/flowc.png?raw=true">
</div>

<h3> Entity relationship diagram : </h3>
<div>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/er-d.png?raw=true">
</div>

### Applicants:

-   May change the details of their profile
-   Can see the list of all quiz .
-   Applicants can attempt the quiz and view the result after submitting the quiz

### Admin:

-   can manage all applicants.

    -   see the results of the applicant quiz

-   quiz management

    -   manage quiz subject
        -   create
        -   edit
        -   update
        -   delete
    -   manage quiz questions
        -   create
        -   edit
        -   update
        -   delete
    -   manage quiz
        -   attach quiz question to each topics
        -   edit
        -   delete

-   User management

    -   manage user

        -   create
        -   edit
        -   update
        -   delete
        -   can see result details of every aplicants

## Technologies

-   PHP Laravel
-   mySQL
-   HTML
-   CSS
-   Java Script
-   Bootstrap

## Demo Screenshots

<div>
	<h3> Login </h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/login.png?raw=true">
</div>

<div>
	<h3> Registration </h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/register.png?raw=true">
</div>

<h1> Admin Panel </h1>

<div>
	<h3> Admin dashboard</h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/dashboard.png?raw=true">
</div>

<div>
	<h3>Subjects manage</h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/subject.png?raw=true">
</div>

<div>
	<h3>Questions manage</h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/question.png?raw=true">
</div>

<div>
	<h3>Applicant </h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/quiz.png?raw=true">
</div>

<div>
	<h3>Applicant result</h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/quiz-result.png?raw=true">
</div>

<div>
	<h3>Result Details</h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/result.png?raw=true">
</div>

<h1> User Panel </h1>

<div>
	<h3>Profile and quiz topics</h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/profile.png?raw=true">
</div>

<div>
	<h3>Attempt quiz</h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/attempt-quiz.png?raw=true">
</div>

<div>
	<h3>Quiz result </h3>
	<img width="700" src="https://github.com/rupomehsan/QMS/blob/main/demo/applicant-result.png?raw=true">
</div>

## Setup

#### Installation

**requirements**

1.  PHP: 7.3 | ^8.0
2.  Laravel : ^10.75

First clone this repository, install the dependencies, and setup your .env file.

**run the commands**

clone project

```
git clone https://github.com/rupomehsan/QMS.git
```

or [Click here to download .zip](https://github.com/rupomehsan/QMS/archive/refs/heads/main.zip)

swith directory to project

```
cd QMS
```

install dependencies

```
composer install
```

or

```
composer update
```

generate app key

```
php artisan key:generate
```

open .env file and change db name.
**database setup**

```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=

```

migrate database, and seed

```
php artisan migrate:fresh --seed
```

It's finally time to launch the project .

```
php artisan serve
```

the project will open at http://127.0.0.1:8000

or

```
php artisan serve --port=8001 | any supported port number
```

**database seed will generate**

-   login information for one administrator and ten users.
-   30 question tests on HTML, CSS, and Github

#### login credentials

**admin:**
email: admin@gmail.com
pass: 12345678

##### Candidates login:

| Email             | password   |
| ----------------- | ---------- |
| user_1@gmail.com  | `12345678` |
| user_2@gmail.com  | `12345678` |
| user_3@gmail.com  | `12345678` |
| user_4@gmail.com  | `12345678` |
| user_5@gmail.com  | `12345678` |
| user_6@gmail.com  | `12345678` |
| user_7@gmail.com  | `12345678` |
| user_8@gmail.com  | `12345678` |
| user_9@gmail.com  | `12345678` |
| user_10@gmail.com | `12345678` |

```

```
