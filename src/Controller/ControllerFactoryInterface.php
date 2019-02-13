<?php
/**
 * Author: Nicolas Batty
 * Date: 13/02/19
 * Time: 22:03
 */

namespace NicoBatty\ThePlaylist\Controller;


interface ControllerFactoryInterface
{
    public function create(): ControllerInterface;
}