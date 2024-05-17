# Activity Definition

Users and clubs can create their own activity definitions, so authorisation for this request is required since users will get different results. Activities added by Virtuagym are always present.

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/activity/definition|Returns an array of activity definitions|sync_from (timestamp)|


**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|id|int| | |id of the activity|
|name|string | | |name of the activity|

```json
{
   "statuscode":200,
   "statusmessage":"Everything OK",
   "result_count":3,
   "timestamp":1447776905,
   "result":[
      {
         "id":1,
         "name":"Elliptical Trainer - low intensity"
      },
      {
         "id":2,
         "name":"Elliptical Trainer"
      },
      {
         "id":4,
         "name":"Elliptical Trainer - high intensity"
      }
   ]
}
```