# Virtuagym Public API
Here you can find some code examples and our [API documentation](https://github.com/virtuagym/api-documentation/wiki). 

## Authentication
A valid API key is required for all API requests.

Certain v0 API endpoints and all v1 API endpoints require a ``club_secret``. 

API key and Club secret are available in the portal by going to system settings > business info > advanced. If you experience any issues, please reach out by sending an email to `api@virtuagym.com`.

Additionally, all v0 API's work with Basic Auth by providing a ``username`` and ``password`` (http://www.ietf.org/rfc/rfc2617.txt) and provide only information pertaining to the logged in user.

## Limitations
Requests are limited to 500 requests per hour.

Public API's require HTTPS and would not work over insecure connections.

# Documentation Index
## General

[Authorization]()

[Status and Error Codes]()

## API v0 (no longer supported)

All v0 API's work with Basic Auth by providing a ``username`` and ``password`` (http://www.ietf.org/rfc/rfc2617.txt) and provide only information pertaining to the logged in user.

|Resource|Description|
|---|---|
|[User](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/User.md)|User data|
|[Achievement Definition](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Achievement-Definition.md)]|Achievement definition data|
|[User Achievements](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/User-Achievements.md)|The achievement id's of the achievements the user has earned|
|[Activity](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Activity.md)|Activity instance data|
|[Activity Definition](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Activity-Definition.md)|Activity definitions|
|[Bodymetric](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Bodymetric.md)|Bodymetric data|
|[Bodymetric Definition](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Bodymetric-Definition.md)|Bodymetric definitions|
|[Club](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Club.md)|Club|
|[Club Activity Definitions](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Club-Activity-Definition.md)|All club specific activities|
|[Content Banners](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Content-Banners.md)|Custom Content Banners to mobile apps|
|[Food Instances](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Food-Instances.md)|Food instance data|
|[Food Plan](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Food-Plan.md)|Food plans|
|[Food Diets](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Food-Diets.md)|Food diets|
|[Group](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Group.md)|Groups from the community|
|[Plan Definition](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Plan-Definition.md)|Plan definition data|
|[Share](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Share.md)|Social network sharing|
|[Upload](https://github.com/virtuagym/api-documentation/blob/master/documentation/v0/Upload.md)|Uploading images|

## API v1

All v1 API's require both ``club_secret`` and ``api_key`` as query parameters for authorization.

Please note, in API endpoints we pass the "Club Key" as "club_secret".

|Resource|Description|
|---|---|
|[Club Members](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Members.md)|Members of the club|
|[Club Employees](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Employees.md)|Employees of the club|
|[Membership Definition](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Membership-Definition.md)|Membership definition data|
|[Membership Instances](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Membership-Instances.md)|Membership instance data|
|[Club Member Credits](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Member-Credits.md)|The credits of a member|
|[Club Invoices](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Invoices.md)|Invoices of Club Members|
|[Club Visits](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Visits.md)|Checkins of Club Members|
|[Club Events](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Events.md)|Events of the Club|
|[Club Event Participants](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Event-Participants.md)|Bookings of Events of Club|
|[Club Member Notes](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Member-Notes.md)|Notes of Club Members|
|[Club Member Bodymetrics](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Member-Bodymetrics.md)|Bodymetrics of Club Members|
|[Club Member Workouts](https://github.com/virtuagym/api-documentation/blob/master/documentation/v1/Club-Member-Workouts.md)|Workouts of Club Members|

# Contact
If you have any additional questions about our API, please contact support@virtuagym.com or api@virtuagym.com 

If you found bugs/typos or have improvements/feedback please create an issue [here](https://github.com/virtuagym/api-documentation/issues)

# License
Examples are licensed under the [MIT License](http://opensource.org/licenses/MIT).
