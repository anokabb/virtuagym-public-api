# User

|Method|URL|Info|Params|
|---|---|---|---|
|GET|/api/v0/user/current|Returns the data of the authenticated user, skips locked clubs||
|GET|/api/v0/user/`<user_id>`|Returns the data of a specific user||
|PUT|/api/v0/user|Creates a new user||
|PUT|/api/v0/user/current|Update profile for the authenticated user||
|PUT|/api/v0/user/current/notification|Adds a registration id for push notifications to the user||
|PUT|/api/v0/user/current/clubs|Adds a club to the club list of the user||
|DELETE|/api/v0/user/current/notification/<registration_id>|Deletes the given registration_id|

**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|id|int|||User id|
|username|string|no| |Username|
|username_url|string|no| |The username ready to be used to create a link to the user's profile.|
|firstname|string|yes| |The first name|
|lastname|string|yes| |The last name|
|gender|string|yes|"m","f"|Male or Female|
|user_avatar|string|yes| |Name of the user's avatar|
|cover_photo|string|no| |image location of the user cover photo|
|birthday|string|yes| |User's birthday. Format: DD-MM-YYYY|
|pro|int| |0,1|Set to 1 if user is pro|
|activated|int| |0,1|Set to 1 if user has been activated|
|language|string| |"en","cn",etc.|User's language|
|content_language|string|yes|"en","cn",etc.|A language which possibly is not fully supported on the platform yet, but which we have user generated content for|
|length|float|yes| |User's length|
|weight|float|yes| |User's weight in the unit that is given in weight_unit.|
|length_unit|string| |"cm","inch"|User's length unit|
|weight_unit|string| |"kg","lbs"|User's weight unit|
|club_ids|array|yes|[55,23]|Array of the ids of the user's clubs. The first id indicates the users primary club (only given if user has clubs)|
|timestamp_edit|int| | |Timestamp of the time the unit changed his personal settings. NOTE: When changing the API, update the code for this field in php|
|total_kcal|int| | |total amount of kcal burned by the user|
|total_min|int| | |total amount of minutes of exercise|
|total_km|int| | |total amount of km travelled|
|fitness_points|int| | |total amount of fitness points the user earned|
|country|string|yes| |the country code|
|city|string|yes| |the city the user is from|
|timezone|string|yes| |Europe/Amsterdam, America/Los_Angeles, etc|user timezone in TZ id format: http://www.twinsun.com/tz/tz-link.htm|
|coach_club_ids|array|yes|[55,23]|an array of club_ids of which this user is a coach of|
|admin_club_ids|array|yes|[55,23]|an array of club_ids of which this user is an admin of|
|employee_club_ids|array|yes|[55,23]|an array of club_ids of which this user is an employee of|
|selected_bodymetrics|array|yes| |an array of body metrics tracked by this user|
|has_coach|boolean|no|true,false|returns true if user has coach|
|nr_likes|int|no| |returns number of likes on user profile|

```json
{
   "statuscode":200,
   "statusmessage":"Everything OK",
   "timestamp":1321987950,
   "result":{
      "id":2,
      "username":"Paul",
      "name":"Paul Braam",
      "gender":"m",
      "length":193,
      "length_unit":"cm",
      "weight_unit":"kg",
      "user_avatar":"d70365fd030a2b57c6fa3f963189a6bd.jpg",
      "birthday":"03-03-1979",
      "pro":1,
      "language":"en",
      "activated":1,
      "timestamp_edit":0,
      "total_kcal":24869,
      "total_min":3175,
      "total_km":140.2,
      "fitness_points":115100,
      "country":"NL",
      "city":"Amsterdam",
      "selected_bodymetrics":[
         "weight",
         "waist",
         "fat",
         "visceral"
      ]
   }
}
```

## CREATE NEW USER

|Method|URL|Info|URL-params|
|---|---|---|---|
|PUT|/user|Create a new user||

**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|email|string|||Emailaddress of the user|
|password|string|||Password of the user|
|lang|string|yes|en,nl,...|Users language in http://en.wikipedia.org/wiki/ISO_639-1 format|
|timezone|string||Europe/Amsterdam, America/Los_Angeles, etc|user timezone in TZ id format: http://www.twinsun.com/tz/tz-link.htm|
|ipaddress|string|yes|ip address used to make the request (workaround for opaque SSL-connections)|
|origin|string|yes|should be 'android' or 'ios'|

*NOTE* to determine client-ip, the android-client uses this service: http://api.ipify.org


## UPDATE USER INFORMATION

|Method|URL|Info|URL-params|
|---|---|---|---|
|PUT|/user/current|Update user information||

**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|firstname|string|yes||The first name|
|lastname|string|yes||The last name|
|username|string|yes||The username, also affects username_url so make sure you update that from the results you get back. The username should have a minimum of 3 characters and maximum of 20|
|length_unit|string|yes|"cm","inch"|Prefered length unit, also sets miles(inch) or km(cm) for distance|
|weight_unit|string|yes|"kg","lbs"|Prefered weight unit|
|birthday|string|yes|{dd-mm-yyyy}|The user's birthday|
|gender|string|yes|"M", "F"|Gender, male or female|
|user_avatar|string|yes||The string of the image name you have created via the api/upload/image|
|content_language|string|yes||A language which possibly is not fully supported on the platform yet, but which we have user generated content for|
|timestamp_edit|int|no||timestamp of the time that the user edited the value in the app|
|selected_bodymetrics|array|yes|["weight","waist"]|The array of body metrics to track. If the user is already tracking a metric which is not in this array, this metric will be deleted.|

## SWITCHING CLUBS

Send a PUT request to `/api/v0/user/current/clubs` with JSON body

```json
{
"club_id" : "target_club_id",
"from_club_id" : "source_club_id"
}
```

## Possible error codes and messages

|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|401|Authentication Failed|Something went wrong authenticating. If you used Basic HTTP Authentication, it means that either the user and password do not match, or an invalid API key has been submitted. If you used Open Authorization it means that your Oauth Token has not been Authorized. Make sure that it is before requesting access|
|403|Access Disabled|For some reason Virtuagym has disabled access from your consumer. You'll have to contact Virtuagym to enable it again|
|406||Something went wrong while validating the data(e.g. emailaddress already in use). If you get this code, make sure to show the statusmessage field to the user(e.g. in a pop-up).|
|404|Resource not found|The API url you specified did not point to a valid resource (i.e., an invalid activity instance number|
|420|Invalid Input|One of the inputs you provided is invalid according to the specifications. The status message shows which value this is|
|421|Too many access attempts|You tried to access the server too many times. You'll have to wait a few minutes to try again|
|427|Missing Oauth Token|The Oauth Token that you have used could not be found on the server. Please register it first|
|428|Invalid access token|Access token is not valid. It has expired or the user has stopped authorisation.|
|430|Event full|(for Club-events) event attendance limit reached|
|431|Can not cancel event booking|(for Club-events) too late to cancel the booking|
|432|Not enough credits.|Can not book this event. User does not have enough credits.|
|450|Too many failed login attempts|Account has been blocked because there have been too many login attempts with a wrong password. Ask the user to logou and login via the website (so the user will be able to do a captcha)|
|500|Database Error|The server failed to connect to the database|
|503|Server unavailable|Server is down for maintainance. Retry later|