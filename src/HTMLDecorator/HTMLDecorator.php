<?php
namespace YuzuLib\YuzuLib\HTMLDecorator;

/**
 * HTML Decorator class
 * v1.0 最低限の要素のみ対応
 */
class HTMLDecorator {
    private string $tag_name;
    public array $properties = [];
    public string $body = '';

    /**
     * @param string $tag_name
     */
    function  __construct($tag_name)
    {
        $this->tag_name = $tag_name;
    }

    /**
     * @param string $property_name
     * @param string|int $value
     */
    function add_property($property_name, $value): void
    {
        $this->properties += [$property_name=>$value];
    }

    /**
     * @param string $body_text
     */
    function add_body($body_text): void
    {
        $this->body = $body_text;
    }

    /**
     * @return string HTML output
     */
    function to_string(): string
    {
        $output = "<{$this->tag_name}";
        if(!empty($this->properties)) {
            foreach( $this->properties as $property_name => $value) {
                $output = $output . " {$property_name}='{$value}'";
            }
        }
        $output = $output . ">";
        $output = $output . $this->body;
        $output = $output .  "</{$this->tag_name}>";
        
        return $output;
    }
}