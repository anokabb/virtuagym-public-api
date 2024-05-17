# Club Member Bodymetrics
This resource allows manipulating the bodymetrics associated with a club member.


## Allowed Bodymterics
The following types of bodymetrics are currently supported:

|Description|Bodymetric Type|Typecast|Unit|
|---|---|---|---|
|Weight|`weight`|int or float|`kg`* or `lbs`|
|Height|`height`|int or float|`cm`* or `inch`|
|Body Mass Index (BMI) |`bmi`|int or float|-|
|Fat percentage - total |`fat`|int or float|-|
|Circumference - waist navel |`waist`|int or float|`cm`* or `inch`|
|Crunches - reps|`number_crunches`|int only|-|
|Lunges - reps |`number_lunges`|int only|-|
|Push-up, knees - reps|`number_pushups_knees`|int only|-|
|Push-ups - reps|`number_pushups`|int only|-|
|Heart rate - after exercise|`hr_exercise`|int or float|-|
|Heart rate - rest|`hr_rest`|int or float|-|
|Fat - visceral|`visceral`|int or float|-|
|Muscle mass - total|`musclemass`|int or float|-|
|Muscle percentage - total|`muscle_perc`|int or float|-|
|Basal metabolic rate|`metabolicrate`|int or float|-|
|Metabolic age|`metabolicage`|int or float|-|
|Bone Mass|`bonemass`|int or float|`kg`* or `lbs`|
|Bone mass percentage|`bonemass_percent`|int or float|-|
|Body water percentage|`bodywater`|int or float|-|

\* indicates the default unit assumed when unit is not explicitly passed.
      

## Supported Requests
|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/`<club_id>`/bodymetrics/|Returns bodymetrics tied to a member| member_id (**required**), type, api_key, club_secret, sync_from (timestamp in milliseconds)|
|GET|/api/v1/club/`<club_id>`/bodymetrics/`<bodymetric_id>`/|Returns bodymetric corresponding to `<bodymetric_id>` of club member|member_id (**required**), api_key, club_secret|
|PUT|/api/v1/club/`<club_id>`/bodymetrics/|Allows for updating bodymetrics of a club member|api_key, club_secret|

## GET Example

### Structure

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|id|int|no| |Bodymetric id|
|type|string|no| |Type of metric (see list above)|
|value|float or int|no| |Value of the metric (e.g. 5.2)|
|unit|string|yes| |Specifies the unit of the value depending on the user's settings|
|timestamp|int|no| |Timestamp of this bodymetric|
|deleted|int| |0, 1|Set to 1 if value is deleted, 0 otherwise.|


Send a GET request to `https://api.virtuagym.com/api/v1/club/<club_id>/bodymetrics?api_key=<api_key>&club_secret=<club_secret>&sync_from=<sync_from>&member_id=<member_id>`

The response is a result of all the bodymetric history for the specified member `member_id`. Note that `member_id` must be passed in GET requests. To retrieve a specific bodymetric type attach the `type` query parameter.

```json
{
  "statuscode": 200,
  "statusmessage": "Everything OK",
  "result_count": 4,
  "timestamp": 1469539380,
  "result": [
    {
      "id": 1647964,
      "type": "weight",
      "value": 100,
      "unit": "lbs",
      "timestamp": 1469527200,
      "deleted": 0,
      "timestamp_edit": 1469537863
    },
    {
      "id": 1647966,
      "type": "number_crunches",
      "value": 20,
      "unit": "reps",
      "timestamp": 1469527200,
      "deleted": 0,
      "timestamp_edit": 1469537627
    },
    {
      "id": 1647965,
      "type": "bmi",
      "value": 100,
      "unit": "",
      "timestamp": 1469527200,
      "deleted": 0,
      "timestamp_edit": 1469539371
    },
    {
      "id": 1647946,
      "type": "waist",
      "value": 21,
      "unit": "inch",
      "timestamp": 1468231200,
      "deleted": 0,
      "timestamp_edit": 1468238860
    }
  ]
}
```

## PUT Example
**PUT Fields**

|Field|Type|Optional|Comment|
|---|---|---|---|
|member_id|int|no|id of the member belonging to club|
|type|string|no|type of the bodymetric as tabulated above|
|value|int or float|no|the value of the bodymetric|
|timestamp|int|yes|date value of the bodymetric|

Send a PUT request to `https://api.virtuagym.com/api/v1/club/<club_id>/bodymetrics?api_key=<api_key>&club_secret=<club_secret>` with the following JSON.

```json
{
    "member_id" : <member_id>,
    "type": "weight",
    "value": 100,
    "timestamp" : 1653225968
}
```

**PUT RESPONSE**
```json
{
  "statuscode": 200,
  "statusmessage": "Everything OK",
  "result_count": 1,
  "timestamp": 1469539371,
  "result": {
    "id": 1647965
  }
}
```

Units are automatically cast to the relevant one that is associated with the member in his account settings.

## Possible error codes and messages

|Statuscode|Message|
|---|---|
|400|member_id must be passed in GET request|
|404|Member with member_id `<member_id>` not found in club|
|400|the passed bodymetric type is not supported, refer documentation for valid types|
|400|member does not have an activated user profile|
|400|type, value and member_id must be passed in PUT request|
|400|the passed value must be numeric|
|400|bodymetric type `<type>` allows only int values|