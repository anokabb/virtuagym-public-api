# Membership Instances

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/`<club_id>`/membership/instance|Returns an array of membership instances of the given club|api_key, club_secret, max_results, sync_from (timestamp in milliseconds), member_id, from_id (optional)|

**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|instance_id|int|no| |The id of the membership instance|
|membership_id|int|no| |The id of the [[Membership Definition]]|
|member_id|int|no| |The id of the [[Club Members]]|
|active|boolean|no| |If the membership instance is active or inactive|
|completed|boolean|no| |If the membership has reached the contract end date automatically and was not renewed|
|paused|boolean|no| |If the membership instance was paused by an employee|
|cancelled|boolean|no| |If the membership was manually cancelled by an employee with termination in the future|
|stopped|boolean|no| |If the membership was manually cancelled by an employee with immediate termination|
|start_date|string|yes| |The actual start date of the membership (yyyy-mm-dd)|
|contract_start_date|string|yes| |The contractual start date of the membership (yyyy-mm-dd)|
|contract_end_date|string|yes| |The contractual  end date of the membership (yyyy-mm-dd)|
|membership_name|string|yes| |The name of the membership|

**GET example**

Send a GET request to: `https://api.virtuagym.com/api/v1/club/<club_id>/membership/instance?api_key=<api_key>&club_secret=<club_secret>&sync_from=<sync_from>` OR `https://api.virtuagym.com/api/v1/club/<club_id>/membership/instance?api_key=<api_key>&club_secret=<club_secret>&from_id=<from_id>`

In some cases it is better to use from_id as multiple rows might have the same sync_from thereby not allowing for pagination. For the first call when using from_id it is allowed to pass 0 and it would allow for pagination.

```json
{
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 1,
    "timestamp": 1429533294,
    "result": [
        {
            "instance_id": 2537,
            "membership_id": 584,
            "member_id": 77038,
            "active": false,
            "cancelled": true,
            "completed": true,
            "paused": false,
            "stopped": false,
            "start_date": "2015-04-01",
            "contract_start_date": "2015-05-01",
            "contract_end_date": "2015-07-31",
            "membership_name": "Test"
        }
    ]
}
```