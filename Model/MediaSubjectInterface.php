<?php

namespace Ekyna\Bundle\MediaBundle\Model;

/**
 * Interface MediaSubjectInterface
 * @package Ekyna\Bundle\MediaBundle\Model
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface MediaSubjectInterface
{
    /**
     * Sets the media.
     *
     * @param MediaInterface $media
     * @return MediaSubjectInterface|$this
     */
    public function setMedia(MediaInterface $media = null);

    /**
     * Returns the media.
     *
     * @return MediaInterface
     */
    public function getMedia();
}
