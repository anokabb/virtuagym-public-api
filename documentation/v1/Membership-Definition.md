# Membership Definition

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/`<club_id>`/membership/definition|Returns an array of membership instances of the given club|api_key, club_secret, max_results, sync_from (in milliseconds)|

**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|membership_id|int|no| |The id of the membership definiton|
|membership_name|string|no| |The name of he membership definition|
|membership_notes|string|yes| |Additional notes of the membership definition|
|membership_duration|int|yes| |Duration of the membership|

*GET example*

Send a GET request to: `https://api.virtuagym.com/api/v1/club/<club_id>/membership/definition?api_key=<api_key>&club_secret=<club_secret>&sync_from=<sync_from>`

```json
{
   "statuscode":200,
   "statusmessage":"Everything OK",
   "result_count":1,
   "timestamp":1429530137,
   "result":[
      {
         "membership_id":585,
         "membership_name":"Monthly pool membership",
         "membership_notes":"Allowed to use the pool for 1 month",
         "membership_duration":"1 months"
      }
   ]
}
```