# User Achievements

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/user/current/achievements|Returns an array of achievement id's the user has earned|sync_from (timestamp), include_progress (when given all received achievements and the achievements that are in progress are returned)|

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|ach_id|int|no| |Achievement definition id the user has earned|
|timestamp_achieved|int|no| |Timestamp of when the user got the achievement|
|deleted|int|no|0,1|Achievements can be deleted when a user has removed activities for example|