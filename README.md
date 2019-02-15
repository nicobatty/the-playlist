# The Playlist

The Playlist is a demo project that attempts to boostrap and build a simple REST API without any use of a framework or third-party libraries.

## What's available

### Videos

* `GET  /videos`: Recover list of videos
* `POST /videos`: Create a new video
* `GET  /videos/<id>`: Recover video of ID <id>
* `PUT  /videos/<id>`: Update video of ID <id>

### Playlist

* `GET  /playlists`: Recover list of playlists
* `POST /playlists`: Create a new playlist
* `GET  /playlists/<id>`: Recover playlist of ID <id>
* `PUT  /playlists/<id>`: Update playlist of ID <id>

### Playlist / Video link

* `GET    /playlists/<playlist_id>/videos`: Display videos of playlist <playlist_id> ordered by position
* `POST   /playlists/<playlist_id>/videos/<video_id>`: Add video <video_id> to the playlist <playlist_id> at last position
* `DELETE /playlists/<playlist_id>/videos/<video_id>`: Remove video <video_id> from playlist <playlist_id> and reduce post positions by 1.

If you need CURL examples for this API, here is a link: [Curl Examples](curl_examples.md)

## Stack

* PHP 7.3 with Apache
* MySQL 5.7

## Installation

Requirements:
* Docker

Process:

```
cp docker-compose.yml{.dist,}
docker-compose up -d
docker-compose exec web php bin/install.php
```

Server bootstrap: `public/index.php`

## Table Schema

You can look at `bin/install.php` for most information on the table schema.

## What's missing

This project being time constrained, the code structure and functionality was prioritize over what would be necessary for production. There are a few things missing or requiring enhancements.

* Error handling: Outside of the missing requested objects, invalid or duplicate requests are not currently properly handled and will return 500 errors.
* ORM support: There is no actual Product or Playlist objects right now. The repositories recover, create and update straight from the data which is converted back to JSON. This part was a bit too time consuming for this demo.
* Table Lock: There are some missings locks that could create duplicate playlist video's position.
* Testing: REST API benefits a lot from functional tests. Unit testing and using a TDD approach.
* Proper technical documentation: Right now the documentation mostly contains return and parameters information but not actual explanation. Though proper code is supposed to remain readable even without documentation. The class and method names should mostly follow the Clean Code standard here.
* Proper route matching: Right now the route matching uses raw regex expression to detect the URL matching and ID parameters. So instead of using something like this `/^\\/playlists\\/([\\d]+)\\/videos\\/([\\d]+)$/` we would match with something like this `/playlists/<playlist_id>/videos/<video_id>`
* PATCH method support: Only PUT is available for updates. PATCH needs to be implements.
* [DOCKER] Replace `php:apache` image with `nginx` and `php:fpm`: Time constraint got in the way but that is something I have done for Symfony4 (https://github.com/nicobatty/docker-symfony) and Magento2 though.

