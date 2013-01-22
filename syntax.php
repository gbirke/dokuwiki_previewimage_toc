<?php
/**
 * previewimage: Show preview image in page TOC box
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Gabriel Birke <gb@birke-software.de>
 */


if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

class syntax_plugin_previewimage extends DokuWiki_Syntax_Plugin {


    /**
     * What kind of syntax are we?
     */
    function getType(){
        return 'substition';
    }

    /**
     * Where to sort in?
     */
    function getSort(){
        return 100;
    }

    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('{{previewimage>.*?}}', $mode, 'plugin_previewimage');
    }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler) {
        $image = substr($match, 15, -2);
        return array(trim($image));
    }

    /**
     * Create output
     */
    function render($format, &$R, $data) {
        if($format != 'metadata'){
            return false;
        }
        $R->meta['preview_image'] = $data[0];
        return true;
    }

}



