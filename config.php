<?php

require_once INCLUDE_DIR . 'class.plugin.php';

class TelegramPluginConfig extends PluginConfig {
    function getOptions() {
        return array(
            'telegram' => new SectionBreakField(array(
                'label' => 'Telegram Bot',
            )),
            'telegram-bot-key' => new TextboxField(array(
                'label' => 'Token for the bot',
                'configuration' => array('size'=>100, 'length'=>200),
            )),
            'telegram-chat-id' => new TextboxField(array(
                'label' => 'Chat ID',
                'configuration' => array('size'=>100, 'length'=>200),
            )),
            'telegram-useragent' => new TextboxField(array(
                'label' => 'User-Agent',
                'configuration' => array('size'=>100, 'length'=>200),
                'default' => "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:81.0) Gecko/20100101",
            )),
            'telegram-send-upd' => new BooleanField(array(
                'label' => 'Send when updates on old ticket',
                'default' => 0,
            )),
            'telegram-send-new' => new BooleanField(array(
                'label' => 'Send when new tickets appear',
                'default' => 0,
            )),

        );
    }
}
