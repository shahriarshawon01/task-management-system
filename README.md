# Task Management System

A simple task management application built using Laravel that allows users to create, view, edit, and delete tasks. The application also supports task filtering, sorting, and provides an API for integration with other applications.

Features
- User Authentication: Registration, login, and logout functionality.
- Task Management:
- Create, read, update, and delete tasks.
- Filter tasks by status (Pending, In Progress, Completed).
- Sort tasks by due date.

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation)

Clone the repository

    git clone https://github.com/shahriarshawon01/task-management-system.git

Switch to the repo folder

    cd task-management-system

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Install all the dependencies using npm

    npm install

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve
    npm run dev

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/shahriarshawon01/task-management-system.git
    cd task-management-system
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate 
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with ready content.**

Open the DatabaseSeeder and set the property values as per your requirement

    database/seeds/DatabaseSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

## Login Credential
    Email : admin@gmail.com
    Password : 12345678

