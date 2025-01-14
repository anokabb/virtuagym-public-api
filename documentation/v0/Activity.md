# Activity Instance

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/activity|Returns array of activity (instances) for the authenticated user|sync_from (timestamp), max_results(maximum results for 1 call), page(use this to get the next page of results), distance_unit_type ('mls' or 'km'), weight_unit_type ('lbs' or 'kg')|
|GET|/api/v0/activity/`<instance_id>`|Returns a specific activity instance. Can only be used for personal activity instances. For plan instances, see the plan api.|distance_unit_type ('mls' or 'km'), weight_unit_type ('lbs' or 'kg')|
|GET|/api/v0/activity/`<yyyy>`/`<mm>`/`<dd>`|Returns activity instances of a specific date|distance_unit_type ('mls' or 'km'), weight_unit_type ('lbs' or 'kg')|
|PUT|/api/v0/activity|Create an activity instance|distance_unit_type ('mls' or 'km'), weight_unit_type ('lbs' or 'kg')|
|PUT|/api/v0/activity/`<instance_id>`|Update an activity instance. Check achievements and send email/push notification if accomplished|distance_unit_type ('mls' or 'km'), weight_unit_type ('lbs' or 'kg')|
|DELETE|/api/v0/activity/`<instance_id>`|Deletes an activity instance||

**STRUCTURE**

|Field|Type|Optional|In put request|Values|Information|
|---|---|---|---|---|---|
|act_inst_id|int| |no| |Activity instance id, do not set on creating a new|
|act_id|int| |yes| |Reference to the activity definition|
|plan_id|int|yes|no| |Reference to the plan id if item belongs to a plan|
|plan_instance_id|int|yes|no| |Reference to the plan instance id if item belongs to a plan instance|
|timestamp|timestamp|yes|no| |Timestamp of when this activity is performed or planned by the user.|
|order|int| |yes| |Integer to order the activities in a day (lowest value first) (1 should be the lowest value)|
|done|int| |yes|0,1|If activity is done this value is set to 1|
|deleted|int| |no|0,1|If activity is deleted this value is set to 1|
|kcal|int| |yes| |Number of calories burned with this activity in kcals|
|note|string|yes|no| |Note from the trainingplan|
|personal_note|string|yes|yes| |Personal note, added in the activity calendar|
|time_based|boolean|yes|yes||If true, the repetitions of this activity instance are time based, so the time_reps should be used.|
|reps|int array|yes|yes|1-127|Repetitions per set (max 5 sets, strength activities only) e.g. [12,10,8]|
|time_reps|int array|yes|yes||Amount of seconds per set|
|weights|float array|yes|yes|0-999|Weight per set (max 5 sets, strength activities only) Example:[120.5,100.5,100.5]|
|distance|float|yes|yes| |Distance in the user's unit: km or mls (cardio activities only)|
|speed|float|yes|yes| |Speed in the user's unit: miles/hour or km/hour (cardio activities only)|
|duration|int|yes|yes| |Duration of the activity in seconds||
|rest_period (depricated)|int|yes|yes| |Duration of rest period between sets in seconds (strenght activities only)|
|rest_after_exercise (depricated)|int|yes|yes| |Duration of rest after the exercise (in seconds)|
|rest_sets|int array|yes|yes||Amount of seconds of rest between the sets|
|steps|int|yes|yes| |Amount of steps taken in this activity|
|timestamp_edit|timestamp|yes|no| |Timestamp of last edit|
|external_activity_id|string|yes|yes| |id of external activity from apple or google|
|external_origin|string|yes|yes| |origin of external activity from apple or google|


**EXAMPLE GET REPLY**

```json
{"statuscode":200,
 "statusmessage":"Everything OK",
 "timestamp":1321987033,
 "result":[
    {"act_inst_id":25957,
     "act_id":177,
     "order":0,
     "done":1,
     "kcal":39,
     "deleted":1,
     "timestamp_edit":1319816131,
     "timestamp":1319796000,
     "reps":[]
    },
    {"act_inst_id":25958,
     "act_id":182,
     "order":0,
     "done":1,
     "kcal":21,
     "deleted":1,
     "timestamp_edit":1319816131,
     "timestamp":1319796000,
     "reps":[],
     "rest_period":"30"
    }]
}
```

**REPLY ON CREATE (PUT)**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|act_inst_id|int| | |Reference to the activity instance just created|
|client_id|guid|yes| |36 chars GUID generated by the client on a put of a new instance, which is supplied in the reply as a reference (because no act_inst_id exists)(1)|

(1) also used to prevent double creations (in case you do a PUT-request, but the reply gets lost and you retry the put.

```json
{
 "statuscode":200,
 "statusmessage":"Everything OK",
 "timestamp":1321987658,
 "result":
    {"act_inst_id":26382
    }
}
```


## Possible error codes and messages

|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|420|Invalid Input|One of the inputs you provided is invalid according to the specifications. The status message shows which value this is|

