# Group

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v0/group/search|Returns array of groups that match the query and language filter|language, query (search query), club_id (only searches for groups inside that club)|
|GET|/api/v0/group/joined|Returns array of groups that the user has joined|sync_from|
|GET|/api/v0/group/`<group_id>`/messages|get recent messages posted in this group||
|GET|/api/v0/group/`<group_id>`/updates|get recent updates from this group||
|PUT|/api/v0/group/`<group_id>`/join|send a json with join value 1 or 0 to join this group||
|PUT|/api/v0/group/`<group_id>`/message|Post a message in this group||

**STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|group_id|int|no|||
|name|string|no|||
|descr|string|no|||
|language|string|no|||
|joinable|boolean|no|||
|allowed_to_comment|int|no|0,1||
|allowed_to_post|boolean|no| |if true then user is allowed to post in the group|
|pending_invitation|boolean|no| |if true then the member's request to join the group has not been approved yet|
|nr_members|int|no|||
|club_id|int|yes| |Set in case this group is part of a club|
|avatar|string|yes| |The image of this group|
|joined|int|no|0,1|1 in case the user is a member of this group|


**EXAMPLE GET REPLY**

```json
{"statuscode":200,
 "statusmessage":"Everything OK",
 "timestamp":1321987033,
 "result":[
    {
     "group_id": 2443,
     "name": "Virtuagym@work",
     "descr": "Here you can use all tools that are necessary to keep yourself and your colleagues as vital as possible. For questions or suggestions to improve Virtuagym deployed as Corporate Health solution, you can contact by e-mail or phone anytime. Have fun with investing in your own vitality as human being and employee :) Hugo, Paul, Rachelle and Roxanne",
     "language": "en",
     "joinable": true,
     "allowed_to_comment": 1,
     "allowed_to_post": true,
     "nr_members": 56,
     "header_image": "/images/default_header.png",
     "avatar": "212e2646039fe1a08c8856894351a95f.jpg",
     "club_id": "10034",
     "joined": true
}]
}
```
