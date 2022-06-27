<?php
namespace YuzuLib\YuzuLib\DrawCanvas;

class YuzuCanvas {
    private string $tag_name = 'canvas';
    private string $class_name, $id_name;
    private int $width, $height;

    function __construct($width, $height, $id_name, $class_name)
    {
        $this->width = $width;
        $this->height = $height;
        $this->id_name = $id_name;
        $this->class_name = $class_name;
    }

    function to_string(): string
    {
        $output = "<{$this->tag_name} width={$this->width} height={$this->height} id='{$this->id_name}' class='{$this->class_name}'>";
        $output = $output . "</{$this->tag_name}>";
        $output = $output . "
            <script>
                const canvas_{$this->id_name} = document.querySelector('#{$this->id_name}'); 
                let ctx_{$this->id_name} = canvas_{$this->id_name}.getContext('2d');

                let cnvs_{$this->id_name} = document.getElementById('{$this->id_name}');
                let clickFlg_{$this->id_name} = false;
                
                // マウス
                cnvs_{$this->id_name}.addEventListener('mousedown', draw_start_{$this->id_name}, false);
                cnvs_{$this->id_name}.addEventListener('mousemove', draw_move_{$this->id_name}, false);
                cnvs_{$this->id_name}.addEventListener('mouseup', draw_end_{$this->id_name}, false);
                // スマホ・タブレット
                cnvs_{$this->id_name}.addEventListener('touchstart', draw_start_{$this->id_name}, false);
                cnvs_{$this->id_name}.addEventListener('touchmove', draw_move_{$this->id_name}, false);
                cnvs_{$this->id_name}.addEventListener('touchend', draw_end_{$this->id_name}, false);

                function draw_start_{$this->id_name}(e) {
                    clickFlg_{$this->id_name} = true;
                    e.preventDefault();
                    ctx_{$this->id_name}.beginPath();
                    ctx_{$this->id_name}.lineWidth = 2;
                    ctx_{$this->id_name}.strokeStyle = '#333';
                    ctx_{$this->id_name}.lineCap = 'round';
                    ctx_{$this->id_name}.moveTo(e.offsetX, e.offsetY);
                    ctx_{$this->id_name}.stroke();
                    console.log(e.offsetX + ':' + e.offsetY);
                }
                
                function draw_move_{$this->id_name}(e) {
                    if (clickFlg_{$this->id_name} == false) return false;
                    ctx_{$this->id_name}.lineTo(e.offsetX, e.offsetY);
                    ctx_{$this->id_name}.stroke();
                    // console.log(e.offsetX + ':' + e.offsetY);
                }
            
                function draw_end_{$this->id_name}(e) {
                    clickFlg_{$this->id_name} = false;
                    ctx_{$this->id_name}.lineTo(e.offsetX, e.offsetY);
                    ctx_{$this->id_name}.stroke();
                    console.log(e.offsetX + ':' + e.offsetY);
                }
            </script>
        ";
        return $output;
    }
}