<?php
namespace Purekid\LaravelMarkdownExtra\Markdown;

class MarkdownExtra extends MarkdownExtraParser implements IMarkdownParser
{
    /**
     * doFencedCodeBlocks
     * Credits: https://github.com/egil/php-markdown-extra-extended
     *
     * @param string $text
     * @return string
     */    
    public function doFencedCodeBlocks($text) {
        $less_than_tab = $this->tab_width;

        $text = preg_replace_callback('{
                            (?:\n|\A)
                            # 1: Opening marker
                            (
                                    ~{3,}|`{3,} # Marker: three tilde or more.
                            )

                            [ ]?(\w+)?(?:,[ ]?(\d+))?[ ]* \n # Whitespace and newline following marker.

                            # 3: Content
                            (
                                    (?>
                                            (?!\1 [ ]* \n)	# Not a closing marker.
                                            .*\n+
                                    )+
                            )

                            # Closing marker.
                            \1 [ ]* \n
                    }xm', array(&$this, '_doFencedCodeBlocks_callback'), $text);

        return $text;
    }

    /**
     * _doFencedCodeBlocks_callback
     * Credits: https://github.com/egil/php-markdown-extra-extended
     *
     * @param array $matches
     * @return string
     */    
    public function _doFencedCodeBlocks_callback($matches) {
        $codeblock = $matches[4];
        $codeblock = htmlspecialchars($codeblock, ENT_NOQUOTES);
        $codeblock = preg_replace_callback('/^\n+/', array(&$this, '_doFencedCodeBlocks_newlines'), $codeblock);
        $cb = empty($matches[3]) ? "<pre><code" : "<pre class=\"linenums:$matches[3]\"><code";
        $cb .= empty($matches[2]) ? ">" : " class=\"language-$matches[2] $matches[2]\">";
        $cb .= "$codeblock</code></pre>";
        return "\n\n" . $this->hashBlock($cb) . "\n\n";
    }
}
