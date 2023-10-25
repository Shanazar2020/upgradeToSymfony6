# Symfony 6 Project with Docker

This is an upgraded project from Symfony 5 to Symfony 6 running on Docker. It includes the latest PHP 8.0 version and
new features like email verification after registration.
The original Symfony 5 project can be reached from my other
repository: [Cauldron Overflow](https://github.com/Shanazar2020/cauldron_overflow)

## What's new

The project is updated to use PHP 8.0, Symfony 6 and Email Verification service is added while registration.
To update syntax these PHP Tools are used:

- [Rector - Instant Upgrades and Automated Refactoring](https://github.com/rectorphp/rector#rector---instant-upgrades-and-automated-refactoring)
- [PHP-CS-Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)

## Getting Started

To run this project, follow the steps below:

### Prerequisites

- [Docker](https://www.docker.com/get-started) must be installed on your system.

### Clone the Repository

Clone this repository to your local machine:

`git clone https://github.com/Shanazar2020/upgradeToSymfony6.git`

### Build and Run Docker Compose Services

Navigate to 'laradock' folder inside the project directory and use Docker Compose to build and run the services:

`cd your-symfony-project/laradock
docker-compose up --build -d`

This will start the necessary Docker containers including php, composer and symfony cli.

After services are started go into you app directory inside docker workspace:

`docker-compose exec workspace bash`

### Start the Symfony Server

You can use the Symfony CLI tool to start the development server. After navigating to the project directory inside
docker workspace and run:

`symfony server:start`

You will see the URL where your Symfony application is running, typically at `http://127.0.0.1:8000`.


Email Verification
------------------

1. Registration: Register a new user on your website. During the registration process, the user should receive a
   verification email.

2. View Email in Mailer Service: You can view the verification email by accessing the Mailer service's web interface.
   Open a web browser and go to `http://127.0.0.1:1080` to view the received emails.

3. Verification: In the received email, there should be a link to verify the email address. Click the link to complete
   the email verification process.

Screenshots
-----------

![Verification Email Sent](https://github.com/Shanazar2020/upgradeToSymfony6/assets/69158788/1563fb23-51d1-4601-9328-cc3569c34935)
Verification Email Sent

![Verification Email in Mailer](https://github.com/Shanazar2020/upgradeToSymfony6/assets/69158788/baa06cd9-fbf6-4710-b092-0e0ad018d5e5)
Verification Email in Mailer Service

![Email Verified](https://github.com/Shanazar2020/upgradeToSymfony6/assets/69158788/e0735e62-f30a-464d-b5f9-962e09fb4b40)
Email Verified


General Functionality
---------------------

The general functionality of the website is to post question and answers. Alongside the project includes user
registration and authentications, admin pages and user verification process like email verification and 2-factor
authentication.

![Question Page](https://github.com/Shanazar2020/upgradeToSymfony6/assets/69158788/255cc387-4fca-4a09-b74b-25de601f2283)


Contributors
------------
This project is developed by following tutorials
from [Upgrading to Symfony 6.0](https://symfonycasts.com/screencast/symfony6-upgrade/upgrade-symfony6).
Special thanks to a great tutor [Ryan Weaver](https://github.com/weaverryan).

And it is me:

- [Shanazar](https://github.com/Shanazar2020)

License
-------

This project is open-source and available under the [MIT License](https://www.mit.edu/~amini/LICENSE.md).
