<?php
/**
 * DokuWiki Plugin wavedrom (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Raymond Wu <wusixin@gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) {
    die();
}

class action_plugin_wavedrom extends DokuWiki_Action_Plugin
{

 public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this,
                                   '_loadwavedrom');
    }
 
    public function _loadwavedrom(Doku_Event $event, $param) {
        $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => '',
                            'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/wavedrom/1.6.2/skins/default.js');
        $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => '',
                            'src'     => 'https://cdnjs.cloudflare.com/ajax/libs/wavedrom/1.6.2/wavedrom.min.js');
        $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => 'jQuery(function(){WaveDrom.ProcessAll()});');
        }

}

