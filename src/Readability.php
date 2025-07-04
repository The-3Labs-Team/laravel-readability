<?php

namespace The3LabsTeam\Readability;

use Exception;
use fivefilters\Readability\Configuration;
use fivefilters\Readability\ParseException;
use fivefilters\Readability\Readability as FFReadability;

class Readability
{
    private ?FFReadability $content = null;
    public ?string $rawHtml = null;
    public array $sourceList = [];

    public function __construct(?string $rawHtml = null)
    {
        $this->rawHtml = $rawHtml ?? '';

        return $this;
    }

    /**
     * Parse the content
     *
     * @throws Exception
     */
    public function parse(?string $content = null): self
    {
        $this->content = new FFReadability(new Configuration());
        try {
            $this->content->parse($content ?? $this->rawHtml);
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
    public function getExcerpt(): ?string
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

        return $image ?? '';
    }

    /**
     * Return the images of the content
     *
     * @throws Exception
     */
    public function getImages(): array
    {
        $this->checkContent();

        return $this->content->getImages();
    }

    /**
     * Return the content
     */
    public function getContent(): string
    {
        $this->checkContent();

        $content = $this->content->getContent();

        if(!empty($this->sourceList)) {
            $sourceLinksHtml = '<p>Source list: ' . implode(', ', $this->sourceList) . '</p>';
            $content .= "\n\n" . $sourceLinksHtml;
        }
        
        return $content;
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
     * Estrae i link da tag specifici e dal testo, filtrando per dominio
     *
     * @param array $domainWhitelist
     * @param array $tagsToExtract ['a', 'iframe', 'img', 'text']
     * @return $this
     */
    public function addSourceList(array $domainWhitelist = [], array $tagsToExtract = ['a', 'iframe']): self
    {
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($this->rawHtml);
        libxml_clear_errors();
        $links = [];

        if (in_array('a', $tagsToExtract)) {
            foreach ($dom->getElementsByTagName('a') as $a) {
                $href = $a->getAttribute('href');
                if ($href) {
                    $links[] = $href;
                }
            }
        }
        if (in_array('iframe', $tagsToExtract)) {
            foreach ($dom->getElementsByTagName('iframe') as $iframe) {
                $src = $iframe->getAttribute('src');
                if ($src) {
                    $links[] = $src;
                }
            }
        }

        if (in_array('text', $tagsToExtract)) {
            $text = $dom->textContent;
            if ($text) {
                if (preg_match_all('#\b((https?://|www\.)[^\s<>"]+)#i', $text, $matches)) {
                    foreach ($matches[1] as $url) {
                        $links[] = $url;
                    }
                }
            }
        }

        //Rimuovi i link che non hanno https o http
        $links = array_filter($links, fn($link) =>
            preg_match('#^(https?://|www\.)#i', $link)
        );

        if (!empty($domainWhitelist)) {
            $filtered = [];
            foreach ($links as $href) {
                foreach ($domainWhitelist as $domain) {
                    if (stripos($href, $domain) !== false) {
                        $filtered[] = $href;
                        break;
                    }
                }
            }
        } else {
            $filtered = $links;
        }

        $this->sourceList = array_values(array_unique($filtered));

        return $this;
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
