<?php

namespace Purekid\LaravelMarkdownExtra\Markdown;

class Markdown
{
    protected $markDown;
    protected $markDownExtra;

    /**
     * New instance of MarkDown
     *
     * @return void
     */ 
    public function __construct()
    {
        $this->markDown         = new MarkdownParser();
        $this->markDownExtra    = new MarkdownExtra();
    }    
    
    /**
     * Basic Markdown
     *
     * @return string
     */    
    public function transform($str, $safer = true)
    {
	$this->sanitize($this->markDown, $safer);
        return $this->markDown->transformMarkdown($str);
    }
    
    /**
     * Extended Markdown
     *
     * @return string
     */     
    public function transformExtra($str, $safer = true)
    {
	$this->sanitize($this->markDownExtra, $safer);	
        return $this->markDownExtra->transformMarkdown($str);
    }
	
    /**
     * For sanitizer mode.
     *
     * @return string
     */    
    protected function sanitize(IMarkdownParser &$markdown, $safe)
    {
        if ($safe) {
            $markdown->no_markup	= true;
            $markdown->no_entities	= true;
        }
    }
}

