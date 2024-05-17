# Bodymetric Definition

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/bodymetric/definition|Returns an array of bodymetric definitions|sync_from (timestamp)|


**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|type|string| | |metric type (unique - used for updating)|
|name|string| | |human-friendly metric name|
|read_only|int| |0,1|can this metric be updated? (or is it derived from other metric - e.g. bmi)|
|pro_only|int| |0,1|only available to pro-members|
|unit_type|int| |0,1,2|1=weight,2=length,0=other|
|unit_metric|string|yes| |unit to use when user uses metric system in the user's language, or the language provided in the url (/en/api...)|
|unit_imperial|string|yes| |unit to use when user uses imperial system in the user's language, or the language provided in the url (/en/api...)|
|max|number| | |max valid value (in METRIC units)|
|order|number| | |0 is the lowest value and should be the first definition visible to the user|
|increment|number| | |for use in UI: step-size to use when increasing/decreasing this metric|
|graph_range|int| | |for use in UI: The minimal range of the graphs' y-axis|

```json
{"statuscode":200,
 "statusmessage":"Everything OK",
 "timestamp":1321988823,
 "result":[
    {"type" : "fat",
     "name" : "Body fat percentage",
     "read_only" : 0,
     "pro_only" : 1,
     "unit_metric" : "%",
     "unit_imperial" : "%",
     "unit_type" : 2,
     "max" : "80",
     "order" : 2,
     "increment" : 0.1,
     "graph_range" : 20
    },
    {"type" : "musclemass",
     "name" : "...",
     "read_only" : 0,
     "pro_only" : 0,
     "unit_imperial" : "lbs",
     "unit_metric" : "kg",
     "unit_type" : 1,
     "max" : "400",
     "order" : 15,
     "increment" : 0.1
     "graph_range" : 20
    }]
}
```