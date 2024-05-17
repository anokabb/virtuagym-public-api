# Bodymetric

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/bodymetric|Returns an array of bodymetrics of the authenticated user|sync_from|
|PUT|/api/v0/bodymetric|Add a new bodymetric for the authenticated user| |
|GET|/api/v0/bodymetric/weight|Returns an array of bodymetrics of the authenticated user of the type "weight"|sync_from|
|GET|/api/v0/bodymetric/`<id>`|Returns a specific bodymetric| |
|DELETE|/api/v0/bodymetric/`<id>`|Delete a specific bodymetric| |

**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|id|int|||Bodymetric id|
|type|string| | |Type of metric (see list below)|
|value|number| | |Value of the metric (e.g. 5.2)|
|unit|string|optional| |Specifies the unit of the value. Optional for PUT-requests. If no unit given and multiple units possible, we use the metric of imperial unit(e.g. kg or lbs) depending on the users site settings|
|timestamp|int| | |Timestamp of this bodymetric|
|deleted|int| |0,1|Set to 1 if value is deleted, 0 otherwise (for GET-requests only!)|


```json
{"statuscode":200,
 "statusmessage":"Everything OK",
 "timestamp":1321990975,
 "result":[
    {"id":3382,
     "type":"bmi",
     "value":14.9,
     "unit":"",
     "timestamp":1321484400,
     "deleted":0,
     "timestamp_edit":1321525204},
    {"id":3384,
     "type":"weight",
     "value":55.5,
     "unit":"kg",
     "timestamp":1321484400,
     "deleted":0,
     "timestamp_edit":1321525204
    }]
}
```
**PUT Request**

|Method|URL|Info|URL-params|
|---|---|---|---|
|PUT|/bodymetric|Add a new bodymetric for the authenticated user||

**Request structure**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|timestamp|int| | |Timestamp of this bodymetric|
|type| String | | | Type of metric (see list below)|
|value| String | | | Value of the metric (e.g. 5.2)|
|manual| Boolean |YES| | (default = true) if manual = true the data was entered manually, if manual = false the data was generated, for example by the Neo Scale|
	
**Example PUT**
```json
{
    "timestamp": 1448531371,
    "type": "bodywater",
    "value": "59.70000076293945",
    "manual" : false
}
````

**Metric types**

|Type|PRO only|Description|
|---|---|---|
|weight| |user's weight. The unit should be in kg or lbs|
|bmi | |the user's body mass index. No unit|
|fat| |the user's body fat. The unit should be in percents of the total body mass|
|waist| |the user's waist. The unit should be in cm or inch|
|number_crunches| |the amount of crunches a user performed|
|number_lunges| |the amount of lunges a user performed|
|number_pushups_knees| |the amount of pushups a user performed on his/her knees|
|number_pushups| |the amount of pushups a user performed|
|hr_exercise| |the user's heart rate after exercise. The unit should be in bpm (beats per minute)|
|hr_rest| |the user's heart rate during rest. The unit should be in bpm (beats per minute)|
|vage| |the user's virtual age. The unit should be in years|
|fitscore| |the user's fit score|
|visceral|yes|Visceral fat is fat that surrounds the inner organs|
|musclemass|yes|the user's total muscle mass|
|muscle_perc|yes|the user's muscle percentage]|
|metabolicrate|yes|the user's daily amount of energy used while in resting|
|metabolicage|yes|the user's metabolic age|
|bonemass|yes|the user's bone mass in kg or lbs|
|bodywater|yes|the user's amount of body water in %|
|height|no|the user height. allowed units are cm or inch. This value will not be saved in the graphs|
|daily_calorie_advice|yes|the advised number of calories an user should eat per day|

**Units**

|Symbol | Description |
|---|---|
|lbs|Pounds|
|kg|Kilo|
|inch|Inch|
|cm|Centimeter|
|mls|Miles|
|%|Percent|
|bpm|Beats per Minute|
|years|Years|
|ml/kg/min|Milliliter per kilogram per minute|


