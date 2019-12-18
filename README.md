# How it all works

## Backend

The app is backed by a MySQL database. We only have 2 tables, one for Users and one for Locations.
Users contains contact information and login credentials. Locations contain lat/long pairs, a timestamp
and are linked back to the Users table so that we can identify who they belong to. The Timestamp is used to
find the latest.

We used MySqlWorkbench to create the tables. SQL code for it can be found in the `sql/` folder.

Backend code is written in php and is split into 2 layers. The lower layer deals with accessing database tables
in a meaningful way. This code is found under `php/model/user.php` and `php/model/location.php`. This is the code
that actually runs SQL statements against the database and formats the results into PHP arrays.

The next layer up is responsible for performing operations with that data. This includes finding and creating locations,
registering and logging in users and things like that. That code is found under `php/user/*` and `php/location/*`. Each file
represents one operation. They use the `header` function to redirect to different UI pages as needed.

All of the configuration is in `php/config/core.php`. There is a helper for creating database connections in
`php/config/database.php`.


## Frontend

The UI pages are all contained in the root of the project and include `index.php`, `login.php`, `register.php`, `activate.php` and `dashboard.php`.

The UI uses Bootstrap and JQuery along with the `Creative` Bootstrap template we downloaded from the internet.

`index.php` is the main page.
`login.php` shows a login form, and POSTs to `php/user/login.php` which then redirects the user as appropriate. Either
on to `dashboard.php` or back to `login.php` with and error message.
`register.php` shows a registration form that lets a person sign up. After signup they are emailed a link to `php/user/activate.php` which redirects them to the correct place if the activation link works or not.

Javascript for the dashboard lives in `js/app.js`. It interacts with the Google Maps api. When `dashboard.php` is
rendered, we pull the latest location from the database and include it in the page so the map can show it.

## User activation

When a user is created, we create a random activationCode and store it in the database. This is sent to them in an email link
that they need to click. When the linked page loads, we get their email and activationCode from the link in `$_GET` and
check it against the stored values. If it's correct, we set `activatedAt` -- we make sure they have an `activatedAt`
timestamp set before we let the user log in.

The email link goes to `/php/user/activate.php`
