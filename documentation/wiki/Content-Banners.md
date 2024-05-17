# Content Banners

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/content_banners|Returns an array content banners ordered by timestamp_created DESC. This is the order at which the banners should be shown to the user. Skips banners from locked clubs.|sync_from (timestamp), target, club_id|


**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|id|int|no| |id|
|title|string|yes| |The title of the banner|
|image|string|no| |Filename of the image|
|link|string|yes| |The complete link to a web page|
|app_link|string|yes| |identifier for an in-app target|
|app_link_data|string|yes| |data for the in-app target|
|valid_from|int|yes| |If this is set the banner should only be shown from this timestamp on|
|valid_till|int|yes| |If this is set the banner should be hidden after this timestamp|
|club_id|int|no| |This is content created by this club|
|target|int|yes| |'unregistered': only for unregistered users, 'registered': only for registered users, 'pro': only for pro users, 'club': only show for club members (if club_id=my club, else if club_id not set show to all VGProfessional members)|
|deleted|int|no| |If 1, this content has been deleted and should not be shown|
|timestamp_edit|int|no| |Timestamp of the last edit time|
|timestamp_created|int|no| |Timestamp from when this banners was created|


Result example
```json
{"statuscode":200,
 "statusmessage":"Everything OK",
 "timestamp":1321988823,
 "result":[
    {
     "id":531,
     "title":"100 new activities have been added!",
     "image":"d7e2d54cf59219f0992a182edff13582.jpg",
     "link":"http://blog.virtuagym.com",
     "valid_from":1391782597,
     "valid_till":1393651514,
     "deleted":0
    }]
}
```

**App links**

|App link|Description|
|---|---|
|pro|Link to the in-app pro promotion page|

## Possible error codes and messages

|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|


`http://static.virtuagym.com/thumb/content_banner/iphone_retina/` 640x300
`http://static.virtuagym.com/thumb/content_banner/web_normal/` 320x150
