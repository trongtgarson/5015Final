# API

`{BASE_URL}` is wherever the site where the code lives. Something like `https://cis-linux2.temple.edu/YOUR_ID/5015/Final/`

All of the POST calls are using `$_POST` to retrieve the parameters. This means they have to be
submitted as a form encoded request. If we want to just use a JSON body instead that can be changed.

We probably need to build on these requests to return the UI when that is ready rather than just
a list of data.

## Users

### `GET {BASE_URL}/php/user/list.php`

Returns a list of all users. This isn't really useful.

### `POST {BASE_URL}/php/user/create.php`

This assumes it's being POSTed by a form. Expectes 2 form inputs with names `username` and `password`.
This will create a user object that we can link locations against. This will go away or change a lot
when OAuth is implemented. For now it's the minimum needed to make other stuff work.

### `POST {BASE_URL}/php/user/login.php`
Also requires a form POST with `username` and `password`. If it finds a user and the password
is correct then a new Session is started.


### `POST {BASE_URL}/php/user/logout.php`
Destroys an active session if one exists.


## Location

### `GET {BASE_URL}/php/location/list.php`

Returns a list of all locations. This isn't really useful.

### `GET {BASE_URL}/php/location/mine.php`

Returns a list of all previous locations for the logged in user. This isn't really useful.

### `GET {BASE_URL}/php/location/latest.php`

Returns the most recent location stored for the logged in user.

### `POST {BASE_URL}/php/location/create.php`

Fails if there is no Session (e.g. not logged in)

Expects a form POST with 2 field `latitude` and `longitude`. Each of these will store up to 6 
decimal places of precision. 

Stores a new location against the logged in user for the given location and time of submission.
