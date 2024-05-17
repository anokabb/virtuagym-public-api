# Share

|Method|URL|Info|URL-params|JSON-params|
|---|---|---|---|---|
|PUT|/api/v0/share|sends a message to one or more connected social networks| |msg, url(optional), network(optional)|

**PUT REQUEST STRUCTURE**

|Field|Type|Optional|Values|Information|
|---|---|---|---|---|
|msg|string|no| |The message that will be shared|
|url|string|yes| |The link that belongs to the message|
|network|string|yes|facebook, twitter|When left empty the message will be sent to all connected social networks|
