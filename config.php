<?php

require_once INCLUDE_DIR . 'class.plugin.php';

class TelegramPluginConfig extends PluginConfig {
    function getOptions() {
        return array(
            'telegram' => new SectionBreakField(array(
                'label' => 'Telegram Bot',
            )),
            'telegram-bot-key' => new TextboxField(array(
                'label' => 'Token for the bot ( 000000000:#################################### )',
                'configuration' => array('size'=>100, 'length'=>200),
            )),
            'telegram-chat-id' => new TextboxField(array(
                'label' => 'Chat ID ( 000000000 OR  -000000000 OR @######### )',
                'configuration' => array('size'=>100, 'length'=>200),
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
