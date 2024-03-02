<?php

namespace The3LabsTeam\Readability;

use Exception;
use fivefilters\Readability\Configuration;
use fivefilters\Readability\ParseException;
use fivefilters\Readability\Readability as FFReadability;

class Readability
{
    private ?FFReadability $content;

    /**
     * Parse the content
     *
     * @throws Exception
     */
    public function parse(string $content): self
    {
        $this->content = new FFReadability(new Configuration());
        try {
            $this->content->parse($content);
        } catch (ParseException $e) {
            $this->content = null;
            error_log('Cannot parse: '.$e->getMessage());
            throw new Exception('Cannot parse: '.$e->getMessage());
        }

        return $this;
    }

    /**
     * Return the title of the content
     *
     * @throws Exception
     */
    public function getTitle(): string
    {
        $this->checkContent();

        return $this->content->getTitle();
    }

    /**
     * Return the excerpt of the content
     *
     * @throws Exception
     */
    public function getExcerpt(): string
    {
        $this->checkContent();

        return $this->content->getExcerpt();
    }

    /**
     * Return the author of the content
     *
     * @throws Exception
     */
    public function getAuthor(): string
    {
        $this->checkContent();

        return $this->content->getAuthor();
    }

    /**
     * Return the image of the content
     *
     * @throws Exception
     */
    public function getImage(): string
    {
        $this->checkContent();
        $image = $this->content->getImage();

        return $image !== null ? $image : '';
    }

    /**
     * Return the images of the content
     *
     * @throws Exception
     */
    public function getImages(): array
    {
        $this->checkContent();
        $images = $this->content->getImages();

        return $images !== null ? array_values($images) : [];
    }

    /**
     * Return the content
     */
    public function getContent(): string
    {
        $this->checkContent();

        return $this->content->getContent();
    }

    /**
     * Return the direction
     *
     * @throws Exception
     */
    public function getDirection(): string
    {
        $this->checkContent();

        return $this->content->getDirection();
    }

    /**
     * Check if the content is parsed
     *
     * @throws Exception
     */
    private function checkContent(): void
    {
        if ($this->content === null) {
            throw new Exception('Content is null. Did you forget to call parse()?');
        }
    }
}
