Public API's require HTTPS and would not work over insecure connections.

## Public API v0 Documentation (deprecated)

All v0 API's work with Basic Auth by providing a ``username`` and ``password`` (http://www.ietf.org/rfc/rfc2617.txt) and provide only information pertaining to the logged in user.

|Resource|Description|
|---|---|
|[[User]]|User data|
|[[Member (Deprecated - Use V1)]]|Member data|
|[[Achievement Definition]]|Achievement definition data|
|[[User Achievements]]|The achievement id's of the achievements the user has earned|
|[[Activity]]|Activity instance data|
|[[Activity Definition]]|Activity definitions|
|[[Bodymetric]]|Bodymetric data|
|[[Bodymetric Definition]]|Bodymetric definitions|
|[[Club]]|Club|
|[[Club Activity Definitions]]|All club specific activities|
|[[Content Banners]]|Custom Content Banners to mobile apps|
|[[Food Instances]]|Food instance data|
|[[Food Plan]]|Food plans|
|[[Food Diets]]|Food diets|
|[[Group-(deprecated)]]|Groups from the community|
|[[Plan Definition]]|Plan definition data|
|[[Share]]|Social network sharing|
|[[Upload]]|Uploading images|

## Public API v1 Documentation

All v1 API's are available for clubs to use and require the following query parameters for authorization:

- ``club_secret`` labeled "Club Key" in the web UI.
- ``api_key`` labeled "API Key" in the web UI

Your credentials can be found in system settings->Business Info->Advanced. Besides that you will also need your ``club_id`` to make the calls to the right environment, this is the first digit combination in the Club Key


|Resource|Description|
|---|---|
|[[Club Member Credits]]|The credits of a member|
|[[Membership Definition]]|Membership definition data|
|[[Membership Instances]]|Membership instance data|
|[[Club Members]]|Members of the club|
|[[Club Employees]]|Employees of the club|
|[[Club Events]]|Events of the Club|
|[[Club Event Participants]]|Bookings of Events of Club|
|[[Club Member Notes]]|Notes of Club Members|
|[[Club Member Bodymetrics]]|Bodymetrics of Club Members|
|[[Club Member Workouts]]|Workouts of Club Members|
|[[Club Invoices]]|Invoices of the Club|
|[[Club Visits]]|Visits of the Club|

## Public API v3 Documentation

This API requires a client ID and Client Secret for authorization. These can then be exchanged for an access token to get access to the API. To get your set of credentials, please reach out to api@virtuagym.com and provide us your clubID for reference. 

|Resource|Description|
|---|---|
|[[Lead API]]|Leads of the club|