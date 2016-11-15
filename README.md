JobBoard
========

[![PHP 7 ready](http://php7ready.timesplinter.ch/picamator/JobBoard/dev/badge.svg)](https://travis-ci.org/picamator/JobBoard)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/8b533637-392d-4be8-8204-77ff22f460ca/mini.png)](https://insight.sensiolabs.com/projects/8b533637-392d-4be8-8204-77ff22f460ca)

Master
------
[![Build Status](https://travis-ci.org/picamator/JobBoard.svg?branch=master)](https://travis-ci.org/picamator/JobBoard)
[![Coverage Status](https://coveralls.io/repos/github/picamator/JobBoard/badge.svg?branch=master)](https://coveralls.io/github/picamator/JobBoard?branch=master)

Dev
---
[![Build Status](https://travis-ci.org/picamator/JobBoard.svg?branch=dev)](https://travis-ci.org/picamator/JobBoard)
[![Coverage Status](https://coveralls.io/repos/github/picamator/JobBoard/badge.svg?branch=dev)](https://coveralls.io/github/picamator/JobBoard?branch=dev)

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
* [Memcached 1.4](https://memcached.org/)
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
job                 | GET, POST, PUT, DELETE

#### GET:job
Request Parameters:

Name        | Data Type | Default value | Max value | Description
---         | ---       | ---           | ---       |---
startAt     | integer   | 1             | -         | Page number. Part of pagination.
maxPerPage  | integer   | 20            | 100       | Max number of jobs on one page. Part of pagination.

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
        "publishedDate": "2016-11-15"
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

There is limitation over posing data.

Name        | Limit
---         | ---
Title       | 4-255 characters
Description | 64-655360 characters, the max value is equal 5Mb text

Response Body:

* Empty body

Response Code:

* 204

#### PUT:job
Request Parameters:

* id: job identifier
* token: 32 characters string

Request Body:
```json

{
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
    "email": "publisher.email@domain.com",
    "publishedDate": "2016-11-15"
  },
  "code": 200
}

```

Response Code:

* 200

#### DELETE:job
Request Parameters:

* id: job identifier
* token: 32 characters string

Request Body:

* Empty body

Response Body:

* Empty body

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
400  | Validation error message     | Validation error
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

### Command bus
Command bus is a query mechanism to asynchronously run operations such as:

* sending emails
* logging
 
Table bellow describes those commands:

Channel                             | Message                                       
---                                 | ---                                           
publisher_email_awaiting_moderation | Identifier from table job_pool       
moderator_email_awaiting_moderation | Identifier from table job_pool       
application_error                   | Text message or small json serialized  string

### Events
Events are extension points for Managers in other words it's possible to execute code `before` and `after` each Managers method.
For each `before` event original requested parameters are passed. For all `after` the execution result;

### Publisher statuses
Publisher can be in on of those statuses:

* Inactive - Job was moderated but rejected, Publisher can post job for further moderation
* Active - Publisher can post job without moderation
* Awaiting Moderation - Publisher is under moderation, any attempt to publish job will be rejected

Table bellow show map how Publisher's statuses changes:

                    | Inactive  | Active    | Awaiting Moderation 
---                 | ---       | ---       | ---
Inactive            | +         | +         | +   
Active              | -         | +         | -
Awaiting Moderation | +         | +         | +  

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
