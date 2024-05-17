# Upload

|Method|URL|Info|
|---|---|---|
|POST|/api/v0/upload/image|The file should be called "userfile"|

**Sample request**

The (POST) request should be formatted as a multipart-mime request. For example:

The following HTTP header must be present:
<pre><code>Content-Type = multipart/form-data; boundary=arbitrary_boundary_constant
</code></pre>

The body should be formatted like:
<pre><code>--arbitrary_boundary_constant
Content-Disposition: form-data; name="userfile"; filename="image.jpg"
Content-Type: image/jpeg
image_data
--arbitrary_boundary_constant--
</code></pre>

**Sample Response**

```json
{
   "statuscode":200,
   "statusmessage":"Everything OK",
   "result_count":1,
   "timestamp":1399995049,
   "result":{
      "filename":"52d6523ba2e6671bd290fe96e643302f.jpg"
   }
}
```

## Possible error codes and messages

|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|420|Invalid Input|There was an error uploading the file, probably because the file format is wrong|

