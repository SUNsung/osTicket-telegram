<?php
require_once(INCLUDE_DIR.'class.signal.php');
require_once(INCLUDE_DIR.'class.plugin.php');
require_once('config.php');
class TelegramPlugin extends Plugin {
    var $config_class = "TelegramPluginConfig";
    function bootstrap() {
        Signal::connect('ticket.created', array($this, 'onTicketCreated'), 'Ticket');
    }
    function onTicketCreated($ticket)
    {
        global $ost;
        $ticketLink = $ost->getConfig()->getUrl().'scp/tickets.php?id='.$ticket->getId();
        $ticketId = $ticket->getNumber();
        $title = $ticket->getSubject() ?: 'No subject';
        $createdBy = $ticket->getName();
        $mails = $ticket->getEmail();
        $chatid = $this->getConfig()->get('telegram-chat-id');
        if ($this->getConfig()->get('telegram-include-body')) {
            $body = $ticket->getLastMessage()->getMessage() ?: 'No content';
            $body = str_replace('<p>', '', $body);
            $body = str_replace('</p>', '<br />' , $body);
            $breaks = array("<br />","<br>","<br/>");
            $body = str_ireplace($breaks, "\n", $body);
            $body = preg_replace('/\v(?:[\v\h]+)/', '', $body);
            $body = strip_tags($body);
        }
        
        $post = '{"id":424405351, "text": "есть сообщение!"}';
        
        began("sdfsdfsdfsdfs","POST","https://api.telegram.org/bot880001526:AAGIkRHzmx9KiphJ2AuWMA4gpxuB_SeCcdc/sendMessage",$post);
    }
    function sendToTelegram($payload)
    {
        try {
            
            

        } catch(Exception $e) {
            error_log('Error posting to Telegram. '. $e->getMessage());
        }
    }
    function escapeText($text)
    {
        $text = str_replace('&', '&amp;', $text);
        $text = str_replace('<', '&lt;', $text);
        $text = str_replace('>', '&gt;', $text);
        return $text;
    }
}

function began($user_agent,$type,$url,$post){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($type));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $temp = curl_exec($ch);
    curl_close($ch);
    return json_decode($temp, true);
}

