# Achievement Definition

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/achievement|Returns an array of achievement definitions|sync_from (timestamp)|

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|id|int|no| |Achievement definition id|
|name|string|no| |Name|
|url_id|string|no| |The url id of the achievement, use this to create the link to the achievement|
|hint|string|yes| |Text to show when the achievement has not yet been achieved by the user|
|achieved_message|string|yes| |The text to show when someone has earned this achievement|
|thumb|string|no| |Filename of the thumbnail. The path to get the images is /images/achievements/<thumb>|
|hidden|int|no|0,1|When 1 only show when the user achieved this achievement. When 0, always show the achievement but with the image /images/achievements/not_achieved.png|
|points|int|no| |The amount of fitness points this achievement is worth|
|type|string|yes|nutrition|Type of achievement|