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

1.API endpoint for taking single/multiple match result/s along with one/more league group/s

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
## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
