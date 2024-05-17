# Authorization

## Basic auth

When no auth_type is given, HTTP basic auth will be assumed.
Send the authorization info of your Virtuagym user through the HTTP `Authorization` header.

See also: http://www.ietf.org/rfc/rfc2617.txt

## Facebook login

Logs the user in using a facebook access token. To do this send fill the `auth_type` parameter with the value '`facebook`' and send the access token in the parameter `fb_access_token`.
When there is no user with that access token yet we create a new user. Otherwise we log the user in.

## Oauth 2.0

Oauth is used for third party apps to communicate with virtuagym. The following steps are needed for being able to communicate using oauth 2.0:

### 1. Create an OAuth Client configuration 

Create a client at  (You need to be logged in with your virtuagym account to access this page)

 https://virtuagym.com/oauth/clients

### 2. Send the user to the login page

To allow the user to authorize your app, send your user to the following url with the client id you just created:
 
<pre>
 https://www.virtuagym.com/oauth/authorize?client_id=your_client_id&response_type=code&state=<your_state> 
</pre>

Use a unique (session) id as state. You can later verify this unique session token on your server to guard against XSS attacks

If the user allows access, you will be redirected to the redirect page you specified in the OAuth Client configuration.
An authorization code will be passed in the query parameter `code`. This authorization code is valid for 30 seconds.

### 3. Exchange the authorization code for an access token.
 
To access the API you need an access token. You exchange the authorization code for an access token by sending a request to

<pre>
 https://virtuagym.com/oauth/token
</pre>

Send your client id, client secret, grant type and code as a body request by using x-www-form-urlencoded or form-data: 
`  grant_type:authorization_code`

  `client_id:{client_id}`

  `client_secret:{client_secret}`

  `code:{code} `


The response will contain an **`access_token`**, a **`refresh_token`**, an **`expires_in`** expiration time, and the **`state` ** variable as query parameters.
Save these, and check if the `state` matches the value you sent earlier.
You'll need the `access_token` to access the VirtuaGym API, and the `refresh_token` to request a new `access_token` (and `refresh_token`) when it expires.
Your access token will expire after 60 days and the refresh token will expire after 100 days.

### 4. Refreshing an `access_token`

When the access token expires, you can get a new one from the following URL:

<pre>
 https://virtuagym.com/oauth/token
</pre>

Send your client id, client secret, grant type and code as a body request by using x-www-form-urlencoded or form-data: 
`  grant_type:refresh_token`

  `client_id:{client_id}`

  `client_secret:{client_secret}`

  `refresh_token:{refresh_token} `

Use the `refresh_token` you saved earlier.

### 5. Calling the Virtuagym API

To access the Virtuagym API, pass the `access_token` in an `Authorization` HTTP header:

<pre>
 Authorization: Bearer <your_access_token>
</pre>

Alternatively (_*not recommended*_), you pass the `access_token` as a query parameter:

<pre>
 https://api.virtuagym.com/api/user/current?access_token=<your_access_token>&api_key=<your_api_key>
</pre>
Request the api key: https://github.com/virtuagym/Virtuagym-Public-API#api-key 
# Get data from other user

You can supply the query-parameter "`act_as_user`" to supply a `user_id` of a user you would like to get the information from. This can be used for coaches to view client data. The system checks if the logged in user is allowed to view this data of the given `user_id`.