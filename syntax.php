<?php
/**
 * DokuWiki Plugin wavedrom (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Raymond Wu <wusixin@1gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) {
    die();
}
/**
* if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
* if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
* require_once(DOKU_PLUGIN.'syntax.php');
*/

class syntax_plugin_wavedrom extends DokuWiki_Syntax_Plugin
{
    function getType(){ return 'protected'; }

    // must return a number lower than returned by native 'code' mode (200)
    function getSort(){ return 158; }

    
    

    /**
     * Connect lookup pattern to lexer.
     *
     * @param string $mode Parser mode
     */
     function connectTo($mode) {       
        $this->Lexer->addEntryPattern('<wavedrom>(?=.*?</wavedrom>)',$mode,'plugin_wavedrom');
    }
    function postConnect() {
        $this->Lexer->addExitPattern('</wavedrom>','plugin_wavedrom');
    }


    /**
     * Handle matches of the wavedrom syntax
     */
    function handle($match, $state, $pos, Doku_Handler $handler){
        switch ($state) {
            case DOKU_LEXER_ENTER:
                return array($state, '');
 
            case DOKU_LEXER_UNMATCHED : 
                return array($state, $match);
 
            case DOKU_LEXER_EXIT :
                return array($state, '');
 
        }       
        return false;
    }


    /**
     * Render xhtml output or metadata
     */
    function render($mode, Doku_Renderer $renderer, $indata) {
        if($mode == 'xhtml'){
            list($state, $match) = $indata;
            switch ($state) {
 
            case DOKU_LEXER_ENTER :      
                $renderer->doc .= '<script type="WaveDrom">';
                break;
 
              case DOKU_LEXER_UNMATCHED : 
                $renderer->doc .= $match;
                break;
 
              case DOKU_LEXER_EXIT :
                $renderer->doc .= "</script>";
                break;
            }
            return true;
        }
        return false;
    }

}

