# Plan Definition

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/plan/definition|Returns an array of plan definitions, only ones that are not custom, unless club_id has been given, skips plans from locked clubs|sync_from, preload_mobile, club_id, fill_days |
|GET|/api/v0/plan/definition/mine|Returns an array of plan definitions of plans that the user has created|sync_from, fill_days |
|GET|/api/v0/plan/definition/used|Returns an array of plan definitions of plans that the user used|sync_from, fill_days|
|PUT|/api/v0/plan/definition|Creates a (user) plan|
|DELETE|/api/v0/plan/definition/`<plandefid>`|Deletes a (user) plan|

**GET STRUCTURE**

|Field|Type|Optional|In put request|Values|Information|
|---|---|---|---|---|---|
|id|int||||Plan id|
|name|string| |yes| |Name of the plan in the user's language|
|thumb|string|yes|yes| |Thumbnail of the plan|
|goal|int||yes| |Id of the goal (1=shape, 2=power, 3=vitality, 4=performance, 5=rehab)|
|difficulty|int| | |0-4|Indication of difficulty of the plan ( 0=Novice,1=Beginner,2=Intermediate,3=Advanced,4=Expert)|
|description|string| |yes||Description of the plan in the user's language|
|repeat_nr|int| | | |Standard amount of times the plan is repeated when instantiating this plan|
|pro|int| | |0,1|Set to 1 if plan is for pro-users only|
|days_per_week|int| | | |Advised number of days per week for instantiation|
|equipment|string|yes| | |String of the equipment in the user's languages. values are comma seperated in the string|
|equipment_keys|string array|yes| | |Array of equipment used in the plan (technical names, like dumbbells or gym_equipment)|
|order|int|yes| | |The order at which the plan should be shown.|
|duration|int|yes| | |Duration of the plan in seconds. Given if set.|
|act_days|array| |yes| |array of int with activity instance id's per plan day (first array is day 1, second day 2, etc). If fill_days is 1, the array is of activity instance objects|
|club_id|int| |yes| |This plan has been created inside this club_id|
|is_custom|int| | |0,1|1 when this plan is a custom plan|
|is_public|int| | |0,1|1 when this plan is public|
|timestamp_edit|int| | | |timestamp of the moment at which the plan last has been changed. This is used for syncing.|
|deleted|int| | |0,1|1 when this plan has been deleted|
|reg_only|int| | |0,1|1 when the user has to be registered to use the plan|
|privacy_setting|int| | |0, 3, 6, 9|visible for: 0 = yourself only, 3 = club employees only, 6 = everyone of club, 9 everyone|


**PUT STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|name|string|no| |Name of the plan in the user's language|
|goal|int|no| |Id of the goal (1=shape, 2=power, 3=vitality, 4=performance, 5=rehab)|
|days_per_week|int|yes|0-7|Advised number of days per week for instantiation|
|difficulty|int|yes|0-4|Indication of difficulty of the plan
|act_days|int[] array|no| |array of int-arrays with activity instance id's per plan day (first array is day 1, second day 2, etc)|
|privacy_setting|int|yes|0, 3, 6, 9|Workout visibility<br />`0 = yourself only (DEFAULT), 3 = club employees only, 6 = everyone of club`.|
|club_id|int|yes| |Club the workout belongs to.<br />**NOTE** required when creating a workout with `privacy_setting > 0`|

List of equipment you can expect to get:
```
'aerobic_step','barbell','crosstrainer','dumbbells','elastics','gym_equipment','hometrainer','rowing_machine','spinning_bike','stepping_machine','treadmill'
```

GET Result example:
```json
{"statuscode":200,
 "statusmessage":"Everything OK",
 "timestamp":1321986666,
 "result":[
    {"id":37,
     "name":"Power - Intermediate (Gym) III",
     "thumb":null,
     "goal":2,
     "difficulty":2,
     "description":"",
     "repeat_nr":4,
     "pro":1,
     "days_per_week":3,
     "equipment": "Crosstrainer, Dumbbells, Gym equipment, Rowing machine, Treadmill",
     "equipment_keys":[
         "crosstrainer",
         "dumbbells",
         "gym_equipment",
         "rowing_machine"
     ],
     "act_days":[[13436,13435,13434,13433,13432,13431,13430,13429,13428,13427,13426,13425,13424,13423],[13450,13449,13448,13447,13446,13445,13444,13443,13442,13441,13440,13439,13438,13437],[13464,13463,13462,13461,13460,13459,13458,13457,13456,13455,13454,13453,13452,13451]]
    }]
}
```

Put body example:
```json
{
    "name": "pietje",
    "goal": 2, 
    "act_days": [
        [
            {
                "act_id": 492, 
                "reps": [
                    20
                ], 
                "rest_after_exercise": 45, 
                "rest_period": 30, 
                "timestamp_edit": 1396961086
            }, 
            {
                "act_id": 26, 
                "duration": 1800, 
                "rest_after_exercise": 45, 
                "rest_period": 30, 
                "timestamp_edit": 1396961089
            }, 
            {
                "act_id": 1414, 
                "duration": 1800, 
                "rest_after_exercise": 45, 
                "rest_period": 30, 
                "timestamp_edit": 1396961092
            }, 
            {
                "act_id": 143, 
                "duration": 1800, 
                "rest_after_exercise": 45, 
                "rest_period": 30, 
                "timestamp_edit": 1396961095
            }
        ]
    ] 
}
```

Put result example:
```json
{
    "result": {
        "act_ids": [
            [
                51792541, 
                51792542, 
                51792543, 
                51792544
            ]
        ], 
        "message": "Plan created successfully", 
        "plan_id": 21525
    }, 
    "result_count": 3, 
    "statuscode": 200, 
    "statusmessage": "Everything OK", 
    "timestamp": 1396961118
}
```

## Possible error codes and messages

|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|404|Resource not found|The API url you specified did not point to a valid resource (i.e., an invalid activity instance number|
|420|Invalid Input|One of the inputs you provided is invalid according to the specifications. The status message shows which value this is|