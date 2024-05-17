# Assign Workout

------

*Please note https is required for ALL API requests.*

------

**Please note, in API endpoints we pass the "Club Key" as "club_secret"**

*(Club Key can be found in business settings->Business Info->Advanced)*

------

## Note
You can assign the following workouts
* All Standard workouts (pro and non pro)
* All Club workouts (pro and non pro)
* User private workout (assigning a user workout to that same user)
* Coach workouts to all members if the coach can coach all option is enabled
* Coach workouts to coach clients if the coach can coach all option is disables
------


## METHODS

|Method|URL|Info|URL-params|
|---|---|---|---|
|POST|/api/v1/club/<club_id>/member/workouts/|Adds a workout to a member's activity calendar(See *STRUCTURE*)|api_key, club_secret|

## STRUCTURE

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|plan_id|int|no| |The workout Id of a valid Standard workout or club workout.|
|user_id|int|no| |The user id of an active member of the club you are assign the workout to.|
|weeks|int|no| |Number of weeks.|
|weekdays|array|no|[1,2,3,4,5,6,7]|A comma separated list of weekdays starting from Monday -1 to Sunday - 7|
|start_date|string|no|YYYY-MM-DD|The start date of the workout.|

### Assigning a workout to a club member
A POST request to ``https://api.virtuagym.com/api/v1/club/<club_id>/member/workouts?api_key=<api_key>&club_secret=<club_secret>`` with the following body

```json
{
  "plan_id": 12345,
  "user_id": 12345,
  "weekdays": [1,3,5],
  "weeks": 1,
  "start_date": "2020-06-27"
}
```
would return the following response if the workout is successfully assigned
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 0,
    "timestamp": 1478252652810
  }
}
```

Or an error response is the workout assignment failed
```json
{
    "statuscode": 420,
    "statusmessage": "You cannot assign this workout.",
    "result_count": 0,
    "timestamp": 1583138104
}
```

## Status codes and messages

|Status code|Message|Description|
|---|---|---|
|200|Everything OK||
|420|User is not an active member of this club.|The user is either not a member of this club or is a member but is inactive|
|420|Invalid workout object.|There was an error with the workout validation|
|420|Workout does not exists.|
|420|Workout does not belong to this club.|
|420|You cannot assign a private workout to this user.|You cannot assign a club member private workout to a different club member|
|420|plan_id is required and must be an integer.|The plan_id is either not provided in the request or is not a valid integer|
|420|user id is required must be an integer.|
|420|weeks is required and must be a positive integer.|
|420|weekdays is required and must be an array.|
|420|weekdays must be between 1-7.|
|420|start_date must be in the format YYYY-MM-DD.|

