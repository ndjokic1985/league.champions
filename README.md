# League Champions API

Simple API for managing league match/es and retrieving league table results.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on your environment.

### Prerequisites

Programs you will need to install in order to host and test project:

```
apache
PHP >= 7
mysql-server 5.6
composer
postman
git

```

### Installing

A step by step series of examples that tell you how to get a development env running

1.Clone this public  git repository on your local

```
git clone https://github.com/ndjokic1985/league.champions.git
```

2.Navigate to the root of project and run composer update

```
composer update
```


3.Create empty database with mysql-workbench or phpmyadmin program

```
example --dbname = 'league.champions'
```

3.From root of your project copy .env.example. into .env  and update you DB settings

```
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
4.In terminal from root of your project run migration command 

```
php artisan migrate
```


## How to use API
### You can test api with Postman software
* [Postman software download](https://www.getpostman.com/downloads/)

1.API endpoint for taking single/multiple league match result/s along with one/more league group/s:

```
Method name: POST 
URL: {server_name}/api/footballMatch
form-data
Body:
 1.Upload json file with postman,key name should be 'file' (See Screenshot 1)
 2.Enter key value pairs using postman.Key names should be equivalent to the db column name (See Screenshot 2 )
```
* [Screenshot 1](https://i.imgur.com/FvOFyOs.png) - POST method using file
* [Screenshot 2](https://i.imgur.com/nMjudB7.png) - POST method using text

2.API endpoint for retrieving all league table display:

```
Method name: GET 
URL: {server_name}/api/leagueTable (See Screenshot 3)
```
* [Screenshot 3](https://i.imgur.com/22MmPRO.png) - GET method

3.API endpoint for retrieving league table based on group name:

```
Method name: GET 
URL: {server_name}/api/leagueTable/{groupname} (See Screenshot 4)
```
* [Screenshot 4](https://i.imgur.com/V37Fpge.png) - GET method

4.API endpoint for retrieving all league matches results,filtering
league matches by date range, group and team:

```
Method name: GET 
URL: {server_name}/api/footballMatches (See Screenshot 5)
URL: {server_name}/api/footballMatches?group=B&team=Lazio&from=20.09.2017&to=20.10.2017
You have next query string parameters available:
- group
- team
- from
- to
On Screenshot 6 you can see how url looks like.

```
* [Screenshot 5](https://i.imgur.com/IaAQ1yE.png) - GET method (all matches results)
* [Screenshot 6](https://i.imgur.com/GhCEgTo.png) - GET method (all filtered matches results)

5.API endpoint for taking single/multiple league match result/s along with one/more league group/s:

```
Method name: PUT 
URL: {server_name}/api/footballMatch
Content-type: application/x-www-form-urlencoded (See Screenshot 7)
Content-type: application/json (See screenshot 8)
```
* [Screenshot 7](https://i.imgur.com/XJGlgHO.png)
* [Screenshot 8](https://i.imgur.com/GKX4fEF.png)



## Built With

* LAMP - Linux, Apache, PHP, MYSql, PhpStorm

## Authors

**Nikola Đokić** - **Project on github** -  [LeagueChampions](https://github.com/ndjokic1985/league.champions)
