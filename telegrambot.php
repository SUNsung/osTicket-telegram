<?php

require_once(INCLUDE_DIR . 'class.signal.php');
require_once(INCLUDE_DIR . 'class.plugin.php');
require_once(INCLUDE_DIR . 'class.ticket.php');
require_once(INCLUDE_DIR . 'class.osticket.php');
require_once(INCLUDE_DIR . 'class.config.php');
require_once(INCLUDE_DIR . 'class.format.php');
require_once('config.php');

class TelegramPlugin extends Plugin {
    var $config_class = "TelegramPluginConfig";

    function bootstrap() {
        Signal::connect('ticket.created', array($this, 'onTicketCreated'));
        Signal::connect('threadentry.created', array($this, 'onTicketUpdated'));
    }


    function onTicketCreated(Ticket $ticket) {
        global $cfg;
        if (!$cfg instanceof OsticketConfig) {
            error_log("Slack plugin called too early.");
            return;
        }

        $key_bot = $this->getConfig()->get('telegram-bot-key');
        $chanel = $this->getConfig()->get('telegram-chat-id');

        $text_messege = "*NEW:* ╢[".$ticket->getNumber()."](".$cfg->getUrl()."scp/tickets.php?id=".$ticket->getId().")╟ ".$ticket->getEmail()."\n";
        $text_messege .= "*".$ticket->getSubject()."*  ╢".$ticket->getName()."╟";

        if ($this->getConfig()->get('telegram-send-new')) $this->began($user_agent,"Content-Type:application/json","https://api.telegram.org/bot$key_bot/SendMessage",'{"chat_id": "'.$chanel.'", "text": "'.$text_messege.'", "parse_mode": "Markdown"}');

    }


    function onTicketUpdated(ThreadEntry $entry) {
        global $cfg;
        if (!$cfg instanceof OsticketConfig) {
            error_log("Telegram plugin called too early.");
            return;
        }
        if (!$entry instanceof MessageThreadEntry) return;

        $ticket = $this->getTicket($entry);
        if (!$ticket instanceof Ticket) return;

        $key_bot = $this->getConfig()->get('telegram-bot-key');
        $chanel = $this->getConfig()->get('telegram-chat-id');

        $text_messege = "*UPD:* ╢[".$ticket->getNumber()."](".$cfg->getUrl()."scp/tickets.php?id=".$ticket->getId().")╟ ".$ticket->getEmail()."\n";
        $text_messege .= "*".$ticket->getSubject()."*  ╢".$ticket->getName()."╟";

        if ($this->getConfig()->get('telegram-send-upd')) $this->began($user_agent,"Content-Type:application/json","https://api.telegram.org/bot$key_bot/SendMessage",'{"chat_id": "'.$chanel.'", "text": "'.$text_messege.'", "parse_mode": "Markdown"}');
    }
    function getTicket(ThreadEntry $entry) {
        $ticket_id = Thread::objects()->filter(['id' => $entry->getThreadId()])->values_flat('object_id')->first() [0];
        return Ticket::lookup(array('ticket_id' => $ticket_id));
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

}



