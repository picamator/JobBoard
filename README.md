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
* Application: Mediator between layers
* Domain: Business logic
 
_Note_: Domain communicate with any 3-rd party libraries through Gateways.

### Rest API
in-progress

### Database
Database is in [EER diagram](doc/db/job_board.png).

### UI
in-progress

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
