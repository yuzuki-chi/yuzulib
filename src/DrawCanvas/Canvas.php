<?php
namespace YuzuLib\YuzuLib\DrawCanvas;

/**
 * Canvas class
 * JavaScriptを用いて, 絵を描けるCanvas領域を制御する
 */
class Canvas {
    private $tag_name = "canvas";
    private $width;
    private $height;
    private $contents = "";

    /**
     * @param $width
     * @param $height
     */
    function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return string canvas content
     */
    function drawCanvas(): string
    {
        $ret = "
        <{$this->tag_name} width='{$this->width}' height='{$this->height}' id='canvas'>
            <script>const canvas = document.querySelector('canvas'); 
            let ctx = canvas.getContext('2d');</script>
            {$this->contents}
        </{$this->tag_name}>";
        return $ret;
    }

    /**
     * 四角形を描画する関数
     * 
     * @param string $color
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     */
    function drawRect($x, $y, $width, $height, $color='black'): void
    {
        $this->contents = $this->contents . "
            <script>
                ctx.fillStyle = '{$color}';
                ctx.fillRect({$x}, {$y}, {$width}, {$height});
            </script>
        ";
    }

    /**
     * マウス・タップで線を描画できるようにする関数. 1度のみ呼び出し.
     */
    function drawFunc(): void
    {
        $this->contents = $this->contents . "
            <script>
                let cnvs = document.getElementById('canvas');
                let clickFlg = false;
                
                // マウス
                cnvs.addEventListener('mousedown', draw_start, false);
                cnvs.addEventListener('mousemove', draw_move, false);
                cnvs.addEventListener('mouseup', draw_end, false);
                // スマホ・タブレット
                cnvs.addEventListener('touchstart', draw_start, false);
                cnvs.addEventListener('touchmove', draw_move, false);
                cnvs.addEventListener('touchend', draw_end, false);

                function draw_start(e) {
                    clickFlg = true;
                    e.preventDefault();
                    ctx.beginPath();
                    ctx.lineWidth = 2;
                    ctx.strokeStyle = '#333';
                    ctx.lineCap = 'round';
                    ctx.moveTo(e.offsetX, e.offsetY);
                    ctx.stroke();
                    console.log(e.offsetX + ':' + e.offsetY);
                }
                
                function draw_move(e) {
                    if (clickFlg == false) return false;
                    ctx.lineTo(e.offsetX, e.offsetY);
                    ctx.stroke();
                    console.log(e.offsetX + ':' + e.offsetY);
                }
            
                function draw_end(e) {
                    clickFlg = false;
                    ctx.lineTo(e.offsetX, e.offsetY);
                    ctx.stroke();
                    console.log(e.offsetX + ':' + e.offsetY);
                }
            </script>
        ";
    }
}