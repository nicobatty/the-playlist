# Curl Examples

This is a list of curl request examples that can be made to the web server:

Create a video:

```
curl -X POST \
  http://localhost:8000/videos \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache' \
  -d '{
        "title": "My Video"
}'
```

Update video 1 data:

```
curl -X PUT \
  http://localhost:8000/videos/1 \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache' \
  -d '{
	"title": "My Video 2"
}'
```

Get a video of ID 1:

```
curl -X GET \
  http://localhost:8000/videos/1 \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache'
```


List videos:

```
curl -X GET \
  http://localhost:8000/videos \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache'
```

Create a playlist:

```
curl -X POST \
  http://localhost:8000/playlists \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache' \
  -d '{
        "title": "New Playlist"
}'
```

Update playlist 1 data:

```
curl -X PUT \
  http://localhost:8000/playlists/1 \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache' \
  -d '{
	"title": "New Playlist 2"
}'
```

Get a playlist of ID 1:

```
curl -X GET \
  http://localhost:8000/playlists/1 \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache'
```

List playlists:

```
curl -X GET \
  http://localhost:8000/playlists \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache'
```

Add video 1 to playlist 1:

```
curl -X POST \
  http://localhost:8000/playlists/1/videos/1 \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache'
```

List videos in playlist 1 (ordered by position)

```
curl -X GET \
  http://localhost:8000/playlists/1/videos \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache'
```

Delete video 1 in playlist 1:

```
curl -X DELETE \
  http://localhost:8000/playlists/1/videos/1 \
  -H 'Content-Type: application/json' \
  -H 'cache-control: no-cache'
```
