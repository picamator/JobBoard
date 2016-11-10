JobBoard
========

Job Board platform with straightforward workflow.
Here is the main characteristics:

* no admin page
* no registration for posting
* moderation by email for new publisher

Requirements
------------
* [PHP 7.0](http://php.net/manual/en/migration70.new-features.php)
* [Symfony 3](http://symfony.com/)
* [MySQL 5.7](https://www.mysql.com/)
* [RabbitMQ](https://www.rabbitmq.com/)
* [AngularJS 1.5](https://angularjs.org/)

Domain
------
The domain is Jobs managed by users with different roles.

It's clearly presented in [use case diagram](doc/uml/use-case.diagram.png)

### Roles
There are tow roles:

* Moderator
* Publisher

#### Moderator
Moderator can:

* Approve firstly published job
* Mark as spam published job

_Note_: firstly published job means that Publisher for the first time use JobBoard to publish their first job.

### Publisher
Publisher can:

* Publish one job

_Note_: Publisher can submit unlimited jobs.

### Managing jobs
Moderator gets email notification if any firstly published Job appears. 
During decision making Publisher can not post any jobs. After Moderator made any decision Publisher again can submit jobs.
The moderation process will start again if firstly submitted job was rejected.

Here is an [activity diagram](doc/uml/activity.diagram.png).

Architecture
------------
Application uses Layer architecture.
It contains those layers:

* Framework: Symfony 3
* Application: Mediator between layers e.g. Services, Commands
* Domain: Business logic e.g. Managers
* Core Domain: Data and operations e.g. Entities, Repositories
 
_Note_: Domain communicate with any 3-rd party libraries through Gateways.

More details inside [class diagram](doc/uml/class.diagram.png) and [layer activity diagram](doc/uml/layer.activity.diagram.png).

### Rest API
Rest API on the second level of [Leonard Richardson maturity model](http://martinfowler.com/articles/richardsonMaturityModel.html). 

All request-response supports JSON format.

#### Endpoint
The API endpoint is `http://job-board.dev:8081\api\v1` where

* `api` - indicator that it's an API area
* `v1` - api version

#### Resources
Table bellow shows available resources and methods:

Resource            | Methods
---                 | ---
job                 | GET, POST, PUT

#### GET:job
Request Parameters:

Name        | Data Type | Default value | Description
---         | ---       | ---           | ---
page        | integer   | 1             | Page number. Part of pagination.
maxPerPage  | integer   | 20            | Max number of jobs on one page. Part of pagination.

Request Body:

* Empty body

Response Body:
```json

{
    "data": [
     {
        "id": 1,
        "title": "Job Title",
        "description": "Job description",
        "email": "publisher.email.@domain.com",
        "date": "2016-11-15"
      }
    ],
    "maxPerPage": 20,
    "page": 1,
    "count": 1,
    "code": 200
}

```

Response Code:

* 200

#### POST:job
Request Parameters:

* No parameters

Request Body:
```json

 {
    "title": "Job Title",
    "description": "Job description",
    "email": "publisher.emai.@domain.com"
  }

```

Response Body:

* Empty body

Response Code:

* 204

#### PUT:job
Request Parameters:

* token: 32 length string

Request Body:
```json

{
  "id": 1,
  "status": "published"

}

```

Response Body:
```json

{
  "data": {
    "id": 1,
    "title": "Job Title",
    "description": "Job description",
    "email": "publisher.email.@domain.com",
    "date": "2016-11-15"
  },
  "code": 200
}

```

Response Code:

* 200

#### Errors
All errors message have one format that is described bellow:
```json
{
    "msg": "500 Internal server error",
    "code": 500
}
```

#### HTTP codes
Table bellow shows list of supported HTTP codes.

Code | Message                      | Description
---  | ---                          | ---             
500  | 500 Internal Server Error    | Critical application error
501  | 501 Not Implemented          | HTTP method was not implemented for that resource
404  | 404 Not Found                | Resource was not found
200  | 200 OK                       | Successful HTTP request
204  | 204 No Content               | Server successfully processed the request

### Database
Database is in [EER diagram](doc/db/job_board.png).

### UI
User Interface communicate with REST API.
Therefore all pages can be full page cached because thay do not contain any server specific information.

User interface contains with several pages:

* Job board: list og published jobs ordered by date
* Confirmation page: secret page for job approving/rejection
* Job posting: form for job posting
* Privacy: privacy page
* Licence: licence page

#### Endpoint
The API endpoint is `http://job-board.dev:8081`

Developing
----------
To configure developing environment please:

1. [Install and run Docker container](dev/docker/README.md)
2. Run inside Docker container `composer install` 

### Debug
Docker container is configured to use xDebug.

Future features candidates
--------------------------
It's a list of ideas that were appeared during development process are in [FEATURE.CANDIDATE.md](FEATURE.CANDIDATE.md). 
After review some of them will be moved to project's issues.

Contribution
------------
If you find this project worth to use please add a star. Follow changes to see all activities.
And if you see room for improvement, proposals please feel free to create an issue or send pull request.
Here is a great [guide to start contributing](https://guides.github.com/activities/contributing-to-open-source/).

Please note that this project is released with a [Contributor Code of Conduct](http://contributor-covenant.org/version/1/4/).
By participating in this project and its community you agree to abide by those terms.

License
-------
JobBoard is licensed under the MIT License. Please see the [LICENSE](LICENSE.txt) file for details.
