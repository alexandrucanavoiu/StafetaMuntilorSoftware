<?php
/**
 * Created by PhpStorm.
 * User: WSergio
 * Date: 20/06/2015
 * Time: 14:44:18 PM
 */
 
 if (!function_exists('aa')) { function aa() { $args = func_get_args();$count = count($args);$lastArg = $args[$count-1];$output = '';$flag = null;$backtrace = debug_backtrace();if ($lastArg === 1) $flag = $lastArg; if ($lastArg === -1) { $output = $backtrace;foreach ($backtrace as $v) { $v['args'] = htmlentities(print_r($v['args'], true)); $v['args'] = preg_replace("/[\r\n\t ]+/", " ", $v['args']); unset($v['object']); }unset($v);$flag = 1; }foreach ($args as $a){if (is_bool($a)) $a = ($a === true ? 'true' : 'false');if (!is_string($a)) $a = print_r($a, true); $output .= $a."\n";}unset($a);$line = isset($backtrace[1]['line']) ? $backtrace[1]['line'] : 'UNKNOWN_LINE';$file = isset($backtrace[1]['file']) ? '<span title="'.$backtrace[1]['file'].'">'.basename($backtrace[1]['file']).'</span>' : 'UNKNOWN_FILE';echo '<pre style="z-index:9999;clear:both;background: #000;color:#2AD4FF;padding:10px;z-index:9999;text-align:left;margin:0px;border-bottom:1px solid #3C3C3C;display:block;">'.$output.'</pre>'; if (defined('AA_SCROLL')) { echo '<script>window.scrollTo(0, document.body.scrollHeight);</script>'; } if (defined('AA_LOG')) { file_put_contents(dirname(__FILE__).'/aa.log', "[".@date('Y-m-d h:i:s')."] ".$output."\n", FILE_APPEND); } if ($flag == 1) die('Kill flag!'); } }
if (!function_exists('btx')) { function btx() { $bt = debug_backtrace();$fs = array();if (defined('AJAX_REQUEST')) $fs[] = 'AJAX_REQUEST';$max_arg_len = 20;foreach ($bt as $i => $call){$args = array();$line = '?';$file = '?';if (!empty($call['line'])) $line = $call['line'];if (!empty($call['file'])) $file = $call['file'];if (strlen($file) > 10) $file = '..'.substr($file, -$max_arg_len);foreach ($call['args'] as $argx){$arg = json_encode($argx);if (strlen($arg) > $max_arg_len) $arg = substr($arg, 0, $max_arg_len).' .. '.substr($arg, -$max_arg_len);$args[] = $arg;}$args = implode(', ', $args);$fs[] = str_repeat("&nbsp;", $i) . (isset($call['function']) ? $call['function'] : '???').' (<span style="font-size: 0.8em;opacity:0.7;">'.$args.'</span>) (Line: '.$line.' File: '.$file.')';}$fs = implode("\n", $fs);return $fs;} }

 
ini_set('display_errors', 1); 
error_reporting(E_ALL & ~E_NOTICE);
 

$config = array();

$config['db_host'] = "127.0.0.1";
$config['db_user'] = "root";
$config['db_name'] = "stafeta";
$config['db_pass'] = "root";
