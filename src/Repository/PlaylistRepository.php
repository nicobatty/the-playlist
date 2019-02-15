<?php
/**
 * Author: Nicolas Batty
 * Date: 15/02/19
 * Time: 01:39
 */

namespace NicoBatty\ThePlaylist\Repository;

class PlaylistRepository extends CRUDRepository
{
    public function addVideo($playlistId, $videoId)
    {
        $position = $this->findLastVideoPosition($playlistId);
        $newPos = $position !== null ? $position + 1 : 0;
        $stmt = $this->pdo->prepare('INSERT INTO `playlist_video` (`playlist_id`, `video_id`, `position`) VALUES (:playlist_id, :video_id, :position)');
        $stmt->execute([
            'playlist_id' => $playlistId,
            'video_id' => $videoId,
            'position' => $newPos
        ]);
    }

    public function findLastVideoPosition($playlistId)
    {
        $stmt = $this->pdo->prepare('SELECT MAX(`position`) FROM `playlist_video` WHERE `playlist_id` = :id');
        $stmt->execute(['id' => $playlistId]);
        $position = $stmt->fetchColumn();

        return $position;
    }

    public function removeVideo($playlistId, $videoId)
    {
        $position = $this->findVideoPosition($playlistId, $videoId);
        $this->pdo->beginTransaction();
        $this->deleteVideoLink($playlistId, $videoId);
        $this->reducePositionAfter($playlistId, $position);
        $this->pdo->commit();
    }

    protected function deleteVideoLink($playlistId, $videoId)
    {
        $stmt = $this->pdo->prepare('DELETE FROM `playlist_video` WHERE `playlist_id` = :playlist_id AND `video_id` = :video_id');
        $stmt->execute(['playlist_id' => $playlistId, 'video_id' => $videoId]);
    }

    protected function reducePositionAfter($playlistId, $position)
    {
        $stmt = $this->pdo->prepare('UPDATE `playlist_video` SET `position` = `position` - 1 WHERE `playlist_id` = :playlist_id AND `position` > :position');
        $stmt->execute(['playlist_id' => $playlistId, 'position' => $position]);
    }

    public function findVideoPosition($playlistId, $videoId)
    {
        $stmt = $this->pdo->prepare('SELECT `position` FROM `playlist_video` WHERE `playlist_id` = :playlist_id AND `video_id` = :video_id');
        $stmt->execute(['playlist_id' => $playlistId, 'video_id' => $videoId]);
        $position = $stmt->fetchColumn();

        return $position;
    }
}