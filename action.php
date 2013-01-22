<?php
/**
 * previewimage: Show preview image in page TOC box (action component)
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Gabriel Birke <gb@birke-software.de>
 */

if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_previewimage extends DokuWiki_Action_Plugin {

    /**
     * return some info
     */
    function getInfo(){
        return array(
            'author' => "Gabriel Birke",
            'email' => 'gb@birke-software.de',
            'date' => '2013-01-22',
            'name' => "Preview Image Action component.",
            'desc' => "Show preview image inside TOC box",
            'url' => ''
        );
    }
    /*
     * plugin should use this method to register its handlers with the dokuwiki's event controller
     */
    function register(&$controller) {
        $controller->register_hook('TPL_CONTENT_DISPLAY','BEFORE',$this,'previewimage',array());
    }
    /**
     *  insert html for preview image into toc
     *
     */
    function previewimage(&$event, $param) {
        global $ID;
        $meta = p_get_metadata($ID, "preview_image");
        if(!$meta) {
            return;
        }
        $marker = '<div id="toc__inside">';
        if($p = strpos($event->data, $marker)) {
            $p += strlen($marker);
            $new_content = substr($event->data, 0, $p);
            $new_content .= '<div class="preview_image"><img src="'.ml($meta).'" class="media"></div>';
            $new_content .= substr($event->data, $p);
            $event->data = $new_content;
        }
    }
}
